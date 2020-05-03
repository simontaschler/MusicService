<?php 

require_once(__DIR__.'/../model/LoginModel.php');
require_once(__DIR__.'/../core/CJ_Controller.php');

class Login extends CJ_Controller {
    
    function __construct() {
        $this->model = new LoginModel();
    }

    function index(){
        if (isset($_SESSION['username'])) {
            header('Location: ./artist');
        } else {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $loginValid = $this->model->validateLogin($_POST['username'], $_POST['password']);
                if ($loginValid)
                    header('Location: ./artist');
                else
                    $this->load_view('LoginView', array('failed' => true));
            } else {
                $this->load_view('LoginView', array('failed' => false));
            }
        }
    }

    function logout_get(){
        session_unset();
        header('Location: ../login');
    }
}