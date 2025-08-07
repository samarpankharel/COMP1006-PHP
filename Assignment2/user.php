<?php
class User {
    private $conn;
    private $table = 'userRecords';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($name, $email, $password, $image) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (name, email, password, image) VALUES (:name, :email, :password, :image)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':name' => $name, ':email' => $email, ':password' => $hashedPassword, ':image' => $image]);
    }

    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $name, $email, $image = null) {
        if ($image) {
            $sql = "UPDATE {$this->table} SET name = :name, email = :email, image = :image WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':name' => $name, ':email' => $email, ':image' => $image, ':id' => $id]);
        } else {
            $sql = "UPDATE {$this->table} SET name = :name, email = :email WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([':name' => $name, ':email' => $email, ':id' => $id]);
        }
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>