<?php
namespace src\helpers;

use \core\Database;
use \src\Config;
use \src\models\Airport;
use \src\models\Limousine;


class LimousineHandler {


    public static function addOrder(
        $date,
        $street,
        $cep_start,
        $passengers,
        $kids_seats,
        $booster_seats,
        $obs,
        $how,
        $name,
        $email,
        $phone,
        $id_user
    ) { 

        $pdo = Database::getInstance();
        $sql = $pdo->prepare("INSERT INTO `limousine` (`id`,`date`, `street`, `cep_start`, `passengers`, `kids_seats`, `booster_seats`, `obs`, `how`,`name`, `email`, `phone`,`id_user`)
         VALUES (NULL, :date, :street, :cep_start, :date,
         :passengers, :kids_seats, :booster_seats, :obs, :how, :name, :email, :phone, :id_user);");
        $sql->bindValue(':date', $date);
        $sql->bindValue(':street', $street);
        $sql->bindValue(':cep_start', $cep_start);
        $sql->bindValue(':passengers', $passengers);
        $sql->bindValue(':kids_seats', $kids_seats);
        $sql->bindValue(':booster_seats', $booster_seats);
        $sql->bindValue(':obs', $obs);
        $sql->bindValue(':how', $how);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();
    }

    public function getLastOrder($id_user) {
        $pdo = Database::getInstance();
        $sql = $pdo->query("SELECT * FROM `limousine` WHERE id_user = $id_user ORDER BY id DESC");

        if($sql->rowCount() != 0) {
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);
            $LimousineOrder = new Limousine();
            $LimousineOrder->date = $data[0]['date'];
            $LimousineOrder->street= $data[0]['street'];
            $LimousineOrder->cep_start = $data[0]['cep_start'];
            $LimousineOrder->passengers = $data[0]['passengers'];
            $LimousineOrder->kids_seats = $data[0]['kids_seats'];
            $LimousineOrder->booster_seats = $data[0]['booster_seats'];
            $LimousineOrder->obs = $data[0]['obs'];
            $LimousineOrder->how = $data[0]['how'];
            $LimousineOrder->name = $data[0]['name'];
            $LimousineOrder->email = $data[0]['email'];
            $LimousineOrder->phone = $data[0]['phone'];

            return $LimousineOrder;
        }

    }
}