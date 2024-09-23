<?php
session_start();
include "../db_conn.php";
include 'kalender.php';

if (isset($_SESSION['ID']) && isset($_SESSION['gnaam'])) {
    $gnaam = $_SESSION['gnaam'];
?>
<!DOCTYPE html> 
<html> 
     
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
        <body class="text-center"> 
            <div class="container">
                    <h1>
                        wil je de lampen aan of uit doen?
                    </h1>
                    <?php 
                    // dit geld ook voor uit.
                    //als je de lampen aan klikt dan: execute hij het python bestand, daarna stuurt hij de tijd en datum op naar de database.
                        if(isset($_POST['aan'])) { 
                            echo "De lampen gaan aan"; 
                            exec("sudo python3 ../../lamp_aan.py");
                            $datum = date('Y-m-d H:i:s');
                            $sql = "INSERT INTO logboek (wie, wat, wanneer) VALUES (' $gnaam ', 'Lampen aangezet','$datum')";
                            mysqli_query($conn, $sql);
                        }            
                        if(isset($_POST['uit'])) { 
                            echo "De lampen gaan uit"; 
                            exec("sudo python3 ../../lamp_uit.py");
                            $datum = date('Y-m-d H:i:s');
                            $sql = "INSERT INTO logboek (wie, wat, wanneer) VALUES (' $gnaam ', 'Lampen uitgezet','$datum')";
                            $result = mysqli_query($conn, $sql);
                        } 
                    ?> 

                    
                    <form method="post" class="form" > 
                            <input type="submit" class="btn btn-primary btn-lg" name="aan"
                                value="aan"/> 

                        <input type="submit" class="btn btn-primary btn-lg" name="uit"
                                    value="uit"/> 
                        </form> 

                    
                    
                        <h1>
                            wil je de gordijnen open of dicht doen?
                        </h1>

                    <?php 
                        if(isset($_POST['open'])) { 
                            // hier moeten ook nog python bestanden, maar ik heb de hardware niet daarvoor, dus nog overbodig om te coderen 
                            //(bijna hetzelfde als met de lampen python bestanden)
                            echo "De gordijnen gaan open"; 
                        } 
                        if(isset($_POST['dicht'])) { 
                            echo "De gordijnen gaan dicht"; 
                        } 
                    ?> 
                    </h1>

                    
                    <form method="post" class="form" > 
                            <input type="submit" class="btn btn-primary btn-lg" name="open"
                                value="open"/> 

                        <input type="submit" class="btn btn-primary btn-lg" name="dicht"
                                    value="dicht"/> 
                        </form> 

            </div>
  
</body> 
</html> 

<?php
}

else{
  header("Location: ../index.php?error=unknown");
  exit();
}
?>
