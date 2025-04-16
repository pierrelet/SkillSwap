<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Rating.php';

$rating = new Rating($pdo);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(['success' => $rating->add($data['user_id'], $data['rating'], $data['comment'])]);
        break;
    case 'GET':
        $id = $_GET['user_id'];
        echo json_encode($rating->getForUser($id));
        break;
}
?>