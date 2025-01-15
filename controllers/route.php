<?php
global $env;
require_once __DIR__ . '/../funcs/getUzytkownikByJWT.php';

    $request = $_SERVER['REQUEST_URI'];
    $request = explode('/', $request);
    if($request[count($request) - 1] == 'favicon.ico'){
        $name = '../resources/img';
        for($i = 2; $i <= count($request) - 1; $i++){
            $name .= '/'.$request[$i];
            if(file_exists($name)){
                header('Content-Type: ' . 'image/x-icon');
                header('Content-Length: ' . filesize($name));
                readfile($name);
            }
            else
                http_response_code(404);
        }
        exit;
    }
    if($request[1] == 'css'){
        $name = '../resources/css';
        for($i = 2; $i <= count($request) - 1; $i++){
            $name .= '/'.$request[$i];
        }
        if(file_exists($name)){
            header('Content-Type: ' . 'text/css');
            header('Content-Length: ' . filesize($name));
            readfile($name);
        }
        else{
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        }
        exit;
    }
    if($request[1] == 'js'){
        $name = '../resources/js';
        for($i = 2; $i <= count($request) - 1; $i++){
            $name .= '/'.$request[$i];
        }
        if(file_exists($name)){
            header('Content-Type: ' . 'application/javascript');
            header('Content-Length: ' . filesize($name));
            readfile($name);
        }
        else{
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        }
        exit;
    }
    if($request[1] == 'img'){
        $name = '../resources/img';
        for($i = 2; $i <= count($request) - 1; $i++){
            $name .= '/'.$request[$i];
        }
        if (file_exists($name)) {
            $mimetype = explode('.', $request[count($request) - 1])[1];
            switch ($mimetype) {
                case 'jpg':
                case 'jpeg':
                    header('Content-Type: ' . image_type_to_mime_type(IMAGETYPE_JPEG));
                    break;
                case 'svg':
                    header('Content-Type: ' . 'image/svg+xml');
                    break;
                case 'png':
                    header('Content-Type: ' . image_type_to_mime_type(IMAGETYPE_PNG));
                    break;
            }
            header('Content-Length: ' . filesize($name));
            readfile($name);
        }
        else {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        }
        exit;
    }
    if($request[1] != 'css' && $request[1] != 'js' && $request[1] != 'img'){
        $pdo = new PDO('mysql:host='.$env['db']['host'].';dbname='.$env['db']['db_name'], $env['db']['user'], $env['db']['password']);
        if($_SERVER["REQUEST_METHOD"] == "GET"){
            $page = explode('?', $request[1])[0];
            switch ($page) {
                case '':
                    if(getUzytkownikByJWT()) {
                        header('Location: /home');
                        break;
                    }
                    require __DIR__ . '/../resources/views/welcome.php';
                    break;
                case 'login':
                    if(getUzytkownikByJWT()) {
                        header('Location: /home');
                        break;
                    }
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    require __DIR__ . '/../resources/views/login.php';
                    break;
                case 'register':
                    if(getUzytkownikByJWT()) {
                        header('Location: /home');
                        break;
                    }
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    require __DIR__ . '/../resources/views/register.php';
                    break;
                case 'home':
                    require __DIR__ . '/../resources/views/home.php';
                    break;
            }
        }
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            require_once __DIR__ . "/../funcs/compare_csrf.php";
            $page = explode('?', $request[1])[0];
            switch ($page) {
                case 'login':
                    require __DIR__ . '/LoginController.php';
                    break;
                case 'register':
                    require __DIR__ . '/RegisterController.php';
                    break;
                case 'logout':
                    require __DIR__ . '/LoginController.php';
                    break;
            }
        }
    }