<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

session_start();
require_once('src/validation/valid_session_login.php');

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

?>

<main class="main p-4">
    <div class="container">
        <form action="src/db/actions.php" method="POST">
            <input type="hidden" name="status" value="active">
            <input type="hidden" name="id" value="<?= $registro['id'] ?>">
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
                    <select name="login" id="login" class="form-control <?= $_SESSION['empty_login'] ? 'is-invalid' : '' ?>">
                        <option value="">Selecione</option>
                        <option value="Gabriel">Gabriel</option>
                        <option value="Ana Clara">Ana Clara</option>
                    </select>
                </div>
                <div class="d-flex justify-content-end col-12">
                    <button type="submit" class="btn btn-primary mt-3" name="update">
                        Atualizar
                    </button>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
require_once('template/footer.php')
?>