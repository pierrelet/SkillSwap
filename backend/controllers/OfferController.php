<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Offer.php';

$offer = new Offer($pdo);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(['success' => $offer->create($data['title'], $data['description'], $data['user_id'])]);
        break;
    case 'GET':
        echo json_encode($offer->getAll());
        break;
    case 'DELETE':
        parse_str(file_get_contents('php://input'), $data);
        echo json_encode(['success' => $offer->delete($data['id'])]);
        break;
    case 'PUT':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("UPDATE offers SET title = ?, description = ?, user_id = ? WHERE id = ?");
        echo json_encode(['success' => $stmt->execute([$data['title'], $data['description'], $data['user_id'], $data['id']])]);
        break;
}
?>