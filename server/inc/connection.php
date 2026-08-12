<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

$con = mysqli_connect(
    'localhost',
    'root',
    '',
    'royal_express_db'
);

if (!$con) {
    error_log('Database connection failed: ' . mysqli_connect_error());

    http_response_code(500);
    exit('An internal server error occurred. Please try again later.');
}