<?php
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off',    
    'httponly' => true,
    'samesite' => 'Strict'
]);

ini_set('session.use_strict_mode', 1);
ini_set('session.gc_maxlifetime', 1800);
session_start();

if (isset($_SESSION['ultimo_acesso']) && time() - $_SESSION['ultimo_acesso'] > 1800) {
    session_destroy();
    header("Location: login.php");
    exit();
}
$_SESSION['ultimo_acesso'] = time();




