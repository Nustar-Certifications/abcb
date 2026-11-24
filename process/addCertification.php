<?php

require_once '../admin/system/main.php';


if(isset($_POST['certificationNumber']) && !empty($_POST['certificationNumber']) && isset($_POST['companyName']) && !empty($_POST['companyName'])){
    $certificationNumber=$_POST['certificationNumber'];
    $companyName=$_POST['companyName'];
    if(isset($_POST['address'])){
        $address=$_POST['address'];
    }else{
        $address='';
    }
    if(isset($_POST['scheme'])){
        $scheme=$_POST['scheme'];
    }else{
        $scheme='';
    }
    if(isset($_POST['accredited'])){
        $accredited="1";
    }else{
        $accredited="0";
    }
    if(isset($_POST['validTill'])){
        $validTill=explode('/', $_POST['validTill']);
        $validTill = $validTill[2] . "-" . $validTill[1] . "-" . $validTill[0];

    }else{
        $validTill='';
    }
    $createdOn=date('Y/m/d h:i:s', time());
    $addCertificationQ="INSERT r_certification (certificationNumber,companyName,address,scheme,validTill,accredited,createdOn) VALUES('$certificationNumber','$companyName','$address','$scheme','$validTill','$accredited','$createdOn')";
    if(mysqli_query($con,$addCertificationQ)){
        $json=array('status'=>true,'message'=>'Certification added sucessfully' ,'dialogMsg'=>'Certification added sucessfully ','redirect'=>base_url.'admin/certified-client-add.php');
    }else{
        $json=array('status'=>false,'message'=>'Fail to add certification please try later');
    }
    echo json_encode($json);
        
}