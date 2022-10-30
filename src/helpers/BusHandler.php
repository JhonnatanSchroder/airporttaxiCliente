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
        $phone
    ) { 

        Bus::insert([
            'date' => $date,
            'street' => $street,
            'cep_start' => $cep_start,
            'passengers' => $passengers,
            'obs' => $obs,
            'how' => $how,
            'name' => $name,
            'email' => $email,
            'phone' => $phone
        ]);
    }

    public function getLastOrder($email) {
        $data = Bus::select()->where('email', $email)orderBy('id', 'desc')->one();
        
        if(isset($data)) {
            $BusOrder = new Bus();
            $BusOrder->date = $data['date'];
            $BusOrder->street = $data['street'];
            $BusOrder->cep_start = $data['cep_start'];
            $BusOrder->passengers = $data['passengers'];
            $BusOrder->obs = $data['obs'];
            $BusOrder->how = $data['how'];
            $BusOrder->name = $data['name'];
            $BusOrder->email = $data['email'];
            $BusOrder->phone = $data['phone'];

            return $BusOrder;
        }

    }
}