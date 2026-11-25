<?php

/**
 * Returns true when session matches a row in r_control and adminLogin cookie matches cookiesToken.
 */
function adminHasValidSession(mysqli $con): bool
{
    if (empty($_SESSION['username']) || empty($_SESSION['password'])) {
        return false;
    }

    $username = mysqli_real_escape_string($con, (string) $_SESSION['username']);
    $password = mysqli_real_escape_string($con, (string) $_SESSION['password']);
    $q = "SELECT cookiesToken FROM r_control WHERE username='$username' AND password='$password' LIMIT 1";
    $r = mysqli_query($con, $q);
    if ($r === false || mysqli_num_rows($r) === 0) {
        return false;
    }

    $row = mysqli_fetch_assoc($r);
    $cookie = $_COOKIE['adminLogin'] ?? '';
    if ($cookie === '' || !isset($row['cookiesToken']) || $row['cookiesToken'] !== $cookie) {
        return false;
    }

    return true;
}

function adminClearSession(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    }
    setcookie('adminLogin', '', time() - 42000, '/');
    session_destroy();
}

function adminRequireLogin(mysqli $con): void
{
    if (!adminHasValidSession($con)) {
        adminClearSession();
        header('Location:' . base_url . 'admin/login.php');
        exit();
    }
}