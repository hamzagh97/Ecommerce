<?php 
session_start();
if (isset($_SESSION['Username'])) {
  
  $pagetitle = 'dashboard';

  include 'init.php';


} else {
  header('location: index.php');
  exit();
};



