<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/Message.php';

$message = new Message($pdo);

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode(['success' => $message->send($data['sender_id'], $data['receiver_id'], $data['message'])]);
        break;
    case 'GET':
        $receiver_id = $_GET['receiver_id'] ?? 0;
        echo json_encode($message->received($receiver_id));
        break;
}
?>