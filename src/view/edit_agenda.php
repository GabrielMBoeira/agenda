<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

//CONSULTANDO POR ID NA BASE DE DADOS
if (isset($_GET['id'])) {

    $id = htmlspecialchars($_GET['id']);

    $query = "SELECT * FROM note WHERE id = '$id'";

    $conn = Connection::connectionDB();

    $result = pg_query($conn, $query);

    if (!$result || pg_num_rows($result) == 0) {
        echo "Query não executada ou retornada vazia";
    }

    if (pg_num_rows($result) > 0) {
        while ($row = pg_fetch_assoc($result)) {
            $registro = $row;
        }
    }
    pg_close();
}

//INSERINDO NA BASE DE DADOS

//Iniciando array vazio para inicialização da página
$msg[0] = '';
$erros = [];

if (isset($_POST['save'])) {

    $id = htmlspecialchars($_POST['id'], ENT_QUOTES);
    $appointment = htmlspecialchars($_POST['appointment'], ENT_QUOTES);
    $login = htmlspecialchars($_POST['login'], ENT_QUOTES);
    $appointment_date = htmlspecialchars($_POST['appointment_date'], ENT_QUOTES);
    $status = htmlspecialchars($_POST['status'], ENT_QUOTES);

    print_r($id);
    echo "<br>";
    print_r($appointment);
    echo "<br>";
    print_r($login);
    echo "<br>";
    print_r($appointment_date);
    echo "<br>";
    print_r($status);
    echo "<br>";

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
        $query = "UPDATE note SET appointment = 'teste', login = 'login', appointment_date = '2020-09-05' WHERE id = '15';";

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
        <form action="#" method="POST">
            <?= print_r($registro) ?>
            <input type="hidden" name="status" value="active">
            <input type="hidden" name="id" value="<?php $registro['id'] ?>">
            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <label for="appointment">
                        <strong>Compromisso</strong>
                    </label>
                    <input type="text" class="form-control <?= $erros['appointment'] ? 'is-invalid' : '' ?>" id="appointment" name="appointment" value="<?= $registro['appointment'] ?>" />
                    <div class="invalid-feedback"><?= $erros['appointment'] ?></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="appointment_date">
                        <strong>Data</strong>
                    </label>
                    <input type="date" class="form-control <?= $erros['appointment_date'] ? 'is-invalid' : '' ?>" id="appointment_date" name="appointment_date" value="<?= $registro['appointment_date'] ?>" />
                    <div class="invalid-feedback"><?= $erros['appointment_date'] ?></div>
                </div>
                <div class="form-group col-12">
                    <label for="login">
                        <strong>Responsável</strong>
                    </label>
                    <input type="text" class="form-control" value="<?= $registro['login'] ?>" name="login" readonly >
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