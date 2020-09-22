<?php


    class dbConnect {
        
        /*
        Prisijungimo prie duomenų bazės funkcija.
        */
        function openConn() {
            //Paimami duomenų bazės prisijungimo kintamieji
            require_once('config.php');
            //Bandoma prisijungti prie DB
            $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

            //Tikrinama ar prisijungimas sėkmingas
            if(!$conn){
                echo "Prisijungimas nepavyko. Klaida: " . mysqli_connect_errno();
                exit;
            }
            return $conn;
        }
    }

?>

