<?php

require_once('loader.php');

$studentBllObj = new StudentBLL();
$deleteSuccess = false;
$errorMessage = '';

if( isset($_REQUEST['delete']) && $_REQUEST['delete']=='yes' ) {

    $studentId = (int)$_REQUEST['id'];
    $deleteResult = $studentBllObj->DeleteStudent($studentId);

    if($deleteResult > 0) {
        $deleteSuccess = true;
    } else {
        if ($studentBllObj->errorMessage != '') {
            $errorMessage = $studentBllObj->errorMessage;
        } else {
            $errorMessage = 'Record can\'t be deleted. Operation failed.';
        }
    }
}

$allStudents = $studentBllObj->GenerateHtmlForAllStudents();

$pageTitle = "Student Information";
include_once("Templates/header.php");

?>

<div class="page-header">
    <h1>List of Students</h1>
</div>

<?php if ($deleteSuccess === true): ?>
<div class="alert alert-success">Record deleted successfully.</div>
<?php endif; ?>
<?php if ($errorMessage != ''): ?>
    <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
<?php endif; ?>

<?php

echo $allStudents;

include_once("Templates/footer.php");

?>