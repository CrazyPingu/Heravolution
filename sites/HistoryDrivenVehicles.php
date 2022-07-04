<?php
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"]) || $_SESSION["rights"] != "driver") {
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>History of driven vehicles</title>
    </head>
    <body>
        <link rel="stylesheet" href="../css-folder/Table.css" />
        <link rel="icon" href="../images/Heravolution_logo.png">
        <h1>History of driven vehicles</h1>
        <?php
            $query = "SELECT date, drives.licensePlate, loadCapacity, driverLicense, brandName FROM drives, vehicle 
                WHERE fiscalCode = '". $_SESSION["fiscalCode"] ."' AND drives.licensePlate = vehicle.licensePlate";
            $result = $conn->query($query);
            echo "<table><tr><th>Date</th><th>License plate</th><th>Load capacity</th><th>Driver license required</th>
            <th>Brand</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["date"]. "</td><td>" . $row["licensePlate"]. "</td>
                <td>" . $row["loadCapacity"]. "</td><td>" . $row["driverLicense"]. "</td>
                <td>".$row["brandName"]."</td></tr>";
            }
            echo "</table>";
            ?>
        <br><br><input type="button" value="Driver page" onclick="window.location.href='DriverHome.php'">
    </body>
</html>