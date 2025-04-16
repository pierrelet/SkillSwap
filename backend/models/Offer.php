<?php
class Offer {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($title, $description, $user_id) {
        $stmt = $this->pdo->prepare("INSERT INTO offers (title, description, user_id) VALUES (?, ?, ?)");
        return $stmt->execute([$title, $description, $user_id]);
    }

    public function getAll() {
        $stmt = $this->pdo->query("SELECT o.*, u.email FROM offers o JOIN users u ON o.user_id = u.id ORDER BY o.id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM offers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>