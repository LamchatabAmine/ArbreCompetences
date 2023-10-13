<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <meta name="description" content="This is a simple implementation of OOP in PHP. This application is created for educational purpose." />
    <meta name="author" content="Arif Uddin" />

    <title><?php echo $pageTitle; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="Assets/bootstrap-3.3.5/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Custom styles for this application -->
    <link href="Assets/Styles/Styles.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="Assets/Scripts/html5shiv.min.js"></script>
    <script src="Assets/Scripts/respond.min.js"></script>
    <![endif]-->

</head>

<body>


<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Student Information</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="add.php"><span class="glyphicon glyphicon-plus"></span> Add New</a></li>
            </ul>
            <form action="search.php" method="post" name="studentSearchForm" id="studentSearchForm" class="navbar-form navbar-right navbar-input-group" role="search">
                <div class="form-group">
                    <input type="text" name="studentNameSearch" id="studentNameSearch" value="<?php if (isset($search_string) && $search_string != '') { echo $search_string; } ?>" class="form-control" placeholder="Search for students" />
                </div>
                <input type="submit" name="studentSubmitButton" id="studentSubmitButton" value="Search" class="btn btn-default" />
            </form>
        </div><!--/.nav-collapse -->
    </div>
</nav>


<!-- Begin page content -->
<div class="container">