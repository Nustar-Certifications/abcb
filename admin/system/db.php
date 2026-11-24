<?php

require_once __DIR__ . '/env.php';
loadEnvFile();

$hostname = env('DB_HOST', 'localhost');
$username = env('DB_USER', 'root');
$dbname = env('DB_NAME', 'ab-cb');
$password = env('DB_PASSWORD', '');
$port = (int) env('DB_PORT', 3306);

$con = @mysqli_connect($hostname, $username, $password, $dbname, $port);
if (mysqli_connect_errno()) {
    $showDetails = env('APP_ENV', 'local') !== 'production';
    if ($showDetails) {
        echo 'Failed to connect to MySQL: ' . mysqli_connect_error();
    } else {
        echo 'Database connection failed. Check DB settings in .env on the server.';
    }
    exit();
}