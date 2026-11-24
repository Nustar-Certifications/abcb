<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../admin/system/main.php';

if (isset($_POST['method']) && $_POST['method'] == 'singleDetail') {
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = $_POST['id'];
        $q = "SELECT * FROM r_certification where id='$id'";
        $r = mysqli_query($con, $q);
        $data = mysqli_fetch_assoc($r);
        if ($data != null) {
            $json = array('status' => true, 'message' => $data);
        } else {
            $json = array('status' => false, 'message' => 'no result found');
        }
    } else {
        $json = array('status' => false, 'message' => 'Invalid Request');
    }
}

if (isset($_POST['method']) && $_POST['method'] == 'update') {
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];

        $certificationNumber = $_POST['certificationNumber'];
        //check certification number dublicate
        $q = "SELECT certificationNumber FROM r_certification where certificationNumber='$certificationNumber'";
        $r = mysqli_query($con, $q);
        $iscertificationNumberExist = mysqli_num_rows($r);
        if($iscertificationNumberExist>1){
            $json = array('status'=>false,'message'=>$certificationNumber.' already assign please try other');
            echo json_encode($json);
            exit;
        }


        $companyName = $_POST['companyName'];
        //check company name repeat
        $q1 = "SELECT companyName FROM r_certification where companyName='$companyName'";
        $r1 = mysqli_query($con, $q1);
        $iscompanyNameNumberExist = mysqli_num_rows($r1);
        if($iscompanyNameNumberExist>1){
            $json = array('status'=>false,'message'=>$iscompanyNameNumberExist.' already assign please try other');
            echo json_encode($json);
            exit;
        }
        
        
        $address = $_POST['address'];
        $scheme = $_POST['scheme'];
        $validTill=explode('/', $_POST['validTill']);
        $validTill = $validTill[2] . "-" . $validTill[1] . "-" . $validTill[0];
        if(isset($_POST['accredited'])){
            $accredited="1";
        }else{
            $accredited="0";
        }

       
        $updatedOn = date('Y/m/d h:i:s', time());
        $q = "UPDATE r_certification set certificationNumber='$certificationNumber', companyName='$companyName',address='$address', scheme='$scheme', validTill='$validTill', accredited='$accredited', updatedOn='$updatedOn' where id='$id'";
        $r = mysqli_query($con, $q);
        if ($r) {
            $json = array('status' => true, 'message' => 'Certification updated, Thank you for update certification');
        } else {
            $json = array('status' => false, 'message' => 'something went wromg please try later');
        }
    } else {
        $json = array('status' => false, 'message' => 'Invalid Request');
    }
}

if (isset($_POST['method']) && $_POST['method'] == 'delete') {
    if (!empty($_POST['cId'])) {
        $id = $_POST['cId'];
        $q = "DELETE FROM r_certification where id='$id'";

        $r = mysqli_query($con, $q);
        if (true) {
            $json = array('status' => true, 'message' => $id . ' has been deleted');
        } else {
            $json = array('status' => false, 'message' => 'Something went wrong please try later');
        }
    } else {
        $json = array('status' => false, 'message' => 'Invalid Delete Request');
    }
}
echo json_encode($json);
