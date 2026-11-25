<?php

require_once './system/main.php';
require_once './system/auth.php';

if (adminHasValidSession($con)) {
    header('Location:' . base_url . 'admin/dashboard.php');
} else {
    header('Location:' . base_url . 'admin/login.php');
}
exit();