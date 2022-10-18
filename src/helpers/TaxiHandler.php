<?php
namespace src\helpers;

use \core\Database;
use \src\Config;
use \src\models\Airport;
use \src\models\TaxiOrder;


class TaxiHandler {


    public static function addOrder(
        $street_start,
        $cep_start,
        $city_start,
        $street_end,
        $cep_end,
        $city_end,
        $date,
        $passengers,
        $kids_seats,
        $booster_seats,
        $obs,
        $conection,
        $name,
        $email,
        $phone,
        $service_type,
        $id_user
    ) { 

        $pdo = Database::getInstance();
        $sql = $pdo->prepare("INSERT INTO `taxi` (`id`, `street_start`, `cep_start`, `city_start`, `street_end`, `cep_end`, `city_end`, `date_start`, `passengers`, `kids_seats`, `booster_seats`, `obs`, `conection`, `name`, `email`, `phone`, `service_type`, `id_user`)
         VALUES (NULL, :street_start, :cep_start, :city_start, :street_end, :cep_end, :city_end, :date,
         :passengers, :kids_seats, :booster_seats, :obs, :conection, :name, :email, :phone, :service_type, :id_user);");
        $sql->bindValue(':street_start', $street_start);
        $sql->bindValue(':cep_start', $cep_start);
        $sql->bindValue(':city_start', $city_start);
        $sql->bindValue(':street_end', $street_end);
        $sql->bindValue(':cep_end', $cep_end);
        $sql->bindValue(':city_end', $city_end);
        $sql->bindValue(':date', $date);
        $sql->bindValue(':passengers', $passengers);
        $sql->bindValue(':kids_seats', $kids_seats);
        $sql->bindValue(':booster_seats', $booster_seats);
        $sql->bindValue(':obs', $obs);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':phone', $phone);
        $sql->bindValue(':conection', $conection);
        $sql->bindValue(':service_type', $service_type);
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();
        

    }

    public function getLastOrder($id_user) {
        $pdo = Database::getInstance();
        $sql = $pdo->query("SELECT * FROM `taxi` WHERE id_user = $id_user ORDER BY id DESC");

        if($sql->rowCount() != 0) {
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);
            $taxiOrder = new TaxiOrder();
            $taxiOrder->street_start = $data[0]['street_start'];
            $taxiOrder->cep_start = $data[0]['cep_start'];
            $taxiOrder->city_start = $data[0]['city_start'];
            $taxiOrder->street_end = $data[0]['street_end'];
            $taxiOrder->cep_end = $data[0]['cep_end'];
            $taxiOrder->city_end = $data[0]['city_end'];
            $taxiOrder->date = $data[0]['date_start'];
            $taxiOrder->passengers = $data[0]['passengers'];
            $taxiOrder->kids_seats = $data[0]['kids_seats'];
            $taxiOrder->booster_seats = $data[0]['booster_seats'];
            $taxiOrder->obs = $data[0]['obs'];
            $taxiOrder->conection = $data[0]['conection'];
            $taxiOrder->name = $data[0]['name'];
            $taxiOrder->email = $data[0]['email'];
            $taxiOrder->phone = $data[0]['phone'];

            return $taxiOrder;
        }

    }
}