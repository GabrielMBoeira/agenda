<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

$conn = Connection::connectionDB();
?>

<main class="main p-4">
    <div class="container">
        <form action="#" method="POST">
            <div class="form-row mt-3">
                <div class="form-group col-md-12">
                    <label for="appointment">
                        Compromisso
                    </label>
                    <input type="text" class="form-control" id="appointment" />
                </div>
                <div class="form-group col-md-6">
                    <label for="date">
                        Date
                    </label>
                    <input type="date" class="form-control" id="date" />
                    <div class="d-flex justify-content-start">
                        <button type="submit" class="btn btn-primary mt-3">
                            Cadastrar
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