<?php
session_start();
date_default_timezone_set('Europe/Amsterdam'); 
include "../db_conn.php";
if (isset($_SESSION['ID']) && isset($_SESSION['gnaam'])) {
    $gnaam = $_SESSION['gnaam'];
?>
<head> 
    <title> 
        Smart Home Website
    </title> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head> 
<!-- dit is de navigatie bar samen met de bootstrap framework -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Home</a>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="Logboek.php">Logboek</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="info.php">info</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="kalenderview.php">kalender / planning</a>
        </li>
      </ul>
    </div>
  </div>
</nav> 
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
              if(isset($_POST['submit'])){
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

              while($row = $result->fetch_assoc()){
                $calendar->add_event($row["wat"] , $row["wanneer"] , $row["hoelang"] , $row["kleur"]);
            }
            while($row = $result->fetch_assoc()){
              if (date('Y-m-d') == $row["wanneer"] && date('H:i') == $row["tijd"]){
                exec("sudo python3 ../../lamp_aan.py");
              }
            }
	?>
		<div class="content home">
			<?=$calendar?>
		</div>
	</body>
</html>

	
</body>
</html>
<?php
}

else{
  header("Location: ../index.php?error=unknown");
  exit();
}
?>
