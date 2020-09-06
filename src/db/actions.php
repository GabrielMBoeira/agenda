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

    if (trim($login) === '') {
        $_SESSION['empty_login'] = 'Favor adicionar responsável';
        header('Location: ../../register_agenda');
    }

    if ($appointment & $appointment_date & $login) {

        $conn = Connection::connectionDB();
        $query = "INSERT INTO note (appointment, login, appointment_date, status) VALUES ('$appointment', '$login', '$appointment_date', '$status')";

        if (pg_query($query)) {
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>';
        } else {
            $_SESSION['msg'] = "Erro de inserção";
        }
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Não cadastrado!</div>';
    }

    pg_close();

    header('Location: ../../register_agenda');
}

//EDITANDO REGISTRO - (edit_agenda.php)
if (isset($_POST['update'])) {


    $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
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

    if (trim($login) === '') {
        $_SESSION['empty_login'] = 'Favor adicionar responsável';
        header('Location: ../../register_agenda');
    }

    if ($appointment & $appointment_date & $login) {

        $conn = Connection::connectionDB();
        $query = "UPDATE note SET appointment = '$appointment', login = '$login', appointment_date = '$appointment_date',
         status = '$status' WHERE id = '$id'";

        if (pg_query($query)) {
            $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Atualizado com sucesso!</div>';
        } else {
            $_SESSION['msg'] = "Erro de inserção";
        }
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Não Atualizado!</div>';
    }

    pg_close();

    header('Location: ../../register_agenda');
}

//DELETANDO REGISTRO - (agenda.php)
if (isset($_POST['delete'])) {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES);


    $conn = Connection::connectionDB();
    $query = "DELETE FROM note WHERE id = '$id'";

    if (pg_query($query)) {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Deletado com sucesso!</div>';
    } else {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Erro ao deletar!</div>';
    }

    pg_close();

    header('Location: ../../agenda');
}

if (isset($_POST['concluded'])) {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES);

    Connection::connectionDB();
    $query = "UPDATE note SET status = 'inactive' WHERE id = '$id'";

    if (pg_query($query)) {
        $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Agenda concluida</div>';
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao concluir agenda!</div>';
    }

    pg_close();
    header('Location: ../../agenda');

}
