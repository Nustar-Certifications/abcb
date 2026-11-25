<?php
/**
 * One-time admin password sync for live server.
 * 1. Upload entire project (or only this file + admin/system/*) to hosting.
 * 2. Open: https://ab-cb.com/tools/set-admin-password-once.php?token=SET_THIS_TOKEN
 * 3. Delete this file from the server immediately after success.
 */
declare(strict_types=1);

$expectedToken = 'a8f3c91e2b4d6f0a'; // change before upload if you want, then use same in URL
if (($_GET['token'] ?? '') !== $expectedToken) {
    http_response_code(403);
    exit('Forbidden');
}

require_once dirname(__DIR__) . '/admin/system/db.php';

$username = 'admin@gmail.com';
$plainPassword = 'Ab@#b53Cb';
$hash = sha1($plainPassword);

$check = mysqli_query($con, 'SELECT id FROM r_control WHERE id = 1 LIMIT 1');
$hasRow = $check && mysqli_num_rows($check) > 0;

if ($hasRow) {
    $stmt = mysqli_prepare($con, 'UPDATE r_control SET username = ?, password = ? WHERE id = 1 LIMIT 1');
} else {
    $stmt = mysqli_prepare(
        $con,
        "INSERT INTO r_control (id, username, password, cookiesToken, lastLogin) VALUES (1, ?, ?, '', NOW())"
    );
}
if (!$stmt) {
    exit('Prepare failed: ' . mysqli_error($con));
}
mysqli_stmt_bind_param($stmt, 'ss', $username, $hash);
$ok = mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

header('Content-Type: text/plain; charset=utf-8');
if ($ok) {
    echo ($hasRow ? 'Updated' : 'Created') . " admin user {$username}. DELETE tools/set-admin-password-once.php from the server now.\n";
} else {
    echo 'Failed: ' . mysqli_error($con);
}