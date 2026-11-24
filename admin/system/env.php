<?php

function loadEnvFile(?string $path = null): void
{
    static $loaded = false;
    if ($loaded) {
        return;
    }

    if ($path === null) {
        $path = dirname(__DIR__, 2) . DIRECTORY_SEPARATOR . '.env';
    }

    if (!is_readable($path)) {
        $loaded = true;
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        $loaded = true;
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || $line[0] === '#') {
            continue;
        }
        if (strpos($line, '=') === false) {
            continue;
        }
        [$name, $value] = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        if (
            (strlen($value) >= 2 && $value[0] === '"' && substr($value, -1) === '"')
            || (strlen($value) >= 2 && $value[0] === "'" && substr($value, -1) === "'")
        ) {
            $value = substr($value, 1, -1);
        }
        $_ENV[$name] = $value;
        putenv("$name=$value");
    }

    $loaded = true;
}

function env(string $key, $default = null)
{
    if (array_key_exists($key, $_ENV)) {
        return $_ENV[$key];
    }
    $value = getenv($key);
    if ($value !== false) {
        return $value;
    }
    return $default;
}

/**
 * Build site base URL from the current request (for live hosting when .env still says localhost).
 */
function detectAppBaseUrl(): string
{
    $https = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443)
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    $scheme = $https ? 'https' : 'http';
    $host = $_SERVER['HTTP_HOST'] ?? 'localhost';

    $docRoot = isset($_SERVER['DOCUMENT_ROOT']) ? realpath($_SERVER['DOCUMENT_ROOT']) : false;
    $projectRoot = realpath(dirname(__DIR__, 2));

    if ($docRoot && $projectRoot && strncmp($projectRoot, $docRoot, strlen($docRoot)) === 0) {
        $relative = substr($projectRoot, strlen($docRoot));
        $relative = str_replace('\\', '/', $relative);
        $relative = '/' . trim($relative, '/');
        if ($relative === '/') {
            return $scheme . '://' . $host . '/';
        }
        return $scheme . '://' . $host . $relative . '/';
    }

    $script = $_SERVER['SCRIPT_NAME'] ?? '/';
    $dir = str_replace('\\', '/', dirname($script));
    while ($dir !== '/' && $dir !== '' && $dir !== '.') {
        $base = dirname($dir);
        if (in_array(basename($dir), ['admin', 'process'], true)) {
            $path = $base === '/' || $base === '.' ? '/' : $base . '/';
            return $scheme . '://' . $host . ($path === '/' ? '/' : rtrim($path, '/') . '/');
        }
        $dir = $base;
    }

    return $scheme . '://' . $host . '/';
}

function resolveAppBaseUrl(): string
{
    $configured = trim((string) env('APP_URL', ''));
    $host = strtolower($_SERVER['HTTP_HOST'] ?? '');
    $requestIsLocal = $host === ''
        || strpos($host, 'localhost') !== false
        || strpos($host, '127.0.0.1') !== false;
    $configuredIsLocal = $configured === ''
        || stripos($configured, 'localhost') !== false
        || stripos($configured, '127.0.0.1') !== false
        || stripos($configured, 'yourdomain.com') !== false;

    if ($configured !== '' && !($configuredIsLocal && !$requestIsLocal)) {
        return rtrim($configured, '/') . '/';
    }

    return detectAppBaseUrl();
}