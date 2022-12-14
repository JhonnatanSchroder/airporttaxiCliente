<?php
namespace src\controllers;

use \core\Controller;
use \src\models\Airports;
use \src\helpers\AirportHandler;
use \src\helpers\UserHandler;


class AirportController extends Controller {
    public function airports() {
        $airports = AirportHandler::getAirports();
        
        $this->render('/airport/airports', ['airports' => $airports]);
    }

    public function step2($atts) {
        $airport = $atts['airport'];

        $this->render('airport/airport-step2', [
            'airport' => $airport
        ]);
    }

    public function step3($atts) {
        $airport = $atts['airport'];
        $conection = $atts['conection'];

        $flash  = '';
        if(!empty($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            $_SESSION['flash'] = '';
        }

        $this->render('airport/airport-step3', [
            'airport' => $airport,
            'conection' => $conection,
            'flash' => $flash
        ]);
    }

    public function step3Post($atts) {
        $cep_start = filter_input(INPUT_POST, 'cep_start');
        $date_start = filter_input(INPUT_POST, 'date_start');
        $time_start = filter_input(INPUT_POST, 'time_start');
        $passengers = filter_input(INPUT_POST, 'passengers');
        $kids_seats = filter_input(INPUT_POST, 'kids_seats');
        $booster_seats = filter_input(INPUT_POST, 'booster_seats');
        $obs = filter_input(INPUT_POST, 'obs');

        $airport = $atts['airport'];
        $conection = $atts['conection'];

        if($cep_start && $date_start && $time_start && $passengers) {

            if($passengers == 0) {
            $_SESSION['flash'] = 'O numero de passageiros não pode ser 0';
            $this->redirect("/airporttaxi/$airport/$conection/step3");
            }
            $time_start = explode(':', $time_start);
            $date_start = explode('-', $date_start);
            if(count($date_start) != 3) {
                $_SESSION['flash'] = 'Data de partida inválida';
                $this->redirect("/airporttaxi/$airport/$conection/step3");
            }
            $date = $date_start[0].'-'.$date_start[1].'-'.$date_start[2].'-'.$time_start[0].':'.$time_start[1];
            if(strtotime($date) === false) {
                $_SESSION['flash'] = 'Data de partida inválida';
                $this->redirect("/airporttaxi/$airport/$conection/step3");
            }

            AirportHandler::saveOnSection($cep_start, $date, $passengers, $kids_seats, $booster_seats, $obs);

            $this->redirect("/airporttaxi/$airport/$conection/step4");
        } else {
            $this->redirect("/airporttaxi/$airport/$conection/step3");
        }
        
    }

    public function step4($atts) {
        $airport = $atts['airport'];
        $conection = $atts['conection'];

        $this->render('airport/airport-step4', [
            'airport' => $airport,
            'conection' => $conection,
        ]);
    }

    public function step4Post($atts) {
        $conection = $atts['conection'];
        $airport = $atts['airport'];
        $cep_start = $_SESSION['cep_start'];
        $date = $_SESSION['date'];
        $passengers = $_SESSION['passengers'];
        $kids_seats = $_SESSION['kids_seats'];
        $booster_seats = $_SESSION['booster_seats'];
        $obs = $_SESSION['obs'];
        
        $service_type = filter_input(INPUT_POST, 'service_type');
        $name = filter_input(INPUT_POST, 'name');
        $email = filter_input(INPUT_POST, 'email');
        $_SESSION['email'] = $email;
        $telefone = filter_input(INPUT_POST, 'telefone');
        $street = filter_input(INPUT_POST, 'street');
        $cep_end = filter_input(INPUT_POST, 'cep_end');

        if($name && $email && $telefone && $street && $cep_end) {
            AirportHandler::addAirport(
                $cep_start,
                $date,
                $passengers,
                $kids_seats,
                $booster_seats,
                $obs,
                $name,
                $email,
                $telefone,
                $street,
                $cep_end,
                $conection,
                $airport
            );

            $this->redirect("/airporttaxi/$airport/$conection/step5");
        }
    }

    public function step5($atts){
        $order = AirportHandler::getLastOrder($_SESSION['email']);

        $this->render('airport/airports-step5', [
            'order' => $order
        ]);
    }

    public function logout() {
        $_SESSION['token'] ='';

        $this->redirect('/login');
    }
    public function thankPage() {

        $this->render('thankpage');
    }
 
}