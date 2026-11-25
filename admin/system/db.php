<?php

require_once __DIR__ . '/env.php';
loadEnvFile();

$hostname = env('DB_HOST', 'localhost');
$username = env('DB_USER', 'root');
$dbname = env('DB_NAME', 'ab-cb');
$password = env('DB_PASSWORD', '');
$port = (int) env('DB_PORT', 3306);

mysqli_report(MYSQLI_REPORT_OFF);

$con = false;
try {
    $con = mysqli_connect($hostname, $username, $password, $dbname, $port);
} catch (Throwable $e) {
    error_log('ABCB database connection: ' . $e->getMessage());
}

if ($con === false || mysqli_connect_errno()) {
    $detail = mysqli_connect_error();
    if ($detail !== '') {
        error_log('ABCB database connection: ' . $detail);
    }
    if (!headers_sent()) {
        http_response_code(503);
        header('Content-Type: text/plain; charset=utf-8');
    }
    $showDetails = env('APP_ENV', 'local') !== 'production';
    if ($showDetails) {
        echo 'Failed to connect to MySQL: ' . ($detail !== '' ? $detail : 'connection error');
    } else {
        echo 'Database connection failed. Check DB settings in .env on the server (Hostinger hPanel → Databases).';
    }
    exit();
}