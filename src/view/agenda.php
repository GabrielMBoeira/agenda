<?php
require_once('template/header.php');
require_once(dirname(__FILE__, 2) . '/db/Connection.php');

session_start();

$conn = Connection::connectionDB();

$registros = [];

$resultado = pg_query($conn, "SELECT * FROM note WHERE status = 'active' ORDER BY appointment_date ASC ;");

if (!$resultado) {
   echo "Erro na Query";
}

if (pg_num_rows($resultado) == 0) {
   header('Location: data_base_empty');
} else {
   while ($row = pg_fetch_assoc($resultado)) {
      $registros[] = $row;
   }
}

pg_close();

?>

<main class="main p-4">
   <div class="container-fluid">
      <?php
      if (isset($_SESSION['msg'])) {
         echo $_SESSION['msg'];
      }
      unset($_SESSION['msg']);

      ?>
      <div class="row">
         <?php foreach ($registros as $registro) : ?>
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
                     <button class="btn btn-danger btn-sm m-1" data-toggle="modal" data-target="#delete">Deletar</button>

                     <div class="modal fade" id="delete">
                        <div class="modal-dialog">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <h5 class="modal-title">Apagar registro</h5>
                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                 </button>
                              </div>
                              <div class="modal-body">
                                 Tem certeza que deseja apagar agenda?
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                                 <form action="src/db/actions.php" method="post">
                                    <input type="hidden" name="id" value="<?= $registro['id'] ?>">
                                    <button type="submit" class="btn btn-primary" name="delete">OK</button>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>

                     <a class="btn btn-success btn-sm m-1" href="edit_agenda?id=<?= $registro['id'] ?>">Alterar</a>
                     <form action="src/db/actions.php" method="post">
                        <input type="hidden" name="id" value="<?= $registro['id'] ?>">
                        <button type="submit" class="btn btn-primary btn-sm m-1" name="concluded">Concluído</button>
                     </form>
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