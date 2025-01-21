<?php
session_start();
include "../db_conn.php";
include 'kalender.php';

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
                    // dit geld ook voor uit.
                    // als je de lampen aan klikt dan: execute hij het python bestand, daarna stuurt hij de tijd en datum op naar de database.
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
              <!-- form voor het aangeven wanneer iets in de planning staat. -->
              <form method="POST" action="kalenderview.php" class="form">
                          <label for="datum"></label>
                          <input type="text" name="wat" placeholder="wat is de planning?"/>
                          <input type="date" name="datum" id="datum" value="<?php echo date('Y-m-d');?>"/>
                          <input type="time" name="tijd" id="tijd"/>
                          <input type="number" name="dagen"  placeholder="hoeveel dagen"/>
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
}

else{
  header("Location: ../index.php?error=unknown");
  exit();
}
?>
