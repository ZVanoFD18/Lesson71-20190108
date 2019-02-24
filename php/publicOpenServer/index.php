<?php
header("Access-Control-Allow-Origin: *");
$uri = $_SERVER['REQUEST_URI'];
if($uri == '/auth/login'){
    require_once 'Auth.php';
    Auth::login();
}
