<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $csrf_token = htmlspecialchars($_POST["csrf_token"]);
        if (!$csrf_token || $csrf_token !== $_SESSION['csrf_token']) {
            // show an error message
            echo '<p class="error">Error: invalid form submission</p>';
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        }
    }