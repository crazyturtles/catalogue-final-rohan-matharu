<?php
class Authentication
{
    private $connection;
    private const TABLE = 'catalogue_admin';

    public function __construct($conn)
    {
        $this->connection = $conn;
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['admin_id']) && isset($_SESSION['username']) && isset($_SESSION['last_login']);
    }

    public function requireLogin()
    {
        if (!$this->isLoggedIn()) {
            header('Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/login.php');
            exit;
        }
    }

    public function login($username, $password)
    {
        $sql = "SELECT admin_id, username, hashed_pass FROM " . self::TABLE . " WHERE username = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['hashed_pass'])) {
                $_SESSION['admin_id'] = $user['admin_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['last_login'] = time();
                return true;
            }
        }
        return false;
    }

    public function logout()
    {
        unset($_SESSION['admin_id'], $_SESSION['username'], $_SESSION['last_login']);
        session_destroy();
        header('Location: https://rmatharu2.dmitstudent.ca/dmit2025/catalogue-final-rohan-matharu/public/login.php');
        exit;
    }

    public function getCurrentUser()
    {
        return $_SESSION['username'] ?? null;
    }
}
?>