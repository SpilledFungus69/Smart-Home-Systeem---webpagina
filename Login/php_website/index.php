<?php
session_start();
include "../db_conn.php";
include 'kalender.php';
// Hier word er gekeken of je ingelogt bent, dit is zo op enke pagina.
if (isset($_SESSION['ID']) && isset($_SESSION['gnaam'])) {
    $gnaam = $_SESSION['gnaam'];
?>
    <!DOCTYPE html>
    <html>
    <?php include('header.php'); ?>

    <body class="text-center">
        <div class="container">
            <h1>
                wil je de lampen aan of uit doen?
            </h1>
            <?php
            // als je de lampen aan klikt dan: execute hij het python bestand, daarna stuurt hij de tijd en datum op naar de database.
            // dit geld ook voor uit.
            if (isset($_POST['aan'])) {
                echo "De lampen gaan aan";
                // de exec functie zorgt ervoor dat de python bestanden runnen.
                exec("sudo python3 ../../lamp_aan.py");
                $datum = date('Y-m-d H:i:s');
                $sql = "INSERT INTO logboek (wie, wat, wanneer) VALUES (' $gnaam ', 'Lampen aangezet','$datum')";
                mysqli_query($conn, $sql);
            }
            if (isset($_POST['uit'])) {
                echo "De lampen gaan uit";
                // de exec functie zorgt ervoor dat de python bestanden runnen.
                exec("sudo python3 ../../lamp_uit.py");
                $datum = date('Y-m-d H:i:s');
                $sql = "INSERT INTO logboek (wie, wat, wanneer) VALUES (' $gnaam ', 'Lampen uitgezet','$datum')";
                $result = mysqli_query($conn, $sql);
            }
            ?>
            <!-- de knoppen voor het aan en uitzetten van de lampen. -->
            <form method="post" class="form">
                <input type="submit" class="btn btn-primary btn-lg" name="aan"
                    value="aan" />

                <input type="submit" class="btn btn-primary btn-lg" name="uit"
                    value="uit" />
            </form>



            <h1>
                wil je de gordijnen open of dicht doen?
            </h1>

            <?php
            // Hier worden de gordijnen open en dicht gedaan.
            //verder werkt het hetzelfde als de lampen functie
            if (isset($_POST['open'])) {
                echo "De gordijnen gaan open";
                // de exec functie zorgt ervoor dat de python bestanden runnen.
                exec("sudo python3 ../../gordijn_open.py");
                $datum = date('Y-m-d H:i:s');
                $sql = "INSERT INTO logboek (wie, wat, wanneer) VALUES (' $gnaam ', 'gordijnen open gedaan','$datum')";
                $result = mysqli_query($conn, $sql);
                echo "De gordijnen gaan open";
            }
            if (isset($_POST['dicht'])) {
                echo "De gordijnen gaan dicht";
                // de exec functie zorgt ervoor dat de python bestanden runnen.
                exec("sudo python3 ../../gordijn_dicht.py");
                $datum = date('Y-m-d H:i:s');
                $sql = "INSERT INTO logboek (wie, wat, wanneer) VALUES (' $gnaam ', 'gordijnen dichtgedaan','$datum')";
                $result = mysqli_query($conn, $sql);
            }
            ?>
            </h1>

            <!-- Hier kan je de gordijnen open en dicht doen. -->
            <form method="post" class="form">
                <input type="submit" class="btn btn-primary btn-lg" name="open"
                    value="open" />

                <input type="submit" class="btn btn-primary btn-lg" name="dicht"
                    value="dicht" />
            </form>

        </div>
        <!-- form voor het sturen van de gegevens voor het invoegen in de kalender wanneer. -->
        <form method="POST" action="kalenderview.php" class="form">
            <label for="datum"></label>
            <input type="text" name="wat" placeholder="wat is de planning?" />
            <input type="date" name="datum" id="datum" value="<?php echo date('Y-m-d'); ?>" />
            <input type="time" name="tijd" id="tijd" />
            <input type="number" name="dagen" placeholder="hoeveel dagen" />
            <select name="color" id="color">
                <option value="red">rood</option>
                <option value="green">groen</option>
                <option value="blue">blauw</option>
                <option value="yellow">geel</option>
            </select>
            <input type="submit" value="toevoegen" name="submit">
        </form>

    </body>

    </html>

<?php
} else {
    // als je niet ingelogt bent word je teruggestuurd.
    header("Location: ../index.php?error=unknown");
    exit();
}
?>