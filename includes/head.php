<?php

require_once __DIR__ . '/init.php';

$pageTitleEsc = htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $pageTitleEsc; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800" rel="stylesheet" type="text/css">
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/bootstrap-responsive.css" rel="stylesheet">
<link href="css/animate.css" rel="stylesheet">
<script src="scripts/main.js"></script>
<link rel="stylesheet" href="styles/main.css"/>
<script src="scripts/jquery.min.js"></script>
<?php if (!empty($extraHead)) {
    echo $extraHead;
} ?>
</head>
<body data-spy="scroll" data-target=".navbar" id="top">