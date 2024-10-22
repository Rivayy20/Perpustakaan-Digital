<?php 
session_start();

session_unset();

session_destroy();

header('location: ../PRAUKrentalV2/index.php');
?>