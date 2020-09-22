<?php

    include_once('scripts/userFunc.php');

    $usrObj = new userFuctions();

    if(isset($_SESSION['logedin'])){
        header("Location:profile.php");
        exit;
    }

    if(isset($_POST['register'])){

        $email = $_POST['email'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $passwordConf = $_POST['passwordConf'];

        if (empty($_POST["email"])) {
            $emptyField = '
                    <div class="alert alert-danger" role="alert">
                        Elektroninis paštas privalomas.
                    </div>
                ';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = '
                        <div class="alert alert-danger" role="alert">
                            Elektroninio pašto formatas privalo būti: vardas@domenas.com.
                        </div>
                    ';
        } elseif (($usrObj -> checkEmail($email))) {
            $emailExists = '
                        <div class="alert alert-danger" role="alert">
                            Elektroninis paštas jau naudojamas.
                        </div>
                    ';
        } elseif (empty($_POST["name"])) {
            $emptyField = '
                    <div class="alert alert-danger" role="alert">
                        Vardas privalomas.
                    </div>
                ';
        } elseif (empty($_POST["surname"])) {
            $emptyField = '
                    <div class="alert alert-danger" role="alert">
                        Pavardė privaloma.
                    </div>
                ';
        } elseif (empty($_POST["phone"])) {
            $emptyField = '
                    <div class="alert alert-danger" role="alert">
                        Telefono numeris privalomas.
                    </div>
                ';
        } elseif (empty($_POST["password"])) {
            $emptyField = '
                    <div class="alert alert-danger" role="alert">
                        Slaptažodis privalomas.
                    </div>
                ';
        } elseif (strlen($_POST["password"]) < 8 || strlen($_POST["password"]) > 12) {
            $passwordError = '
                    <div class="alert alert-danger" role="alert">
                        Slaptažodis privalo būti sudarytas iš 8-12 simbolių.
                    </div>
                ';
        } elseif(!preg_match("#[0-9]+#",$password)) {
            $passwordError = '
                    <div class="alert alert-danger" role="alert">
                        Slaptažodį privalo sudaryti bent vienas skaičius.
                    </div>
                ';
        } elseif(!preg_match("#[A-Z]+#",$password)) {
            $passwordError = '
                    <div class="alert alert-danger" role="alert">
                        Slaptažodį privalo sudaryti bent viena didžioji raidė.
                    </div>
                ';
        } elseif (empty($_POST["passwordConf"])) {
            $emptyField = '
                    <div class="alert alert-danger" role="alert">
                        Slaptažodžio patvirtinimas privalomas.
                    </div>
                ';
        } else {
            if($password == $passwordConf) {
                $register = $usrObj -> userRegister($email, $name, $surname, $phone, $password);
                $registerSuccess = '<div class="alert alert-success">
                        Vartotojas sukurtas, galite prisijungti!
                </div>';
                $_POST = array();
            } else {
                $passwordDoesntMatch = '
                        <div class="alert alert-danger" role="alert">
                            Slaptažodžiai nesutampa
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
    <title>Registracija</title>
</head>

<body class="h-100">
    <main role="main" class="flex-shrink-0 h-100">
        <div class="container h-100 ">
            <div class="row h-100 justify-content-center">
                <div class="col-xs-12 col-sm-8 col-md-4 col-sm-offset-2 col-md-offset-4 my-auto border border-primary rounded">
                    <div class="panel panel-default m-2 mt-3 mb-3">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center">Registracija</h3>
                        </div>
                        <div class="panel-body">
                            <form name ="register" action="" method="post">
                                <?php if(isset($passwordDoesntMatch)) echo $passwordDoesntMatch; ?>
                                <?php if(isset($emailExists)) echo $emailExists; ?>
                                <?php if(isset($emailErr)) echo $emailErr; ?>
                                <?php if(isset($emptyField)) echo $emptyField; ?>
                                <?php if(isset($passwordError)) echo $passwordError; ?>
                                <?php if(isset($registerSuccess)) echo $registerSuccess; ?>
                                <div class="form-group">
                                    <input type="text" name="email" id="email" class="form-control input-sm border-primary" placeholder="Elektroninis paštas" value="<?php echo (isset($_POST['email']) ? $_POST['email'] : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control input-sm border-primary" placeholder="Vardas" value="<?php echo (isset($_POST['name']) ? $_POST['name'] : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="surname" id="surname" class="form-control input-sm border-primary" placeholder="Pavardė" value="<?php echo (isset($_POST['surname']) ? $_POST['surname'] : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="phone" id="phone" class="form-control input-sm border-primary" placeholder="Telefono numeris" value="<?php echo (isset($_POST['phone']) ? $_POST['phone'] : ''); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" class="form-control input-sm border-primary" placeholder="Slaptažodis">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="passwordConf" id="passwordConf" class="form-control input-sm border-primary" placeholder="Pakartokite slaptažodį">
                                </div>
                                <div class="text-center">
                                    <div>
                                        <button type="submit" value="Register" name="register" class="text-light btn btn-primary btn-lg col-sm-5 mb-3">Registruotis</button>
                                    </div>
                                    <div>
                                        <p>Esate prisiregistravęs? <a href="index.php">Prisijunkite čia.</a></p>
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