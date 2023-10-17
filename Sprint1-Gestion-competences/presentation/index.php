<?php
define('__ROOT__', dirname(__FILE__));

include "C:/xampp/htdocs/ArbreCompetences/Sprint1-Gestion-competences/BLL/CompetencesBLL.php"; // include class BLL

// Instantiate the CompetencesBLL

?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include(__ROOT__ . "/layout/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <?php include(__ROOT__ . "/layout/loader.php"); ?>

    <!-- Navbar -->
    <?php include(__ROOT__ . "/layout/navbar.php"); ?>

    <!-- Main Sidebar Container -->
    <?php include(__ROOT__ . "/layout/sidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <?php include(__ROOT__ . "/layout/header.php"); ?>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <?php
            // message success
            if (isset($_GET['success'])) {
              if ($_GET['success'] == "addedSuccessfully") {
                echo '<div id="successAlert" class="alert alert-success text-center mt-4">La compétence a été ajoutée.</div>';
              }
              if ($_GET['success'] == "editedSuccessfully") {
                echo '<div id="successAlert" class="alert alert-success text-center mt-4">La compétence a été edité.</div>';
              }
              if ($_GET['success'] == "deletedSuccessfully") {
                echo '<div id="successAlert" class="alert alert-info text-center mt-4">La compétence a été supprimer.</div>';
              }
            } ?>
            <div class="col-12">
              <div class="card">
                <!-- /.card-header -->
                <div class="card-header">
                  <h3 class="card-title">Tableau des competences</h3>
                </div>
                <div class="card-body  p-0">
                  <table class="table table-light table-hover">
                    <thead>
                      <tr>
                        <th>References</th>
                        <th>Code</th>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      // Instantiate the CompetencesDAO
                      $CompetencesBLL = new CompetenceBLO();
                      // Get all competences from the database
                      $competences = $CompetencesBLL->GetAllCompetences();
                      foreach ($competences as $competence) {
                      ?>
                        <tr>
                          <th scope="row"><?= $competence->getReference() ?></th>
                          <td><?= $competence->getCode() ?></td>
                          <td><?= $competence->getNom() ?></td>
                          <td><?= $competence->getDescription() ?></td>
                          <td>
                            <div class="btn-group" style="gap: 8px;">
                              <a href="./compentence.php?action=edit<?= $competence->getId() ?>" class="btn btn-success">
                                <i class="fas fa-edit"></i>
                              </a>
                              <a class="btn btn-danger" onclick="setId(<?php echo $competence->getID() ?>);" data-toggle="modal" data-target="#myModal">
                                <i class="fas fa-trash"></i>
                              </a>
                            </div>
                          </td>
                        </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

    <!-- modal delete -->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- Modal content goes here -->
          <div class="modal-header">
            <h4 class="modal-title">Compentence</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
          </div>
          <div class="modal-body">
            <p>es-tu sûr de vouloir supprimer ça !!</p>
            <form class="modal-footer" action="./supprimer.php" method="POST">
              <input name="competenceID" type="hidden" id="IDModal">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" name="supprimerCompetence" class="btn btn-danger">Supprimer</button>
            </form>
          </div>
        </div>
      </div>
    </div>



    <!-- /.content-wrapper -->
    <?php include(__ROOT__ . "/layout/footer.php"); ?>

    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <script>
    function setId(id) {
      document.getElementById("IDModal").value = id;
    }
  </script>
 
  <?php include(__ROOT__ . "/layout/scripts.php"); ?>

</body>

</html>