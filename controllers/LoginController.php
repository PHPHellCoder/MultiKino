<?php
global $pdo, $env;

use Firebase\JWT\JWT;
    use Firebase\JWT\Key;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["logout"])){
        setcookie("token", "", time() - 3600);
        header('Location: /');
        exit;
    }
    if(isset($_POST["login"]) && isset($_POST["haslo"])){
        $stmt = $pdo->prepare('SELECT id, id_roli FROM uzytkownik WHERE login = :login AND haslo = :haslo');

        $stmt->bindParam(':login', $_POST["login"]);
        $stmt->bindParam(':haslo', $_POST["haslo"]);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if(count($result) == 0){
            http_response_code(401);
            header('Location: /login');
            exit;
        }
        if(count($result) == 1){
            http_response_code(200);
            $payload = [
                "sub" => $result[0]["id"],
                "iat" => time(),
            ];
            $jwt = JWT::encode($payload, $env['jwt']['key_string'], "HS256");
            setcookie('token', $jwt, 0, '/', '', false, false);
            header('Location: /home');
            exit;
        }
        if(count($result) > 1){
            http_response_code(500);
            exit;
        }
    }
}