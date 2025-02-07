<?php
session_start();
date_default_timezone_set('Europe/Amsterdam');
include "../db_conn.php";
if (isset($_SESSION['ID']) && isset($_SESSION['gnaam'])) {
  $gnaam = $_SESSION['gnaam'];
?>
  <?php include('header.php'); ?>

  <body>
    <?php
    include 'kalender.php';
    include "../db_conn.php";
    $calendar = new Calendar();
    ?>

    <head>
      <meta charset="utf-8">
      <title>kalender</title>
      <link href="style.css" rel="stylesheet" type="text/css">
      <link href="calendar.css" rel="stylesheet" type="text/css">
    </head>

    <body>
      <?php
      // kalender data in de database zetten en lezen voor wanneer de lichten aan moeten.
      if (isset($_POST['submit'])) {
        $wat   = $_POST['wat'];
        $datum = $_POST['datum'];
        $tijd  = $_POST['tijd'];
        $dagen = $_POST['dagen'];
        $kleur = $_POST['color'];

        $sql = "INSERT INTO kalender (wat, wanneer, hoelang, tijd, kleur) VALUES ('$wat', '$datum' , '$dagen', '$tijd', '$kleur')";
        $result = mysqli_query($conn, $sql);
      }
      $sql = "SELECT * FROM kalender";
      $result = mysqli_query($conn, $sql);

      while ($row = $result->fetch_assoc()) {
        $calendar->add_event($row["wat"], $row["wanneer"], $row["hoelang"], $row["kleur"]);
      }
      while ($row = $result->fetch_assoc()) {
        //wanneer de tijd en datum klopt wordt de juiste python bestand gerunt.
        if (date('Y-m-d') == $row["wanneer"] && date('H:i') == $row["tijd"]) {
          exec("sudo python3 ../../lamp_aan.py");
        }
      }
      ?>
      <div class="content home">
        <?= $calendar ?>
      </div>
    </body>

    </html>


  </body>

  </html>
<?php
} else {
  //als je niet ingelogt bent word je teruggestuurd naar de inlogpagina.
  header("Location: ../index.php?error=unknown");
  exit();
}
?>