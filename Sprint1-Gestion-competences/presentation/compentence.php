<?php
define('__root__', dirname(__FILE__));
include "C:/xampp/htdocs/ArbreCompetences/Sprint1-Gestion-competences/BLL/CompetencesBLL.php"; // include class BLL
// for check if have GET action 
if (!isset($_GET['action'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}

$competenceBLO = new CompetenceBLO();
$errorMessage = '';

// pour ajouter le competence
if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['AjouterCompetence'])) {
    $competence = new Competence();
    $reference = trim(strip_tags($_POST['reference']));
    $code = trim(strip_tags($_POST['code']));
    $nom = trim(strip_tags($_POST['nom']));
    $description = trim(strip_tags($_POST['description']));
    if (!isset($reference) || !isset($nom) || !isset($description)) {
        $errorMessage = 's\'ils vous plait compelete les champs necessaire ,reference ,nom  .';
    } else {
        $competence->setReference($reference);
        $competence->setCode($code);
        $competence->setNom($nom);
        $competence->setDescription($description);
        $competenceBLO->AddCompetence($competence);
    }
}

// pour edit le competence
if (isset($_GET['action']) && str_starts_with($_GET['action'], 'edit')) {
    $actionId = filter_var($_GET['action'], FILTER_SANITIZE_NUMBER_INT);
    $competence = $competenceBLO->GetCompetence($actionId);
}
// $actionId = isset($_GET['action']) && str_starts_with($_GET['action'], 'edit') ? filter_var($_GET['action'], FILTER_SANITIZE_NUMBER_INT) : false;

// $competence = $competenceBLO->GetCompetence($actionId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['EditCompetence'])) {
    $competence = new Competence();
    $id = $actionId;
    $reference = trim(strip_tags($_POST['reference']));
    $code = trim(strip_tags($_POST['code']));
    $nom = trim(strip_tags($_POST['nom']));
    $description = trim(strip_tags($_POST['description']));
    if (!isset($reference) || !isset($nom) || !isset($description)) {
        $errorMessage = 's\'ils vous plait compelete les champs necessaire ,reference ,nom, description  .';
    } else {
        $competence->setId($id);
        $competence->setReference($reference);
        $competence->setCode($code);
        $competence->setNom($nom);
        $competence->setDescription($description);
        $competenceBLO->UpdateCompetence($competence);
        // header('Location: index.php');
    }
}




// that for add a name to button submit 
$action = isset($_GET['action']) ? $_GET['action'] : '';
if (str_starts_with($action, 'edit')) {
    $buttonName = 'EditCompetence';
} elseif (str_starts_with($action, 'ajouter')) {
    $buttonName = 'AjouterCompetence';
} else {
    // Default button name if action is not recognized
    $buttonName = 'Submit';
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- head -->
<?php include(__root__ . "/layout/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <?php include(__root__ . "/layout/loader.php"); ?>

        <!-- Navbar -->
        <?php include(__root__ . "/layout/navbar.php"); ?>



        <!-- Main Sidebar Container -->
        <?php include(__root__ . "/layout/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Gestion des Competences</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item "><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active">
                                    <?php
                                    if (isset($_GET['action'])) {
                                        if (str_starts_with($_GET['action'], 'edit')) {
                                            echo 'Edit';
                                        } elseif (str_starts_with($_GET['action'], 'ajouter')) {
                                            echo 'Ajouter';
                                        }
                                    }
                                    ?>
                                    Competence
                                </li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- form start -->
                    <form method="post">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <div class="text-center">
                                            <?php if (!empty($errorMessage)) : ?>
                                                <div class="alert alert-danger">
                                                    <?php echo $errorMessage; ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <h3 class="card-title">
                                            <?php
                                            if (isset($_GET['action'])) {
                                                if (str_starts_with($_GET['action'], 'edit')) {
                                                    echo 'Edit';
                                                } elseif (str_starts_with($_GET['action'], 'ajouter')) {
                                                    echo 'Ajouter';
                                                }
                                            } ?>
                                            Compentence</h3>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="reference">Compentence Reference</label>
                                            <input name="reference" type="text" class="form-control" id="reference" placeholder="Entre reference" <?php echo isset($_GET['action']) && str_starts_with($_GET['action'], 'edit') ? 'value="' . $competence->getReference() . '"' : ''; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="code">Compentence Code</label>
                                            <input name="code" type="text" class="form-control" id="code" placeholder="Enter Compentence" <?php echo isset($_GET['action']) && str_starts_with($_GET['action'], 'edit') ? 'value="' . $competence->getCode() . '"' : ''; ?>>
                                        </div>

                                        <div class="form-group">
                                            <label for="nom">Compentence Nom</label>
                                            <input name="nom" type="text" class="form-control" id="nom" placeholder="Entre nom" <?php echo isset($_GET['action']) && str_starts_with($_GET['action'], 'edit') ? 'value="' . $competence->getNom() . '"' : ''; ?>>
                                        </div>

                                        <!-- Description -->
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description"><?php echo (isset($_GET['action']) && str_starts_with($_GET['action'], 'edit')) ? $competence->getDescription() : ''; ?></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="<?php echo $buttonName; ?>" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
        </div>

    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include(__root__ . "/layout/footer.php"); ?>


    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <script>
        tinymce.init({
            selector: 'textarea#description',
            plugins: 'link image code',
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent | link image | code',
            menubar: false,
        });
    </script>
    <?php include(__root__ . "/layout/scripts.php"); ?>

</body>

</html>