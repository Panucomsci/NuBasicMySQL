<?php

$server = 'localhost';
$user = 'root';
$pass = '';
$db = 'records';

$connect = mysqli_connect($server, $user, $pass, $db);
mysqli_report(MYSQLI_REPORT_ERROR);

?>