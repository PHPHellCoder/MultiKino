<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <title>Multikino strona główna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <p>Multikino</p>
    <p>Zaloguj się do Multikina</p>
    <form action="/login" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" name="login" class="form-control" id="login">
        </div>
        <div class="mb-3">
            <label for="haslo" class="form-label">Haslo</label>
            <input type="password" name="haslo" class="form-control" id="haslo">
        </div>
        <button type="submit" class="btn btn-primary">Zaloguj się</button>
    </form>
</body>
</html>