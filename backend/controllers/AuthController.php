<?php
require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/User.php';

$user = new User($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($_GET['action'] === 'register') {
        echo json_encode(['success' => $user->register($data['email'], $data['password'])]);
    } elseif ($_GET['action'] === 'login') {
        $res = $user->login($data['email'], $data['password']);
        echo json_encode(['success' => !!$res, 'user' => $res]);
    }
} elseif ($_GET['action'] === 'me') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_GET['user_id']]);
    echo json_encode($stmt->fetch());
}
?>