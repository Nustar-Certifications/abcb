<?php

declare(strict_types=1);

if (!isset($_POST['feedback'])) {
    header('Location: feedback.php');
    exit;
}

$name = trim((string) ($_POST['name'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$phone = trim((string) ($_POST['phone'] ?? ''));
$comment = trim((string) ($_POST['comment'] ?? ''));

if ($name === '' || $email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: feedback.php');
    exit;
}

$subject = 'Feedback';
$toEmail = 'info@ab-cb.org';
$messageBody = 'Name : ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '<br>'
    . 'Mobile : ' . htmlspecialchars($phone, ENT_QUOTES, 'UTF-8') . '<br>'
    . 'Email : ' . htmlspecialchars($email, ENT_QUOTES, 'UTF-8') . '<br>'
    . 'Message : ' . htmlspecialchars($comment, ENT_QUOTES, 'UTF-8') . '<br>';

$mailheader = 'From: ' . $email . "\r\n";
$mailheader .= 'Reply-To: ' . $email . "\r\n";
$mailheader .= "Content-type: text/html; charset=utf-8\r\n";

mail($toEmail, $subject, $messageBody, $mailheader);

$me = htmlspecialchars($name, ENT_QUOTES, 'UTF-8');
echo "<script>alert('Thank You {$me}, your message was sent')</script>";
echo "<script>window.location.href='feedback.php';</script>";
