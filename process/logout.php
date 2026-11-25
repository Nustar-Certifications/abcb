<?php

require_once '../admin/system/main.php';
require_once '../admin/system/auth.php';

adminClearSession();
header('Location:' . base_url . 'admin/login.php');
exit();