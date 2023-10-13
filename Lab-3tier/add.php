<?php

require_once('loader.php');
$errorMessage = '';

if( isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Add Student' ) {

    $studentBllObj = new StudentBLL();
    $studentName = $_POST['studentName'];
    $studentRoll = $_POST['studentRoll'];
    $studentEmail = $_POST['studentEmail'];
    $studentDateOfBirth = $_POST['studentDateOfBirth'];

    $newStudent = new StudentDTO(0, $studentRoll, $studentName, $studentEmail, $studentDateOfBirth);
    $addStudentResult = $studentBllObj->AddStudent($newStudent);

    if($addStudentResult > 0) {
        header("Location: edit.php?id=". $addStudentResult .'&action=add');
    } else {
        if ($studentBllObj->errorMessage != '') {
            $errorMessage = $studentBllObj->errorMessage;
        } else {
            $errorMessage = 'Record can\'t be added. Operation failed.';
        }
    }
}

$pageTitle = 'Add New Student';
include_once("Templates/header.php");

?>


<div class="page-header">
    <h1>Add New Student</h1>
</div>

<?php if ($errorMessage != ''): ?>
    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
<?php endif; ?>


    <form action="add.php" method="post" name="studentInfoForm" id="studentInfoForm" class="form-horizontal">
        <div class="form-group">
            <label for="studentName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
                <input type="text" value="" name="studentName" id="studentName" class="form-control" placeholder="Name" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentRoll" class="col-sm-2 control-label">Roll</label>
            <div class="col-sm-4">
                <input type="text" value="" name="studentRoll" id="studentRoll" class="form-control" placeholder="Roll" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-4">
                <input type="email" value="" name="studentEmail" id="studentEmail" class="form-control" placeholder="Email" />
            </div>
        </div>
        <div class="form-group">
            <label for="studentDateOfBirth" class="col-sm-2 control-label">Date Of Birth</label>
            <div class="col-sm-3">
                <input type="text" value="" name="studentDateOfBirth" id="studentDateOfBirth" class="form-control" placeholder="Date Of Birth" />
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-4">
                <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Add Student" class="btn  btn-primary" />
            </div>
        </div>

    </form>


<?php include_once("Templates/footer.php"); ?>