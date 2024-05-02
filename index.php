<?php

// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');

//require the model
require_once ('model/data-layer.php');

// Instantiate the F3 Base Class
$f3 = Base::instance();

// define default route
$f3->route('GET /', function(){
    //echo '<h1>Hello Fat-Free!</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('view/home.html');
});

// survey
$f3->route('GET|POST /survey/midterms', function($f3) {

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {



        // Get the data from the post array
        $name = $_POST['name'];
        $survey = $_POST['survey'];


        if(true){
            // Add the data to the session array
            $f3->set('SESSION.name', $name);
            $f3->set('SESSION.survey', $survey);

            // Send the user to the next form
            $f3->reroute('summary');

        }

        else {
            // Temporary
            echo "<p>Validation errors</p>";
        }
    }

    // get data from the model
    $surveys = getSurvey();
    $f3->set('survey', $surveys);

    // Render a view page
    $view = new Template();
    echo $view->render('view/survey.html');
});





// Run Fat-Free
$f3->run();
