<?php
session_start();
include "db_conn.php";

// Check if form data is set
if (!isset($_POST['gnaam']) || !isset($_POST['wwoord'])) {
    echo "onbekende error.";
    exit();
}

// gegeven input netjes maken voor het kijken in de database
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$gnaam  = validate($_POST['gnaam']);
$wwoord = validate($_POST['wwoord']);

// Simpele error handeling in de url en kijken of de gebruikersdata in de database staat
// Verder kijkt hij ook of je uberhaupt wel iets hebt ingevuld, en zo niet geeft hij ook een juiste error.if (empty($gnaam)) {
if (empty($gnaam)) {
    header("Location: index.php?error=gebruikersnaam moet ingevuld worden");
    exit();
}

if (empty($wwoord)) {
    header("Location: index.php?error=wachtwoord moet ingevuld worden");
    exit();
}

$sql = "SELECT * FROM gebruikers WHERE gebruikersnaam = ? AND wachtwoord = ?";

$stmt = mysqli_prepare($conn, $sql);
if ($stmt === false) {
    echo "Error preparing the query.";
    exit();
}

// Bind the input parameters to the prepared statement
mysqli_stmt_bind_param($stmt, "ss", $gnaam, $wwoord); // "ss" means two strings
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

// Kijken of er een gebruiker gevonden is
if (mysqli_num_rows($result) === 1) {
    $rij = mysqli_fetch_assoc($result);

    // verifieren of de data klopt
    if ($rij['gebruikersnaam'] === $gnaam && $rij['wachtwoord'] === $wwoord) {
        $_SESSION['gnaam'] = $rij['gebruikersnaam'];
        $_SESSION['wachtwoord'] = $rij['wachtwoord'];
        $_SESSION['ID'] = $rij['ID'];
        $_SESSION['is_admin'] = $rij['is_admin'];
        header("Location: php_website/index.php");
        exit();
    }
}else{

header("Location: index.php?error=incorrect");
exit();
}
mysqli_stmt_close($stmt);
