<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

//Iniciando array vazio para inicialização da página
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
        $query = "INSERT INTO note (appointment, login, appointment_date, status) VALUES ('$appointment', '$login', '$appointment_date', '$status')";

        $conn = Connection::connectionDB();

        if (pg_query($query)) {
            $msg[0] = '<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>';
            unset($_POST);
        } else {
            $msg[0] = '<div class="alert alert-danger" role="alert"> não cadastrada!</div>';
        }
        pg_close();
    }
}

?>

<main class="main p-4">
    <div class="container">
        <?= $msg[0]; ?>
        <form action="#" method="POST">
            <input type="hidden" name="status" value="active">
            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <label for="appointment">
                        <strong>Compromisso</strong>
                    </label>
                    <input type="text" class="form-control <?= $erros['appointment'] ? 'is-invalid' : '' ?>" id="appointment" name="appointment" />
                    <div class="invalid-feedback"><?= $erros['appointment'] ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="appointment_date">
                        <strong>Data</strong>
                    </label>
                    <input type="date" class="form-control <?= $erros['appointment_date'] ? 'is-invalid' : '' ?>" id="appointment_date" name="appointment_date" />
                    <div class="invalid-feedback"><?= $erros['appointment_date'] ?></div>
                </div>
                <div class="form-group col-12">
                    <label for="login">
                        <strong>Responsável</strong>
                    </label>
                    <select name="login" id="login" class="form-control <?= $erros['login'] ? 'is-invalid' : '' ?>">
                        <option value="Selecione">Selecione</option>
                        <option value="Gabriel">Gabriel</option>
                        <option value="Ana Clara">Ana Clara</option>
                    </select>
                    <div class="invalid-feedback"><?= $erros['login'] ?></div>
                </div>
                <div class="d-flex justify-content-end col-12">
                    <button type="submit" class="btn btn-primary mt-3" name="save">
                        Salvar
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
require_once('template/footer.php')
?>