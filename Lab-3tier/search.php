<?php
    require_once('loader.php');

    $searchResult = array();
    $searchString = '';
    $message = '';

    if(isset($_POST['studentSubmitButton']) && $_POST['studentSubmitButton'] == 'Search') {

        $searchString = $_POST['studentNameSearch'];

        $studentBllObj = new StudentBLL();
        $studentName = $_POST['studentNameSearch'];
        $searchResult = $studentBllObj->GenerateHtmlForSearchStudentByName($studentName);

        if(count($searchResult) == 0) {
            $message = "No student found. Try a different student name.";
        }

    }

$pageTitle = "Searching Student...";
include_once("Templates/header.php");


?>

    <div class="page-header">
        <h1>Searching Student...</h1>
    </div>

    <?php
        if(count($searchResult) > 0) {
            echo $searchResult;
        } else {
            echo $message;
        }
    ?>

<?php include_once("Templates/footer.php"); ?>