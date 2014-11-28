<?php 

header('Access-Control-Allow-Origin: *');

session_start();

require dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'api' . DIRECTORY_SEPARATOR . 'bootstrap.php';