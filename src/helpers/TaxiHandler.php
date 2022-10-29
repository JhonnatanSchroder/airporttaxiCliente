<?php
namespace src\helpers;

use \core\Database;
use \src\Config;
use \src\models\Airport;
use \src\models\TaxiOrders;


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
        $phone
    ) { 

        TaxiOrders::insert([
            'street_start' => $street_start,
            'cep_start' => $cep_start,
            'city_start' => $city_start,
            'street_end' => $street_end,
            'cep_end' => $cep_end,
            'city_end' => $city_end,
            'date_start' => $date,
            'passengers' => 1,
            'kids_seats' => 1,
            'booster_seats' => 1,
            'obs' => $obs,
            'conection' => $conection,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
        ])->execute();

    }

    public function getLastOrder($name) {
        $data = TaxiOrders::select()->where('name', $name)->one();

        if(isset($data)) {
            $taxiOrder = new TaxiOrders();
            $taxiOrder->street_start = $data['street_start'];
            $taxiOrder->cep_start = $data['cep_start'];
            $taxiOrder->city_start = $data['city_start'];
            $taxiOrder->street_end = $data['street_end'];
            $taxiOrder->cep_end = $data['cep_end'];
            $taxiOrder->city_end = $data['city_end'];
            $taxiOrder->date = $data['date_start'];
            $taxiOrder->passengers = $data['passengers'];
            $taxiOrder->kids_seats = $data['kids_seats'];
            $taxiOrder->booster_seats = $data['booster_seats'];
            $taxiOrder->obs = $data['obs'];
            $taxiOrder->conection = $data['conection'];
            $taxiOrder->name = $data['name'];
            $taxiOrder->email = $data['email'];
            $taxiOrder->phone = $data['phone'];

            return $taxiOrder;
        }

    }
}