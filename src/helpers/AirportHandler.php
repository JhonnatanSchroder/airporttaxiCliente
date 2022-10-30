<?php
namespace src\helpers;

use \core\Database;
use \src\Config;
use \src\models\Airports;
use \src\models\AirportOrders;


class AirportHandler {
    
    public static function getAirports() {
        $data = Airports::select()->execute();

        $airports = new Airports();
        $airports->data = [];

        foreach($data as $airport) {
            $newAirport = new Airports();
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
        $cep_start, $date, $passengers, $kids_seats, $booster_seats,
        $obs, $name, $email, $number, $street_name, $cep_end, $conection,$airport
    ) { 
        AirportOrders::insert([
            'cep_start' => $cep_start,
            'date_start' => $date,
            'passengers' => $passengers,
            'kids_seats' => $kids_seats,
            'booster_seats' => $booster_seats,
            'obs' => $obs,
            'name' => $name,
            'email' => $email,
            'phone' => $number,
            'street_name' => $street_name,
            'cep_end' => $cep_end,
            'conection' => $conection,
            'airport' => $airport,
        ])->execute();
       
    }

    public function getLastOrder($email) {
        $data = AirportOrders::select()->where('email', $email)orderBy('id', 'desc')->one();

        if(isset($data)) {
            $airportOrder = new AirportOrders();
            $airportOrder->cep_start = $data['cep_start'];
            $airportOrder->date = $data['date_start'];
            $airportOrder->passengers = $data['passengers'];
            $airportOrder->kids_seats = $data['kids_seats'];
            $airportOrder->booster_seats = $data['booster_seats'];
            $airportOrder->obs = $data['obs'];
            $airportOrder->name_user = $data['name'];
            $airportOrder->email = $data['email'];
            $airportOrder->telefone = $data['phone'];
            $airportOrder->street_name = $data['street_name'];
            $airportOrder->cep_end = $data['cep_end'];
            $airportOrder->conection = $data['conection'];
            $airportOrder->service_type = $data['service_type'];
            $airportOrder->airport = $data['airport'];

            return $airportOrder;
        }

    }
}