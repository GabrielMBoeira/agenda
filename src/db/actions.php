<?php

require_once(dirname(__FILE__, 2) . '/db/Connection.php');

session_start();

//INSERINDO REGISTRO - (register_agenda.php)

if (isset($_POST['save'])) {

    $appointment = htmlspecialchars($_POST['appointment'], ENT_QUOTES);
    $login = htmlspecialchars($_POST['login'], ENT_QUOTES);
    $appointment_date = htmlspecialchars($_POST['appointment_date'], ENT_QUOTES);
    $status = htmlspecialchars($_POST['status'], ENT_QUOTES);

    if (trim($appointment) === '') {
        $_SESSION['empty_appointment'] = 'Compromisso é obrigatório';
        header('Location: ../../register_agenda');
    }

    if (trim($appointment_date) === '') {
        $_SESSION['empty_appointment_date'] = 'Favor adicionar data do compromisso';
        header('Location: ../../register_agenda');
    }

    if (trim($login) === 'Selecione') {
        $_SESSION['empty_login'] = 'Favor adicionar responsável';
        header('Location: ../../register_agenda');
    }

    if ($appointment & $appointment_date & $login) {

        $conn = Connection::connectionDB();
        $query = "INSERT INTO note (appointment, login, appointment_date, status) VALUES ('$appointment', '$login', '$appointment_date', '$status')";

        if (pg_query($query)) {
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>';
        } 

    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Não cadastrado!</div>';
    }

    pg_close();

    header('Location: ../../register_agenda');
}
