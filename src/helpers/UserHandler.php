<?php
namespace src\helpers;

use \core\Database;
use \src\models\User;
use \src\models\UserRelations;
use \src\helpers\PostHandler;

class UserHandler {
    
    public static function checkLogin() {
        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $pdo = Database::getInstance();

            $sql = $pdo->prepare("SELECT * FROM users WHERE token = :token");
            $sql->bindValue(':token', $token);
            $sql->execute();
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);

            print_r($data);

            if($data !== "" || null) {

                $loggedUser = new User();
                $loggedUser->id = $data[0]['id'];
                $loggedUser->name = $data[0]['name'];
                $loggedUser->email = $data[0]['email'];

                return $loggedUser;
            }
        }

        return false;
    }

    public static function verifyLogin($email, $password) {
        $pdo = Database::getInstance();

        $sql = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $sql->bindValue(':email', $email);
        $sql->execute();

        $User = $sql->fetchAll(\PDO::FETCH_ASSOC);

        if($User) {
            $hash = $User[0]['password'];
            if(password_verify($password, $hash)) {
                $token = md5(time().rand(0,9999));

                $sql = $pdo->prepare("UPDATE `users` SET `token` = :token WHERE email = :email");
                $sql->bindValue(':email', $email);
                $sql->bindValue(':token', $token);
                $sql->execute();

                return $token;
            } 
        }

        return false;
    }

    public function idExists($id) {
        $User = User::select()->where('id', $id)->one();
        return $User ? true : false;
    }

    public function emailExists($email) {
        $User = User::select()->where('email', $email)->one();
        return $User ? true : false;
    }

    public function getUser($id) {
        $pdo = Database::getInstance();
        $sql = $pdo->prepare("SELECT * FROM users WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        $data = $sql->fetchAll(\PDO::FETCH_ASSOC);
        
        if($data) {
            $user = new User();
            $user->id = $data[0]['id'];
            $user->name = $data[0]['name'];
            $user->email = $data[0]['email'];

            return $user;
        }

    }

    public function addUser($name, $email, $password, $birthdate) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $token =  md5(time().rand(0,9999).time());

        $pdo = Database::getInstance();
        $sql = $pdo->prepare("INSERT INTO users (name, email, password, birthdate, token) VALUES (:name, :email, :password, :birthdate, :token)");
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':password', $hash);
        $sql->bindValue(':birthdate', $birthdate);
        $sql->bindValue(':token', $token);
        $sql->execute();

        return $token;
    }

    public static function updateUser($updateFields, $idUser) {
        $user = User::select()->where('id', $idUser)->one();

        if(isset($updateFields['email'])) {
            User::update()->set('email', $updateFields['email'])->where('id', $idUser)->execute();
        }

        if(isset($updateFields['password'])) {
            $hash = password_hash($updateFields['password'], PASSWORD_DEFAULT);
            User::update()->set('password', $hash)->where('id', $idUser)->execute();
        }

        if(isset($updateFields['avatar'])) {
            User::update()->set('avatar', $updateFields['avatar'])->where('id', $idUser)->execute();
        }
        if(isset($updateFields['city'])) {
            User::update()->set('city', $updateFields['city'])->where('id', $idUser)->execute();
        }
        if(isset($updateFields['work'])) {
            User::update()->set('work', $updateFields['work'])->where('id', $idUser)->execute();
        }

        User::update()->set(
            'name', $updateFields['name'],
            'birthdate', $updateFields['birthdate'],
            'city', $updateFields['city'],
            'work', $updateFields['work']
        )->where('id', $idUser)->execute();
        
    }

}

