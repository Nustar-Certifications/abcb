<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
date_default_timezone_set("Asia/Kolkata");

//set cookies
function createToken($length = 12) {
    $characters = 'qwertyuioplkjhgfdsazxcvbnmMNBVCXZASDFGHJKLPOIUYTREWQ0987654321';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

//include files
require_once __DIR__ . '/env.php';
loadEnvFile();
define('base_url', rtrim((string) env('APP_URL', 'http://localhost/abcb/'), '/') . '/');
require_once 'db.php';
$current_url = @$_SERVER['PHP_SELF'];
$current_page = basename($current_url);
if ($current_page != 'login.php') {
    require_once 'session_check.php';
}





