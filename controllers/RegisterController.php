<?php
global $pdo;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["login"]) && isset($_POST["haslo"]) && isset($_POST["email"]) && isset($_POST["imie"])  && isset($_POST["nazwisko"])){
        $stmt = $pdo->prepare('INSERT INTO uzytkownik
                                        (login, imie, nazwisko, haslo, email, id_roli) 
                                        VALUES(:login, :imie, :nazwisko, :haslo, :email, :id_roli)'
        );
        $stmt->bindParam(':login', $_POST['login']);
        $stmt->bindParam(':imie', $_POST['imie']);
        $stmt->bindParam(':nazwisko', $_POST['nazwisko']);
        $stmt->bindParam(':haslo', $_POST['haslo']);
        $stmt->bindParam(':email', $_POST['email']);
        $stmt->bindValue(':id_roli', 3, PDO::PARAM_INT);
        if($stmt->execute()){
            http_response_code(200);
            header('Location: /login');
        }
        else{
            http_response_code(400);
            header('Location: /register');
        }
        exit;
    }
}