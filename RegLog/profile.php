<?php

include_once('scripts/userFunc.php');

if(!($_SESSION)){
    header("Location:index.php");
}

if(isset($_POST['logout'])){

    session_unset();
    session_destroy();

    header("Location:index.php");
}

?>

<!DOCTYPE html>

<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Profilis</title>
</head>

<body class="h-100">
<main role="main" class="flex-shrink-0 h-100">
    <div class="container h-100 ">
        <div class="row h-100 justify-content-center">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4 my-auto border border-primary rounded">
                <div class="panel panel-default m-2 mt-3 mb-3">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Sveiki</h3>
                    </div>
                    <div class="panel-body">
                        <form name ="logout" action="" method="post">
                            <div class="form-group">
                                <span class="label label-default">El. paštas: <?php echo $_SESSION['email']?></span>
                            </div>
                            <div class="form-group">
                                <span class="label label-default">Vardas: <?php echo $_SESSION['name']?></span>
                            </div>
                            <div class="form-group">
                                <span class="label label-default">Pavardė: <?php echo $_SESSION['surname']?></span>
                            </div>
                            <div class="form-group">
                                <span class="label label-default">Telefono nr.: <?php echo $_SESSION['phone']?></span>
                            </div>
                            <div class="form-group">
                                <span class="label label-default">Registracijos data: <?php echo $_SESSION['registered_at']?></span>
                            </div>
                            <div class="text-center">
                                <div>
                                    <button type="submit" value="Logout" name="logout" class="text-light btn btn-primary btn-lg col-sm-5 mb-3">Atsijungti</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>