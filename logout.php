<?php
include_once "./includes/dbconnect.php";
session_start();
session_unset();
session_destroy();
header("Location:/login.php");
exit();
