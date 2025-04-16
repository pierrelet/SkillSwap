<?php
class Rating {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($user_id, $rating, $comment) {
        $stmt = $this->pdo->prepare("INSERT INTO ratings (user_id, rating, comment) VALUES (?, ?, ?)");
        return $stmt->execute([$user_id, $rating, $comment]);
    }

    public function getForUser($user_id) {
        $stmt = $this->pdo->prepare("SELECT * FROM ratings WHERE user_id = ?");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>