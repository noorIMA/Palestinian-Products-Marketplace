<?php

include 'dbconfig.in.php';

session_start();
session_unset();
session_destroy();

header('location:login.php');

?>