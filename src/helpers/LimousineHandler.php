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
        $phone
    ) { 

         Limousine::insert([
            'date' => $date,
            'street' => $street,
            'cep_start' => $cep_start,
            'passengers' => $passengers,
            'kids_seats' => $kids_seats,
            'booster_seats' => $booster_seats,
            'obs' => $obs,
            'how' => $how,
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ]);
    }

    public function getLastOrder($name) {
        $data = Limousine::select()->where('name', $name)->one();

        if(isset($data)) {
            $LimousineOrder = new Limousine();
            $LimousineOrder->date = $data['date'];
            $LimousineOrder->street = $data['street'];
            $LimousineOrder->cep_start = $data['cep_start'];
            $LimousineOrder->passengers = $data['passengers'];
            $LimousineOrder->kids_seats = $data['kids_seats'];
            $LimousineOrder->booster_seats = $data['booster_seats'];
            $LimousineOrder->obs = $data['obs'];
            $LimousineOrder->how = $data['how'];
            $LimousineOrder->name = $data['name'];
            $LimousineOrder->email = $data['email'];
            $LimousineOrder->phone = $data['phone'];

            return $LimousineOrder;
        }

    }
}