<?php
session_start();

if (isset($_SESSION['ID']) && isset($_SESSION['gnaam'])) {

    ?>
<!DOCTYPE html> 
<html> 
      
<head> 
    <title> 
        Smart Home Website
    </title> 
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head> 
  
<body class="text-center"> 
    <div class="container">


            <h1>
                wil je de lampen aan of uit doen?
            </h1>
            <?php 
                if(isset($_POST['aan'])) { 
                    echo "De lampen gaan aan"; 
                    exec("sudo python3 ../../lamp_aan.py");
                } 
                if(isset($_POST['uit'])) { 
                    echo "De lampen gaan uit"; 
                    exec("sudo python3 ../../lamp_uit.py");
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
                    // test voor python files runnen door php bestanden
                    // dit is nodig omdat ik via php niet de gpio pins kan gebruiken van de raspberry pi om data door te sturen naar de nodige onderdelen.
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
