<?php
    //Prisijungiama prie DB
    require_once "config/DBconn.php";

    //Pradedama vartotojo sesija
    session_start();
    class userFuctions {

        public function userRegister($email, $name, $surname, $phone, $password){
            $conn = new dbConnect();
            $conn = $conn->openConn();
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = $conn->prepare("INSERT INTO users(email, name, last_name, phone, password, registered_at, last_login_at)
                                        VALUES ('".$email."', '".$name."', '".$surname."', '".$phone."', '".$hashPassword."', now(), now())");
            $query->execute();
            $query->close();
        }

        public function userLogin($email, $password){
            $conn = new dbConnect();
            $conn = $conn->openConn();
            $query = $conn->query("SELECT email, name, last_name, phone, password, registered_at FROM users WHERE email= '".$email."'");
            if(mysqli_num_rows($query) == 1){
                while($row = mysqli_fetch_assoc($query)){
                    if(password_verify($password, $row['password'])) {
                        $_SESSION['logedin'] = true;
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['surname'] = $row['last_name'];
                        $_SESSION['phone'] = $row['phone'];
                        $_SESSION['registered_at'] = $row['registered_at'];
                        $query = $conn->prepare("UPDATE users SET last_login_at=now() WHERE email= '".$email."'");
                        $query->execute();
                        $query->close();
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }

        public function checkEmail($email){
            $conn = new dbConnect();
            $conn = $conn->openConn();
            $query = $conn->prepare("SELECT * FROM users WHERE email = '".$email."'");
            $query->execute();
            $query->store_result();
            $rows = $query->num_rows();
            $query->close();
            if($rows > 0){
                return true;
            } else {
                return false;
            }
        }
    }
?>