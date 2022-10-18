<?php
namespace src\helpers;

use \core\Database;
use \src\Config;
use \src\models\Airport;
use \src\models\Bus;


class BusHandler {


    public static function addOrder(
        $date,
        $street,
        $cep_start,
        $passengers,
        $obs,
        $how,
        $name,
        $email,
        $phone,
        $id_user
    ) { 

        $pdo = Database::getInstance();
        $sql = $pdo->prepare("INSERT INTO `bus` (`id`,`date`, `street`, `cep_start`, `passengers`, `obs`, `how`, `name`, `email`, `phone`,`id_user`)
         VALUES (NULL, :date, :street, :cep_start,:passengers, :obs, :how, :name, :email, :phone, :id_user);");
        $sql->bindValue(':date', $date);
        $sql->bindValue(':street', $street);
        $sql->bindValue(':cep_start', $cep_start);
        $sql->bindValue(':passengers', $passengers);
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
        $sql = $pdo->query("SELECT * FROM `bus` WHERE id_user = $id_user ORDER BY id DESC");

        if($sql->rowCount() != 0) {
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);
            $BusOrder = new Bus();
            $BusOrder->date = $data[0]['date'];
            $BusOrder->street = $data[0]['street'];
            $BusOrder->cep_start = $data[0]['cep_start'];
            $BusOrder->passengers = $data[0]['passengers'];
            $BusOrder->obs = $data[0]['obs'];
            $BusOrder->how = $data[0]['how'];
            $BusOrder->name = $data[0]['name'];
            $BusOrder->email = $data[0]['email'];
            $BusOrder->phone = $data[0]['phone'];

            return $BusOrder;
        }

    }
}