<?php
namespace src\helpers;

use \core\Database;
use \src\Config;
use \src\models\Airport;
use \src\models\TaxiOrder;


class AirportHandler {
    
    public static function getAirports() {
        $data = Airport::select()->execute();

        $airports = new Airport();
        $airports->data = [];

        foreach($data as $airport) {
            $newAirport = new Airport();
            $newAirport->name = strtolower($airport['name']);
            $newAirport->image = $airport['image'];

            $airports->data[] = $newAirport;
        }

        return $airports;
        
    }

    public static function saveOnSection($cep, $date, $passengers, $kids, $booster, $obs) {
        $_SESSION['cep_start'] = $cep;
        $_SESSION['date'] = $date;
        $_SESSION['passengers'] = $passengers;
        $_SESSION['kids_seats'] = $kids;
        $_SESSION['booster_seats'] = $booster;
        $_SESSION['obs'] = $obs;
    }

    public static function addAirport(
        $cep_start, $date, $passengers, $kids_seats = null, $booster_seats = null,
        $obs = null, $name, $email, $number, $street_name, $cep_end, $conection, $service_type, $airport, $id_user
    ) { 

        $pdo = Database::getInstance();
        $sql = $pdo->prepare("INSERT INTO `taxiorder` (`id`, `cep_start`, `date_start`, `passengers`, `kids_seats`, `booster_seats`, `obs`, `name_user`, `email`, `telefone`, `street_name`, `cep_end`, `conection`, `service_type`, `airport`, `id_user`)
         VALUES (NULL, :cep_start, :date, :passengers, :kids_seats, :booster_seats, :obs, :name, :email, :number, :street_name, :cep_end, :conection, :service_type, :airport, :id_user);");
        $sql->bindValue(':cep_start', $cep_start);
        $sql->bindValue(':date', $date);
        $sql->bindValue(':passengers', $passengers);
        $sql->bindValue(':kids_seats', $kids_seats);
        $sql->bindValue(':booster_seats', $booster_seats);
        $sql->bindValue(':obs', $obs);
        $sql->bindValue(':name', $name);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':number', $number);
        $sql->bindValue(':street_name', $street_name);
        $sql->bindValue(':cep_end', $cep_end);
        $sql->bindValue(':conection', $conection);
        $sql->bindValue(':service_type', $service_type);
        $sql->bindValue(':airport', $airport);
        $sql->bindValue(':id_user', $id_user);
        $sql->execute();
        

    }

    public function getLastOrder($id_user) {
        $pdo = Database::getInstance();
        $sql = $pdo->query("SELECT * FROM `taxiorder` WHERE id_user = $id_user ORDER BY id DESC");

        if($sql->rowCount() != 0) {
            $data = $sql->fetchAll(\PDO::FETCH_ASSOC);
            $taxiOrder = new TaxiOrder();
            $taxiOrder->cep_start = $data[0]['cep_start'];
            $taxiOrder->date = $data[0]['date_start'];
            $taxiOrder->passengers = $data[0]['passengers'];
            $taxiOrder->kids_seats = $data[0]['kids_seats'];
            $taxiOrder->booster_seats = $data[0]['booster_seats'];
            $taxiOrder->obs = $data[0]['obs'];
            $taxiOrder->name_user = $data[0]['name_user'];
            $taxiOrder->email = $data[0]['email'];
            $taxiOrder->telefone = $data[0]['telefone'];
            $taxiOrder->street_name = $data[0]['street_name'];
            $taxiOrder->cep_end = $data[0]['cep_end'];
            $taxiOrder->conection = $data[0]['conection'];
            $taxiOrder->service_type = $data[0]['service_type'];
            $taxiOrder->airport = $data[0]['airport'];

            return $taxiOrder;
        }

    }
}