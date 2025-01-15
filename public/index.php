<?php
    session_start();
    $env = parse_ini_file('../.env', true);
    require_once __DIR__ . "/../vendor/autoload.php";
    require __DIR__ . '/../controllers/route.php';