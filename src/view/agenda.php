<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

$conn = Connection::connectionDB();

    $registros = [];
    
    $resultado = pg_query($conn, "SELECT * FROM note ORDER BY appointment_date ASC ;");

    if  (!$resultado) {
        echo "Erro na Query";
    }

    if (pg_num_rows($resultado) == 0) {
        echo "pg 0 records";
    } else {
        while ($row = pg_fetch_assoc($resultado)) {
                $registros[] = $row;
         }
    }

?>

<main class="main p-4">
    <div class="container-fluid">
        <div class="row">
            <?php foreach ($registros as $registro): ?>
            <div class="col-md-4 mt-3">
                <div class="card">
                    <h5 class="card-header">
                        Compromisso
                        <div class="user-date mt-2">
                            <span class="user-text">Usuário: <?= $registro['login'] ?> - Data:</span> 
                            <span class="date-appointment">
                                <?php 
                                $data = $registro['appointment_date']; 
                                $dtFormat = strtotime($data);
                                echo date('d/m/Y', $dtFormat);
                                ?>
                            </span> 
                        </div>
                    </h5>
                    <div class="card-body">
                        <p class="card-text">
                            Agenda: <?= $registro['appointment'] ?>
                        </p>
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                        <button class="btn btn-danger btn-sm m-1">Deletar</button>
                        <button class="btn btn-success btn-sm m-1">Alterar</button>
                        <button class="btn btn-primary btn-sm m-1">Concluído</button>
                    </div>
                </div>
            </div>
            <?php endforeach ?>
        </div>
    </div>
</main>

<?php
require_once('template/footer.php')
?>