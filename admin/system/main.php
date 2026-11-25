<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
    || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => $https,
    'httponly' => true,
    'samesite' => 'Lax',
]);
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
if (!defined('base_url')) {
    define('base_url', resolveAppBaseUrl());
}
require_once __DIR__ . '/db.php';
$current_url = @$_SERVER['PHP_SELF'];
$current_page = basename($current_url);
$adminPublicPages = ['login.php', 'index.php', 'logout.php'];
if ($current_page === 'login.php' && empty($_COOKIE['adminLogin'])) {
    $loginCookie = createToken(24);
    setcookie('adminLogin', $loginCookie, [
        'expires' => time() + 86400 * 30,
        'path' => '/',
        'secure' => $https,
        'httponly' => true,
        'samesite' => 'Lax',
    ]);
    $_COOKIE['adminLogin'] = $loginCookie;
}
if (!in_array($current_page, $adminPublicPages, true)) {
    require_once __DIR__ . '/session_check.php';
}





