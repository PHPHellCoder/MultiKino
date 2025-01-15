<?php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;

function getUzytkownikByJWT()
{
    global $env, $pdo;
    if (!isset($_COOKIE['token']))
        return false;
    try {
        $decoded = JWT::decode($_COOKIE['token'], new Key($env['jwt']['key_string'], 'HS256'));
        $decoded_array = (array)$decoded;
        $id = intval($decoded_array['sub']);
        $stmt = $pdo->prepare('SELECT id, email, login, haslo, imie, nazwisko, id_roli FROM uzytkownik WHERE id = :id');
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return [
            $user['id'],
            $user['login'],
            $user['haslo'],
            $user['email'],
            $user['id_roli'],
            $user['imie'],
            $user['nazwisko']
        ];
    } catch (InvalidArgumentException $e) {
        return false;
    } catch (DomainException $e) {
        return false;
    } catch (SignatureInvalidException $e) {
        return false;
    } catch (BeforeValidException $e) {
        return false;
    } catch (ExpiredException $e) {
        return false;
    } catch (UnexpectedValueException $e) {
        return false;
    }
}