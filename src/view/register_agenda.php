<?php
require_once('template/header.php');

?>

<main class="main p-4">
    <div class="container">
        <form action="src/db/actions.php" method="POST">
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