<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: auth.php");
    exit;
}
class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($user_id, $product_name, $description, $price, $imageName = null) {
        $stmt = $this->conn->prepare("INSERT INTO products (user_id, product_name, description, price, image) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$user_id, $product_name, $description, $price, $imageName]);
    }

    public function getByID($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $user_id, $product_name, $description, $price, $imageName = null) {
        if ($imageName) {
            $stmt = $this->conn->prepare("UPDATE products SET product_name = ?, description = ?, price = ?, image = ? WHERE id = ? AND user_id = ?");
            return $stmt->execute([$product_name, $description, $price, $imageName, $id, $user_id]);
        } else {
            $stmt = $this->conn->prepare("UPDATE products SET product_name = ?, description = ?, price = ? WHERE id = ? AND user_id = ?");
            return $stmt->execute([$product_name, $description, $price, $id, $user_id]);
        }
    }

    public function delete($id, $user_id) {
        $stmt = $this->conn->prepare("DELETE FROM products WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $user_id]);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM products ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
}
?>
