<?php include "../db_conn.php"?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>logboek</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
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
      </ul>
    </div>
  </div>
</nav> 
<body>
    <!-- lijst van gebeurtenissen die gebeurt zijn door het aan en uitzetten van de lampen en de gordijnen open en dicht doen -->
    <h1>Lijst van gebeurtenissen</h1>
<table class="table">
    <thread>
        <tr>
            <th>wie</th>
            <th>wat</th>    
            <th>wanneer</th>  
        </tr>
    </tread>
    <tbody>
    <?php
    // sql query die alles pakt van de table van de database (logboek) en zet die daarna in de table op de website
    $sql = "SELECT * FROM logboek";
    $result = mysqli_query($conn, $sql);

    while($row = $result->fetch_assoc()){
        echo "<tr>
        <td> " .  $row["wie"] . "</td>
        <td> " . $row["wat"] . "</td>
        <td> " . $row["wanneer"] . "</td>
        
        
        ";
    }

    ?>
    </tbody>
</table>

    
</body>
</html>