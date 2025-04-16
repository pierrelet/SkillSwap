<?php
class Message {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function send($sender_id, $receiver_id, $message) {
        $stmt = $this->pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        return $stmt->execute([$sender_id, $receiver_id, $message]);
    }

    public function received($receiver_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM messages WHERE receiver_id = ? ORDER BY created_at DESC");
        $stmt->execute([$receiver_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>