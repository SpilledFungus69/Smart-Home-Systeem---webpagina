<?php include "../db_conn.php"?>

<!DOCTYPE html>
<html lang="en">
<?php include('header.php'); ?>
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