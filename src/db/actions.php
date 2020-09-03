<?php

require_once(dirname(__FILE__, 2) . '/db/Connection.php');

//INSERINDO REGISTRO - (register_agenda.php)
$msg[0] = '';
$erros = [];

if (isset($_POST['save'])) {

    $appointment = htmlspecialchars($_POST['appointment'], ENT_QUOTES);
    $login = htmlspecialchars($_POST['login'], ENT_QUOTES);
    $appointment_date = htmlspecialchars($_POST['appointment_date'], ENT_QUOTES);
    $status = htmlspecialchars($_POST['status'], ENT_QUOTES);

    if (trim($appointment) === '') {
        $erros['appointment'] = 'Compromisso é obrigatório';
    }

    if (trim($login) === 'Selecione') {
        $erros['login'] = 'Favor adicionar responsável';
    }

    if (trim($appointment_date) === '') {
        $erros['appointment_date'] = 'Favor adicionar data do compromisso';
    }

    if (!$erros) {
        
        $conn = Connection::connectionDB();
        $query = "INSERT INTO note (appointment, login, appointment_date, status) VALUES ('$appointment', '$login', '$appointment_date', '$status')";
        
        if (pg_query($query)) {
            $msg[0] = '<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>';
            unset($_POST);
        } else {
            $msg[0] = '<div class="alert alert-danger" role="alert"> não cadastrada!</div>';
        }
        pg_close();

        header('Location: ../../agenda');
    } else {
        header('Location: ../../register_agenda');
    }
}

?>