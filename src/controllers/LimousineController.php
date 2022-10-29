<?php
namespace src\controllers;

use \core\Controller;
use \src\helpers\LimousineHandler;
use \src\helpers\UserHandler;

class LimousineController extends Controller {

   public function index() {
    $flash = '';
    if(!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }

    $this->render('limousine/limousine', [
        'flash' => $flash
    ]);
   }

   public function indexAction() {
    $date_start = filter_input(INPUT_POST, 'date_start');
    $time_start = filter_input(INPUT_POST, 'time_start');
    $cep_start = filter_input(INPUT_POST, 'cep_start');
    $street = filter_input(INPUT_POST, 'street');

    if($date_start && $time_start && $cep_start) {
        $date_start = explode('-', $date_start);
        if(count($date_start) != 3) {
            $_SESSION['flash'] = 'Data de partida inválida';
            $this->redirect('/limousine');
        }

        $time_start = explode(':', $time_start);
        if(count($time_start) != 2) {
            $_SESSION['flash'] = 'Data de partida inválida';
            $this->redirect('/limousine');
        }

        $date = "$date_start[0]-$date_start[1]-$date_start[2]".' '."$time_start[0]:$time_start[1]";
        if(strtotime($date) === false) {
            $_SESSION['flash'] = 'Data de partida inválida';
            $this->redirect('/limousine');
        }
        $_SESSION['date'] = $date;
        $_SESSION['cep_start'] = $cep_start;
        $_SESSION['street'] = $street;

        $this->redirect('/limousine/step2');
    } else {
        $this->redirect('/limousine');
    }


   }

   public function step2() {

    $this->render('limousine/limousine-step2');
   }

   public function step2Action() {
    $passengers = filter_input(INPUT_POST, 'passengers');
    $kids_seats = filter_input(INPUT_POST, 'kids_seats');
    $booster_seats = filter_input(INPUT_POST, 'booster_seats');
    $obs = filter_input(INPUT_POST, 'obs');

    if($passengers) {
        $_SESSION['passengers'] = $passengers;
        $_SESSION['kids_seats'] = $kids_seats;
        $_SESSION['booster_seats'] = $booster_seats;
        $_SESSION['obs'] = $obs;

        $this->redirect('/limousine/step3');
    } else {
        $this->redirect('/limousine/step2');
    }

   }

   public function step3() {


    $this->render('limousine/limousine-step3');
   }

   public function step3Action() {
    $name = filter_input(INPUT_POST, 'name');
    $_SESSION['name'] = $name;
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $how = filter_input(INPUT_POST, 'how');

    $date = $_SESSION['date'];
    $cep_start = $_SESSION['cep_start'];
    $street = $_SESSION['street'];
    $passengers = $_SESSION['passengers'];
    $kids_seats = $_SESSION['kids_seats'];
    $booster_seats = $_SESSION['booster_seats'];
    $obs = $_SESSION['obs'];

    if($name && $email && $phone) {
        LimousineHandler::addOrder(
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
        );
        $this->redirect('/limousine/step4');
    } else {
        $this->redirect('/limousine/step3');

    }
   }

   public function step4() {
    $order = LimousineHandler::getLastOrder($_SESSION['name']);

    $this->render('limousine/limousine-step4', [
        'order' => $order
    ]);
   }
}