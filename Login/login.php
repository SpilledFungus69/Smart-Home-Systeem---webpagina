<?php
session_start();
include "db_conn.php";

if (isset($_POST['gnaam']) && isset($_POST['wwoord'])) {

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }



    $gnaam  = validate($_POST['gnaam']);
    $wwoord = validate($_POST['wwoord']);



    if (empty($gnaam)) {
        header("Location: index.php?error= gebruikersnaam moet ingevuld worden");
        exit();
    }else if(empty($wwoord)) {
        header("Location: index.php?error= wachtwoord moet ingevuld worden");
        exit();
    }else{
        $sql = "SELECT * FROM gebruikers WHERE gebruikersnaam ='$gnaam' AND wachtwoord='$wwoord'";
        
        $result = mysqli_query($conn, $sql);
        
            if(mysqli_num_rows($result) === 1){
                    $rij = mysqli_fetch_assoc($result);
                if ($rij['gebruikersnaam'] === $gnaam && $rij['wachtwoord'] === $wwoord) {
                    $_SESSION['gnaam'] = $rij['gebruikersnaam'];
                    $_SESSION['wwoord'] = $rij['wwoord'];
                    $_SESSION['id'] = $rij['id'];
                    header("Location: php_website/index.php");
                }
                    }else{
                        header("Location: index.php?error=incorrect");
                        exit();
                    }
        }
    }else{
        echo "kaas";
    }
