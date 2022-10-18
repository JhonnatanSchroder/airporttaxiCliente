<?php
namespace src\controllers;

use \core\Controller;

class PagesController extends Controller {

    public function about() {
        $this->render('aboutUs');

    }

    public function contact() {

        $this->render('contact');
    }

    public function impressao() {
        $this->render('impressao');
    }

    public function politics() {
        $this->render('politics');
    }

    public function terms() {
        $this->render('terms');
    }
} 