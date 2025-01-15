<!DOCTYPE html>
<html lang="pl-PL">
<head>
    <title>Multikino strona główna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <p>Multikino</p>
    <p>Zarejestruj się</p>
    <form action="/register" method="post">
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" name="login" class="form-control" id="login">
        </div>
        <div class="mb-3">
            <label for="haslo" class="form-label">Haslo</label>
            <input type="password" name="haslo" class="form-control" id="haslo">
        </div>
        <div class="mb-3">
            <label for="haslo_podt" class="form-label">Podtwierdź haslo</label>
            <input type="password" name="haslo_podt" class="form-control" id="haslo_podt">
        </div>
        <div class="mb-3">
            <label for="imie" class="form-label">Imie</label>
            <input type="text" name="imie" class="form-control" id="imie">
        </div>
        <div class="mb-3">
            <label for="nazwisko" class="form-label">Nazwisko</label>
            <input type="text" name="nazwisko" class="form-control" id="nazwisko">
        </div>
        <button type="submit" class="btn btn-primary">Zarejestruj się</button>
    </form>
</body>
</html>