<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'main.php';
if (isset($_SESSION['username']) && !empty($_SESSION['username']) && isset($_SESSION['password']) && !empty($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $cookiesToken=@$_COOKIE['adminLogin'];
    $q = "SELECT username , password FROM r_control where username='$username' && password='$password' limit 1";
    $r = mysqli_query($con, $q);
    $isUserExist = mysqli_num_rows($r);
    if ($isUserExist == 0) {
  
        header('Location:' . base_url . 'admin/login.php');
        exit();
    }
} else {
    
    header('Location:' . base_url . 'admin/login.php');
    exit();
}
