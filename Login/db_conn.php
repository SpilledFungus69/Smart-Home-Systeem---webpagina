<?php
$sname= "localhost";
$username= "root";
$password ="";
$dbname ="gebruikers";

$conn = mysqli_connect($sname, $username, $password, $dbname);

if(!$conn){
    echo "connection failed";
}

?>
