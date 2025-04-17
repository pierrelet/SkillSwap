<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Offer.php';

$offer = new Offer($pdo);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        // Créer une offre
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode([
            'success' => $offer->create($data['title'], $data['description'], $data['user_id'])
        ]);
        break;

    case 'GET':
        // Récupérer toutes les offres
        echo json_encode($offer->getAll());
        break;

    case 'DELETE':
        // Supprimer une offre (si c'est bien la tienne)
        parse_str(file_get_contents('php://input'), $data);

        $offerId = $data['id'] ?? null;
        $userId = $data['user_id'] ?? null;

        if (!$offerId || !$userId) {
            echo json_encode(['success' => false, 'error' => 'ID manquant']);
            break;
        }

        // Vérification : est-ce que l'offre appartient bien à cet utilisateur ?
        $stmt = $pdo->prepare("SELECT * FROM offers WHERE id = ? AND user_id = ?");
        $stmt->execute([$offerId, $userId]);
        $offerData = $stmt->fetch();

        if (!$offerData) {
            echo json_encode(['success' => false, 'error' => 'Non autorisé']);
            break;
        }

        echo json_encode(['success' => $offer->delete($offerId)]);
        break;

    case 'PUT':
        // Modifier une offre (optionnel)
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE offers SET title = ?, description = ?, user_id = ? WHERE id = ?");
        echo json_encode([
            'success' => $stmt->execute([
                $data['title'],
                $data['description'],
                $data['user_id'],
                $data['id']
            ])
        ]);
        break;
}
?>