<?php
require_once('template/header.php');

session_start();

?>

<main class="main p-4">
    <div class="container">
        <?php
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
        }
        unset($_SESSION['msg']);
        ?>
        <form action="src/db/actions.php" method="POST">
            <input type="hidden" name="status" value="active">
            <div class="form-row mt-3">
                <div class="form-group col-md-6">
                    <label for="appointment">
                        <strong>Compromisso</strong>
                    </label>
                    <input type="text" class="form-control <?= $_SESSION['empty_appointment'] ? 'is-invalid' : '' ?>" id="appointment" name="appointment" />
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['empty_appointment'];
                        unset($_SESSION['empty_appointment']);
                        ?>
                    </div>
                </div>
                <div class="form-group col-md-6">
                    <label for="appointment_date">
                        <strong>Data</strong>
                    </label>
                    <input type="date" class="form-control <?= $_SESSION['empty_appointment_date'] ? 'is-invalid' : '' ?>" id="appointment_date" name="appointment_date" />
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['empty_appointment_date'];
                        unset($_SESSION['empty_appointment_date']);
                        ?>
                    </div>
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
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['empty_login'];
                        unset($_SESSION['empty_login']);
                        ?>
                    </div>
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