<?php
namespace src\controllers;

use \core\Controller;
use \src\helpers\UserHandler;

class LoginController extends Controller {

    public function login() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('login', [
            'flash' => $flash
        ]);
    }

    public function loginPost() {
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');

        if($email && $password){
            $token = UserHandler::verifyLogin($email, $password);
            if($token) {
                $_SESSION['token'] = $token;
                $this->redirect('/');
            } else {
                $_SESSION['flash'] = 'Email e/ou senha incorretos';
                $this->redirect('/login');
            }

        }else {
            $this->redirect('/login');
        }
        
    }

    public function register() {
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }
        $this->render('register', [
            'flash' => $flash
        ]);
    }

    public function registerPost() {
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $password = filter_input(INPUT_POST, 'password');
        $birthdate = filter_input(INPUT_POST, 'birthdate');

        if($name && $email && $password && $birthdate) {

            $birthdate = explode('/', $birthdate);
            if(count($birthdate) != 3) {
                $_SESSION['flash'] = "Data de nascimento inválida";
                $this->redirect('/register');
            }
            $birthdate = $birthdate[0].'-'.$birthdate[1].'-'.$birthdate[2];

            if(strtotime($birthdate) === false) {
                $_SESSION['flash'] = "Data de nascimento inválida";
                $this->redirect('/register');
            }
            

            if(UserHandler::emailExists($email) === false) {
                $token = UserHandler::addUser($name, $email, $password, $birthdate);
                $_SESSION['token'] = $token;
                $this->redirect('/');
                echo $birthdate;
            } else {
                $_SESSION['flash'] = "Email já cadastrado!";
                $this->redirect('/register');
            }
            
        } else {
            $this->redirect('/register');
        }

    }

    public function logout() {
        $_SESSION['token'] = '';
        $this->redirect('/login');
    }
}