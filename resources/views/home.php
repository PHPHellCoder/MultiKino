<?php
require_once __DIR__ . '/../../funcs/getUzytkownikByJWT.php';
?>
<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <title>Multikino strona główna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <p>Ekran główny</p>
    <p>Cześć <?= getUzytkownikByJWT()[5]?> <?= getUzytkownikByJWT()[6]?></p>
    <form action="/logout" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <input type="submit" name="logout" value="Wyloguj się">
    </form>
</body>
</html>