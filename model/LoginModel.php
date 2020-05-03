<?php 
require_once(__DIR__.'/../core/CJ_Model.php');

class LoginModel extends CJ_Model {

    function __construct(){
		parent::__construct();
    }
    
    function validateLogin($username, $password){
        if ($username) {
            $stmt = $this->connection->prepare("SELECT PasswordHash FROM user WHERE Username = ?");
            $stmt->bind_param('s', $username);
            $stmt->execute();
            $result = $stmt->get_result()->fetch_assoc();
            if (!empty($result)) {
                $pwHash = $result['PasswordHash'];
                if (password_verify($password, $pwHash)) {
                    $_SESSION['username'] = $username;
                    echo "worked";
                    return true;
                }
            }
        }
        return false;
    }
}