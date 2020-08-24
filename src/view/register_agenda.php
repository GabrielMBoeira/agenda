<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

//Iniciando array vazio para inicialização da página
$msg[0] = '';

if (isset($_POST['save'])) {

    $appointment = htmlspecialchars($_POST['appointment'], ENT_QUOTES);
    


    $query = "INSERT INTO note (appointment) VALUES ('$appointment')";

    $conn = Connection::connectionDB();

    if (pg_query($query)) {
        $msg[0] = '<div class="alert alert-success" role="alert">Cadastrado com sucesso!</div>';
        unset($_POST);
    } else {
        $msg[0] = '<div class="alert alert-danger" role="alert">Manutenção não cadastrada!</div>';
    }
}



?>

<main class="main p-4">
    <div class="container">
        <?= $msg[0]; ?>
        <form action="#" method="POST">
            <div class="form-row mt-3">
                <div class="form-group col-md-12">
                    <label for="appointment">
                        Compromisso
                    </label>
                    <input type="text" class="form-control" id="appointment" name="appointment" />
                </div>
                <div class="form-group col-md-6">
                    <label for="date">
                        Date
                    </label>
                    <input type="date" class="form-control" id="date" name="date" />
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mt-3" name="save">
                            Salvar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>

<?php
require_once('template/footer.php')
?>