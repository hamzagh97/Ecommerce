<?php 

include "connect.php";

// Routes

$tp1 = 'includes/templates/';
$css = 'layout/css/';
$js  = 'layout/js/';
$func = 'includes/functions/';

include $func . 'functions.php';
include $tp1 . 'header.php';
include $tp1 . 'footer.php';

if (!isset($noNavbar)) {
    include $tp1 . 'navbar.php';
};
