<?php

ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');
error_reporting(E_ALL);

try {
    $con = mysqli_connect(
        'localhost',
        'root',
        '',
        'royal_express_db'
    );
} catch (mysqli_sql_exception $e) {
    error_log('Database connection failed: ' . $e->getMessage());

    http_response_code(500);
    exit('An internal server error occurred. Please try again later.');
}