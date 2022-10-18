<?php
namespace src\controllers;

use \core\Controller;
use \src\helpers\LimousineHandler;
use \src\helpers\BusHandler;
use \src\helpers\UserHandler;

class BusController extends Controller {
    private $loggedUser;

    public function __construct() {
        $this->loggedUser = UserHandler::checkLogin();
        if( $this->loggedUser === false) {
            $this->redirect('/login');
        }    
    }

   public function index() {
    $flash = '';
    if(!empty($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        $_SESSION['flash'] = '';
    }

    $this->render('bus/bus', [
        'flash' => $flash
    ]);
   }

   public function indexAction() {
    $date_start = filter_input(INPUT_POST, 'date_start');
    $time_start = filter_input(INPUT_POST, 'time_start');
    $cep_start = filter_input(INPUT_POST, 'cep_start');
    $street = filter_input(INPUT_POST, 'street');

    if($date_start && $time_start && $cep_start) {
        $date_start = explode('/', $date_start);
        if(count($date_start) != 3) {
            $_SESSION['flash'] = 'Data de partida inválida';
            $this->redirect('/bus');
        }

        $time_start = explode(':', $time_start);
        if(count($time_start) != 2) {
            $_SESSION['flash'] = 'Data de partida inválida';
            $this->redirect('/bus');
        }

        $date = "$date_start[0]-$date_start[1]-$date_start[2]".' '."$time_start[0]:$time_start[1]";
        if(strtotime($date) === false) {
            $_SESSION['flash'] = 'Data de partida inválida';
            $this->redirect('/bus');
        }
        $_SESSION['date'] = $date;
        $_SESSION['cep_start'] = $cep_start;
        $_SESSION['street'] = $street;

        $this->redirect('/bus/step2');
    } else {
        $this->redirect('/bus');
    }


   }

   public function step2() {

    $this->render('bus/bus-step2');
   }

   public function step2Action() {
    $passengers = filter_input(INPUT_POST, 'passengers');
    $obs = filter_input(INPUT_POST, 'obs');

    if($passengers) {
        $_SESSION['passengers'] = $passengers;
        $_SESSION['obs'] = $obs;

        $this->redirect('/bus/step3');
    } else {
        $this->redirect('/bus/step2');
    }

   }

   public function step3() {
    $user = UserHandler::getUser($this->loggedUser->id);


    $this->render('bus/bus-step3', [
        'user' => $user
    ]);
   }

   public function step3Action() {
    $name = filter_input(INPUT_POST, 'name');
    $email = filter_input(INPUT_POST, 'email');
    $phone = filter_input(INPUT_POST, 'phone');
    $how = filter_input(INPUT_POST, 'how');

    $date = $_SESSION['date'];
    $cep_start = $_SESSION['cep_start'];
    $street = $_SESSION['street'];
    $passengers = $_SESSION['passengers'];
    $obs = $_SESSION['obs'];

    if($name && $email && $phone) {
        BusHandler::addOrder(
            $date,
            $street, 
            $cep_start,
            $passengers,
            $obs,
            $how,
            $name,
            $email,
            $phone,
            $this->loggedUser->id
        );
        $this->redirect('/bus/step4');
    } else {
        $this->redirect('/bus/step3');

    }
   }

   public function step4() {
    $order = BusHandler::getLastOrder($this->loggedUser->id);

    $this->render('bus/bus-step4', [
        'order' => $order
    ]);
   }
}