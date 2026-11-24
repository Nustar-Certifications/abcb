<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../admin/system/main.php';
if (isset($_GET['certificationNumber'])) {
    $certificationNumber = $_GET['certificationNumber'];
    $q = "SELECT certificationNumber FROM r_certification where certificationNumber='$certificationNumber'";
    $r = mysqli_query($con, $q);
    $isExist = mysqli_num_rows($r);
    if ($isExist == 1) {
        $valid = $certificationNumber . " is already in assinged !!";
    } else {
        $valid = true;
    }
    echo json_encode($valid);
    
}
if (isset($_GET['companyName'])) {
    $companyName = $_GET['companyName'];
    $q = "SELECT companyName FROM r_certification where companyName='$companyName'";
    $r = mysqli_query($con, $q);
    $isExist = mysqli_num_rows($r);
    if ($isExist == 1) {
        $valid = $companyName . " is already in added !!";
    } else {
        $valid = true;
    }
    echo json_encode($valid);
    exit;
}
