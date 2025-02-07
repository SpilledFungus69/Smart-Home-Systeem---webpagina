<?php
session_start();
include "../db_conn.php";
if ($_SESSION['is_admin'] != 1) {
    header("Location: index.php?error=geen-admin");
} else {
?>
    <!DOCTYPE html>
    <html>
    <?php include('header.php'); ?>
    <!-- code voor het toevoegen van de gebruikers -->
    <div class="container d-flex justify-content-center">
        <form method="POST">
            <h2>Nieuwe gebruiker maken?</br></h2>
            <div class="mb-3">
                <label>Gebruikersnaam</label>
                <input type="text" name="gnaam" placeholder="Gebruikersnaam" class="form-control"><br>
            </div>
            <div class="mb-3">
                <label>Wachtwoord</label>
                <input type="password" name="wwoord" placeholder="Wachtwoord" class="form-control"><br>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="isadmin" value="1">
                <label class="form-check-label" for="isadmin">is het een administrator?</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Maak gebruiker aan</button>
        </form>
    </div>


<?php
    // kijken of gebruiker erin mag, mag alleen als hij admin is. 
    if (isset($_POST['submit'])) {
        $gebruikersnaam = $_POST['gnaam'];
        $wachtwoord = $_POST['wwoord'];
        if ($_POST['isadmin'] == '1') {
            $isadmin = 1;
        } else {
            $isadmin = 0;
        }

        $sql = mysqli_query($conn, "INSERT INTO `gebruikers`(`gebruikersnaam`, `wachtwoord`, `is_admin`) VALUES ('$gebruikersnaam','$wachtwoord','$isadmin')");
        if ($sql) {
            echo "<script>alert('nieuwe gebruiker toegevoegd')</script>";
        } else {
            echo "<script>alert('er is helaas een fout gebeurt, probeer het opnieuw')</script>";
        }
    }
}
?>