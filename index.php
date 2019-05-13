<?php


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Required file
require_once('vendor/autoload.php');
require_once('model/validate.php');

//Start a session
session_start();

//Instantiate Fat-Free
$f3 = Base::instance();

//Turn on Fat-Free error reporting
$f3->set('DEBUG', 3);

$f3->set('options', ['This midterm is awesome', 'I love midterms', 'Looks like somebody has a case of the Mondays']);


//Define a default route
$f3->route('GET /', function() {

    echo "<header>Midterm Survey</header>";
    echo "<a href='survey'>Take my Midterm Survey</a>";
});

//Define an order route
$f3->route('GET|POST /survey', function($f3) {

//Define arrays

    if (!empty($_POST)){
        //Get data from form
        $name = $_POST['name'];
        $options = $_POST['options'];

        //Add data to hive
        $f3->set('options', $options);
        $f3->set('name', $name);

        //If data is valid
        if (validForm()) {

            //Write data to Session
            $_SESSION['options'] = $options;
            $_SESSION['name'] = $name;

            //Redirect to Summary
            $f3->reroute('/summary');
        }
    }
        //Display order form
        $view = new Template();
        echo $view->render('views/survey.html');
});

//Define a summary route
$f3->route('GET /summary', function($f3) {

    $f3->set('testArray', implode(', ', $_SESSION['options']));


    //Display summary
    $view = new Template();
    echo $view->render('views/summary.html');
});

//Run Fat-Free
$f3->run();