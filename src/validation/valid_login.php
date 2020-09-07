<?php
require_once('../db/Connection.php');

function validLogin($login, $password) {

    $validation = null;

    $conn = Connection::connectionDB();

    $log = pg_escape_string($conn, $login);
    $pass = pg_escape_string($conn, $password);

    $logiN = htmlspecialchars($log);
    $passW = htmlspecialchars($pass);

    $sql = "SELECT email, password FROM login WHERE email = '$logiN' and password = '$passW'";

    $result = pg_query($conn, $sql);

    if (!$result) {
        echo "Erro = banco de dados";
    }

    if (pg_num_rows($result) === 0) {
        $validation = false;
    } 

    if (pg_num_rows($result) > 0) {

        $validation = true;
    }

    return $validation;
    pg_close();

}