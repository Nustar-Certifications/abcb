<?php

require_once '../admin/system/main.php';

header('Content-Type: application/json; charset=utf-8');

//check for post variable
if(isset($_POST['username']) && !empty($_POST['username']) && !empty($_POST['password']) && isset($_POST['password'])){
    $username=$_POST['username'];
    $password=sha1($_POST['password']);
    $q="SELECT username , password FROM r_control where username='$username' && password='$password' limit 1";
    $r=mysqli_query($con,$q);
    $isUserExist=mysqli_num_rows($r);
    if($isUserExist==1){
        //update user logged in time
        $cookiesToken = $_COOKIE['adminLogin'] ?? '';
        $currentTime=date('Y/m/d h:i:s', time());
        $updateQ="UPDATE r_control set lastLogin='$currentTime' , cookiesToken='$cookiesToken' where username='$username' && password='$password' limit 1";
        mysqli_query($con,$updateQ);
        // set session and redirection 
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;
        $json=array('status'=>true,'message'=>'logged in' ,'dialogMsg'=>'Welcome admin please wait for dashboard','redirect'=>base_url.'admin');
    }else{
        $json=array('status'=>false,'message'=>'Invalid username or password');
    }
    
}else{
    $json=array('status'=>false,'message'=>'Unauthorise fields are required');
}
echo json_encode($json);


    
