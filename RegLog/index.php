<?php

    include_once('scripts/userFunc.php');

    $usrObj = new userFuctions();

    if(isset($_SESSION['logedin'])){
        header("Location:profile.php");
        exit;
    }

    if(isset($_POST['login'])){

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($_POST["email"])) {
            $emptyField = '
                        <div class="alert alert-danger" role="alert">
                            Elektroninis paštas privalomas.
                        </div>
                    ';
        } elseif (empty($_POST["password"])) {
            $emptyField = '
                        <div class="alert alert-danger" role="alert">
                            Slaptažodis privalomas.
                        </div>
                    ';
        } else {
            $login = $usrObj->userLogin($email, $password);
            if($login){
                header("location:profile.php");
            } else {
                $loginError = '
                        <div class="alert alert-danger" role="alert">
                            Neteisinga įvesta informacija.
                        </div>
                    ';
            }
        }
    }

?>
<!DOCTYPE html>

<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <title>Prisijungimas</title>
</head>

<body class="h-100">
<main role="main" class="flex-shrink-0 h-100">
    <div class="container h-100 ">
        <div class="row h-100 justify-content-center">
            <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4 my-auto border border-primary rounded">
                <div class="panel panel-default m-2 mt-3 mb-3">
                    <div class="panel-heading">
                        <h3 class="panel-title text-center">Prisijungimas</h3>
                    </div>
                    <div class="panel-body">
                        <form name ="login" action="" method="post">
                            <?php if(isset($emptyField)) echo $emptyField; ?>
                            <?php if(isset($loginError)) echo $loginError; ?>
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control input-sm border-primary" placeholder="Elektroninis paštas" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>">
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-sm border-primary" placeholder="Slaptažodis">
                            </div>
                            <div class="text-center">
                                <div>
                                    <button type="submit" value="Login" name="login" class="text-light btn btn-primary btn-lg col-sm-5 mb-3">Prisijungti</button>
                                </div>
                                <div>
                                    <p>Nesate prisiregistravęs? <a href="register.php"">Registruokites čia.</a></p>
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