<?php 
session_start(); // start session

if (!defined('BASE_PATH')) {
    define('BASE_PATH', __DIR__ . '/'); 
}

if (isset($_SERVER['HTTP_HOST'])) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https://" : "http://";
    
    define('BASE_URL', $protocol . $_SERVER['HTTP_HOST'] . '/');
} else {
    define('BASE_URL', 'http://local.adsense.com/');
}

// insert database and others configrations 
require_once BASE_PATH . 'config.php';
require_once BASE_PATH . 'classes/Database.php';
require_once BASE_PATH . 'helpers/functions.php';