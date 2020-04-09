<?php
require('controller/frontend.php');

try {
    session_start();
    if (isset($_GET['action'])) { 
        if ($_GET['action'] == 'home') {
            afficheHome();
        }
}
    else { //si il il n'y a pas d'action
        afficheHome();
    }
    } // fin du try
catch(Exception $e) { // S'il y a eu une erreur, alors...
    $errorMessage = $e->getMessage();
    require('view/frontend/errorView.php');
}