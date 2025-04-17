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
        $stmt = $this->pdo->query("
            SELECT o.*, u.email,
            (
              SELECT json_agg(json_build_object(
                  'rating', r.rating,
                  'comment', r.comment,
                  'created_at', r.created_at
              ))
              FROM ratings r
              WHERE r.user_id = o.user_id
            ) AS ratings
            FROM offers o
            JOIN users u ON o.user_id = u.id
            ORDER BY o.created_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM offers WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>