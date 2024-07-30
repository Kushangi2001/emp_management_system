<?php
class User {
    private $db;
    private $link;

    public function __construct() {
        $this->db = new Database();
        $this->link = $this->db->getLink();
    }

    public function register($username, $password, $role) {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
        if($stmt = mysqli_prepare($this->link, $query)){
            mysqli_stmt_bind_param($stmt, "sss", $username, $password_hash, $role);
            if(mysqli_stmt_execute($stmt)){
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    public function login($username, $password) {
        $query = "SELECT id, username, password, role FROM users WHERE username = ?";
        if($stmt = mysqli_prepare($this->link, $query)){
            mysqli_stmt_bind_param($stmt, "s", $username);
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $role);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            $_SESSION["role"] = $role;
                            return true;
                        }
                    }
                }
            }
        }
        return false;
    }

    public function logout() {
        session_start();
        $_SESSION = array();
        session_destroy();
    }
}
?>
