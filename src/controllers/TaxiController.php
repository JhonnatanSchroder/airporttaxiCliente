<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Airports;
use \src\helpers\TaxiHandler;
use \src\helpers\UserHandler;


class TaxiController extends Controller {
    public function index() {


        $this->render('taxi/taxi');
    }

    public function step2($atts) {
        $conection =  $atts['conection'];
        

        if($conection != 'toDestiny' && $conection != 'fromToDestiny') {
            $this->redirect('taxi/taxi');
        }
        $this->render('taxi/taxi-step2', [
            'conection' => $conection
        ]);
    }

    public function step2Action($atts) {
       $stree_start = filter_input(INPUT_POST, 'street_start');
        $cep_start = filter_input(INPUT_POST, 'cep_start');
        $city_start = filter_input(INPUT_POST, 'city_start');

        $conection = $atts['conection'];

        if($stree_start && $cep_start && $city_start) {
            $_SESSION['street_start'] = $stree_start;
            $_SESSION['cep_start'] = $cep_start;
            $_SESSION['city_start'] = $city_start;

            $this->redirect("/taxi/$conection/step3");
        } else {
            $this->redirect("/taxi/$conection/step2");
        }

    }

    public function step3($atts) {
        $conection =  $atts['conection'];

        $this->render('taxi/taxi-step3', [
            'conection' => $conection
        ]);
    }

    public function step3Action($atts) {
        $stree_end = filter_input(INPUT_POST, 'street_end');
        $cep_end = filter_input(INPUT_POST, 'cep_end');
        $city_end = filter_input(INPUT_POST, 'city_end');

        $conection = $atts['conection'];

        if($stree_end && $cep_end && $city_end) {
            $_SESSION['street_end'] = $stree_end;
            $_SESSION['cep_end'] = $cep_end;
            $_SESSION['city_end'] = $city_end;

            $this->redirect("/taxi/$conection/step4");
        } else {
            $this->redirect("/taxi/$conection/step3");
        }

        $this->redirect("/taxi/$conection/step4");
    }

    public function step4($atts) {
        $conection =  $atts['conection'];
        $flash = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('taxi/taxi-step4', [
            'conection' => $conection,
        ]);
    }

    public function step4Action($atts) {
        $date_start = filter_input(INPUT_POST, 'date_start');
        $time_start = filter_input(INPUT_POST, 'time_start');
        $conection =  $atts['conection'];

        if($date_start && $time_start) {
            $date_start = explode('-', $date_start);
            if(count($date_start) != 3) {
                $_SESSION['flash'] = 'Data de partida inválida';
                $this->redirect("/taxi/$conection/step4");
            }

            $time_start = explode(':', $time_start);
            if(count($time_start) != 2) {
                $_SESSION['flash'] = 'Data de partida inválida';
                $this->redirect("/taxi/$conection/step4");
            }

            $date =  $date_start[0].'-'.$date_start[1].'-'.$date_start[2].'-'.$time_start[0].':'.$time_start[1];

            if(strtotime($date) === false) {
                $_SESSION['flash'] = 'Data de partida inválida';
                $this->redirect("/taxi/$conection/step4");
            }

            $_SESSION['date'] = $date;
            $this->redirect("/taxi/$conection/step5");
        }
    }

    public function step5($atts) {
        $conection =  $atts['conection'];


        $this->render('taxi/taxi-step5', [
            'conection' => $conection,
        ]);
    }

    public function step5Action($atts) {
       $passengers = filter_input(INPUT_POST, 'passengers');
       $kids_seats = filter_input(INPUT_POST, 'kids_seats');
       $booster_seats = filter_input(INPUT_POST, 'booster_seats');
       $obs = filter_input(INPUT_POST, 'obs');

       $conection =  $atts['conection'];

       if($passengers) {
        $_SESSION['passengers'] = $passengers;
        $_SESSION['kids_seats'] = $kids_seats;
        $_SESSION['booster_seats'] = $booster_seats;
        $_SESSION['obs'] = $obs;

        $this->redirect("/taxi/$conection/step6");
       } else {
        $this->redirect("/taxi/$conection/step5");
       }


    }

    public function step6($atts) {
        $conection =  $atts['conection'];

        $this->render('taxi/taxi-step6', [
            'conection' => $conection,
        ]);
    }

    public function step6Action($atts) {
        $name = filter_input(INPUT_POST, 'name');
        $_SESSION['name'] = $name;
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');

        $conection =  $atts['conection'];

        $street_start = $_SESSION['street_start'];
        $cep_start = $_SESSION['cep_start'];
        $city_start = $_SESSION['city_start'];
        $cep_end = $_SESSION['cep_end'];
        $city_end = $_SESSION['city_end'];
        $street_end = $_SESSION['street_end'];
        $date = $_SESSION['date'];
        $passengers = $_SESSION['passengers'];
        $kids_seats = $_SESSION['kids_seats'];
        $booster_seats = $_SESSION['booster_seats'];
        $obs = $_SESSION['obs'];
       
        if($name && $email && $phone && $passengers) {
            TaxiHandler::addOrder(
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
            );

            // $this->redirect("/taxi/$conection/step7");
        } else {
            // $this->redirect("/taxi/$conection/step6");

        }

    }

    public function step7($atts) {
        $order = TaxiHandler::getLastOrder($_SESSION['name']);


        $this->render('taxi/taxi-step7', [
            'order' => $order,
        ]);
    }
 
}