<?php
class User {
    private $id;
    private $username;
    private $firstName;
    private $lastName;
    private $email;
    private $password;
    private $creationDate;

    public function __construct($username, $firstName, $lastName, $email, $password) {
        $this->id = $this->generateUuidV4();
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_BCRYPT);
        $this->creationDate = date('Y-m-d H:i:s');
    }

    private function generateUuidV4() {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000,
            mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public function save($conn) {
        $conn->begin_transaction();

        try {
            $stmt1 = $conn->prepare("INSERT INTO users (id, username, email, password, creation_date) VALUES (?, ?, ?, ?, ?)");
            $stmt1->bind_param("sssss", $this->id, $this->username, $this->email, $this->password, $this->creationDate);
            $stmt1->execute();

            $stmt2 = $conn->prepare("INSERT INTO user_information (user_id, first_name, last_name) VALUES (?, ?, ?)");
            $stmt2->bind_param("sss", $this->id, $this->firstName, $this->lastName);
            $stmt2->execute();

            $conn->commit();
            return true;
        } catch (Exception $e) {
            $conn->rollback();
            return false;
        }
    }

    public static function authenticate($conn, $email, $password) {
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($user = $result->fetch_assoc()) {
            if (password_verify($password, $user['password'])) {
                return $user;
            }
        }

        return false;
    }


    public static function isEmailTaken($conn, $email) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }
    
    public static function isUsernameTaken($conn, $username) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->num_rows > 0;
    }

    public static function getProfile($conn, $userId) {
        $stmt = $conn->prepare("
            SELECT u.email, i.first_name, i.last_name
            FROM users u
            JOIN user_information i ON u.id = i.user_id
            WHERE u.id = ?
        ");
        $stmt->bind_param("s", $userId);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    
    
}
?>
