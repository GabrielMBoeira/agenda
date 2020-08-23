<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

$conn = Connection::connectionDB();

?>

<main class="main p-4">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 mt-3">
                <div class="card">
                    <h5 class="card-header">
                        Compromisso
                        <div class="user-date">
                            Usuário: Gabriel - Data limite: 12/01/2021 - 16:00:00
                        </div>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            Agenda: Limpar nomes
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-danger m-1">Deletar</button>
                        <button class="btn btn-success m-1">Alterar</button>
                        <button class="btn btn-primary m-1">Concluído</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <h5 class="card-header">
                        Compromisso
                        <div class="user-date">
                            Usuário: Gabriel - Data limite: 12/01/2021 - 16:00:00
                        </div>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            Agenda: Limpar nomes
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-danger m-1">Deletar</button>
                        <button class="btn btn-success m-1">Alterar</button>
                        <button class="btn btn-primary m-1">Concluído</button>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <h5 class="card-header">
                        Compromisso
                        <div class="user-date">
                            Usuário: Gabriel - Data limite: 12/01/2021 - 16:00:00
                        </div>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            Agenda: Limpar nomes
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-danger m-1">Deletar</button>
                        <button class="btn btn-success m-1">Alterar</button>
                        <button class="btn btn-primary m-1">Concluído</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php
require_once('template/footer.php')
?>