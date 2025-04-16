<?php
// Autoriser les appels cross-domain (CORS)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Gérer les requêtes OPTIONS (preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Routage vers les bons contrôleurs
$route = $_GET['route'] ?? '';

switch ($route) {
    case 'auth':
        require __DIR__ . '/controllers/AuthController.php';
        break;
    case 'offers':
        require __DIR__ . '/controllers/OfferController.php';
        break;
    case 'messages':
        require __DIR__ . '/controllers/MessageController.php';
        break;
    case 'ratings':
        require __DIR__ . '/controllers/RatingController.php';
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Route inconnue']);
        break;
}
?>