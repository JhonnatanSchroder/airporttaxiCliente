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
        $User = User::select()->where('email', $email)->one();

        if($User) {
            if(password_verify($password, $User['password'])) {
                $token = md5(time().rand(0,9999).time());

                User::update()->set('token', $token)->where('email', $email)->execute();
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

        User::insert([
            'name' => $name,
            'email' => $email,
            'password' => $hash,
            'birthdate' => $birthdate,
            'token' => $token
        ])->execute();

        return $token;
    }

    public static function isFollowing($from, $to) {
        $data = UserRelations::select()
            ->where('user_from', $from)
            ->where('user_to', $to)
        ->one();

        if($data) {
            return true;
        }

        return false;
    }

    public static function follow($from, $to) {
        UserRelations::insert([
            'id' => null,
            'user_from' => $from,
            'user_to' => $to
        ])->execute();
        
    }

    public static function unfollow($from, $to) {
        UserRelations::delete()
            ->where('user_from', $from)
            ->where('user_to', $to)
        ->execute();
    }

    public static function searchUser($term) {
        $users = [];
        $data = User::select()->where('name', 'like', "%$term%")->get();

        if($data) {
            foreach($data as $user) {

                $newUser = new User();
                $newUser->id = $user['id'];
                $newUser->name = $user['name'];
                $newUser->avatar = $user['avatar'];

                $users[] = $newUser;
            }

        }

        return $users;

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

