<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../admin/system/db.php';
if(isset($_POST['certificationNumber']) && !empty($_POST['certificationNumber'])){
    $accredited=$_POST['accredited'];
    $certificationNumber=$_POST['certificationNumber'];
    $q="SELECT * FROM r_certification where certificationNumber='$certificationNumber' AND accredited='$accredited' limit 1";
    $runQ=  mysqli_query($con, $q);
    $fetchData=mysqli_fetch_assoc($runQ);
    if($fetchData!=null){
        $json=array('status'=>true,'message'=>$fetchData);
    }else{
        $json=array('status'=>false,'message'=>'No result found');
    }
    
}
if(isset($_POST['companyName']) && !empty($_POST['companyName'])){
    $accredited=$_POST['accredited'];
    $companyName=$_POST['companyName'];
    $q="SELECT * FROM r_certification where companyName='$companyName' AND accredited='$accredited' limit 1";
    $runQ=  mysqli_query($con, $q);
    $fetchData=mysqli_fetch_assoc($runQ);
    if($fetchData!=null){
        $json=array('status'=>true,'message'=>$fetchData);
    }else{
        $json=array('status'=>false,'message'=>'No result found');
    }
}

if(isset($_POST['companyName']) && empty($_POST['companyName']) && isset($_POST['certificationNumber']) && empty($_POST['certificationNumber'])){
    $json=array('status'=>false,'message'=>'Please Fill your company name or certification number for result');
}
echo json_encode($json);