<?php
session_start();
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
$calendar = new Calendar();
$calendar->add_event('Birthday', '2024-05-03', 1, 'green');
$calendar->add_event('Doctors', '2024-05-04', 1, 'red');
$calendar->add_event('Holiday', '2024-05-16', 7);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Event Calendar</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link href="calendar.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<label for="datum"></label>
	<input type="date" id="datum"/>
	<?php

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
