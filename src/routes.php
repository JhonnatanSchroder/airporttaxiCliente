<?php
use core\Router;

$router = new Router();

$router->get('/', 'AirportController@airports');

$router->get('/aboutUs', "PagesController@about");
$router->get('/contact', "PagesController@contact");

$router->get('/impressao', "PagesController@impressao");
$router->get('/politics', "PagesController@politics");
$router->get('/terms', "PagesController@terms");

// AIRPORT ROUTES

$router->get('/airporttaxi/{airport}/step2', 'AirportController@step2');

$router->get('/airporttaxi/{airport}/{conection}/step3', 'AirportController@step3');
$router->post('/airporttaxi/{airport}/{conection}/step3', 'AirportController@step3Post');

$router->get('/airporttaxi/{airport}/{conection}/step4', 'AirportController@step4');
$router->post('/airporttaxi/{airport}/{conection}/step4', 'AirportController@step4Post');

$router->get('/airporttaxi/{airport}/{conection}/step5', 'AirportController@step5');

$router->get('/login', 'LoginController@login');
$router->post('/login', 'LoginController@loginPost');

$router->get('/register', 'LoginController@register');
$router->post('/register', 'LoginController@registerPost');

// TÁXI ROUTES

$router->get('/taxi', 'TaxiController@index');

$router->get('/taxi/{conection}/step2', 'TaxiController@step2');
$router->post('/taxi/{conection}/step2Action', 'TaxiController@step2Action');

$router->get('/taxi/{conection}/step3', 'TaxiController@step3');
$router->post('/taxi/{conection}/step3', 'TaxiController@step3Action');

$router->get('/taxi/{conection}/step4', 'TaxiController@step4');
$router->post('/taxi/{conection}/step4', 'TaxiController@step4Action');

$router->get('/taxi/{conection}/step5', 'TaxiController@step5');
$router->post('/taxi/{conection}/step5', 'TaxiController@step5Action');

$router->get('/taxi/{conection}/step6', 'TaxiController@step6');
$router->post('/taxi/{conection}/step6', 'TaxiController@step6Action');

$router->get('/taxi/{conection}/step7', 'TaxiController@step7');
$router->get('/thankpage', 'AirportController@thankpage');

// LIMOUSINE ROUTES

$router->get('/limousine', "LimousineController@index");
$router->post('/limousine', "LimousineController@indexAction");

$router->get('/limousine/step2', "LimousineController@step2");
$router->post('/limousine/step2', "LimousineController@step2Action");

$router->get('/limousine/step3', "LimousineController@step3");
$router->post('/limousine/step3', "LimousineController@step3Action");

$router->get('/limousine/step4', "LimousineController@step4");

// BUS TOUTES

$router->get('/bus', "BusController@index");
$router->post('/bus', "BusController@indexAction");

$router->get('/bus/step2', "BusController@step2");
$router->post('/bus/step2', "BusController@step2Action");

$router->get('/bus/step3', "BusController@step3");
$router->post('/bus/step3', "BusController@step3Action");

$router->get('/bus/step4', "BusController@step4");