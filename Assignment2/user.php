<?php
class User {
    private $conn;
    private $table = 'userRecords';
   //Receives database connection
    public function __construct($db) {
        $this->conn = $db;
    }
    //Registering a new user with encrypted password and image
    public function create($name, $email, $password, $image) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (name, email, password, image) VALUES (:name, :email, :password, :image)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':name' => $name, ':email' => $email, ':password' => $hashedPassword, ':image' => $image]);
    }
    //Get all the users from database and order by the recently added user
    public function getAll() {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Get a user by their ID
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //Updating the user's info
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
    //Delete the user by the ID
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = ?");
        return $stmt->execute([$id]);
    }
    //Checks the login credientials
    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    //Collects the users information by EMAIL
    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>