<?php
// Check if a session is already active before trying to start a new one
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Define BASE_PATH safely if it hasn't been defined yet
if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__ . '/');
}

// Define BASE_URL safely if it hasn't been defined yet
if (!defined('BASE_URL')) {
    if (isset($_SERVER['HTTP_HOST'])) {
        $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
        define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . '/');
    } else {
        define('BASE_URL', 'http://local.adsense.com/');
    }
}

// Include core database configuration and system utility helper components
require_once BASE_PATH . 'config.php';
require_once BASE_PATH . 'classes/Database.php';
require_once BASE_PATH . 'helpers/functions.php';
