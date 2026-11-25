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
        $cookiesToken = $_COOKIE['adminLogin'] ?? '';
        if ($cookiesToken === '') {
            $cookiesToken = createToken(24);
            $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
                || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
                || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
            setcookie('adminLogin', $cookiesToken, [
                'expires' => time() + 86400 * 30,
                'path' => '/',
                'secure' => $https,
                'httponly' => true,
                'samesite' => 'Lax',
            ]);
            $_COOKIE['adminLogin'] = $cookiesToken;
        }
        session_regenerate_id(true);
        $currentTime=date('Y/m/d h:i:s', time());
        $updateQ="UPDATE r_control set lastLogin='$currentTime' , cookiesToken='$cookiesToken' where username='$username' && password='$password' limit 1";
        mysqli_query($con,$updateQ);
        $_SESSION['username']=$username;
        $_SESSION['password']=$password;
        $json=array('status'=>true,'message'=>'logged in' ,'dialogMsg'=>'Welcome admin please wait for dashboard','redirect'=>base_url.'admin/dashboard.php');
    }else{
        $json=array('status'=>false,'message'=>'Invalid username or password');
    }
    
}else{
    $json=array('status'=>false,'message'=>'Unauthorise fields are required');
}
echo json_encode($json);


    
