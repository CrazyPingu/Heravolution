<?php
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"])) {
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>History of orders</title>
    </head>
    <link rel="stylesheet" href="../css-folder/Table.css" />
    <link rel="icon" href="../images/Heravolution_logo.png">
    <h1>History of Orders</h1>
    <?php
        $query = "SELECT date, address, discountValue, totalPrice, weight, licensePlate FROM order_of_product WHERE fiscalCode = '" . $_SESSION["fiscalCode"] . "' ORDER BY IDOrderOfProduct";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>Date</th><th>Address</th><th>Discount value</th><th>Total price</th><th>Weight</th><th>Delivered</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if (is_null($row["licensePlate"])) {
                    $delivered = "no";
                } else {
                    $delivered = "yes";
                }
                echo "<tr><td>" . $row["date"]. "</td><td>" . $row["address"]. "</td>
                <td>" . $row["discountValue"]. "</td><td>" . $row["totalPrice"]. "</td><td>".$row["weight"]."</td><td>" . $delivered. "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No orders";
        }
        ?>
    <h1>History of garbage orders</h1>
    <?php
        $query = "SELECT licensePlate, date, address, totalPrice, weight FROM pick_up_garbage WHERE fiscalCode = '" . $_SESSION["fiscalCode"] . "' ORDER BY IDOrderGarbage";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>Date</th><th>Address</th><th>Total price</th><th>Weight</th><th>Delivered</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if (is_null($row["licensePlate"])) {
                    $delivered = "no";
                } else {
                    $delivered = "yes";
                }
                echo "<tr><td>" . $row["date"]. "</td><td>" . $row["address"]. "</td>
                <td>" . $row["totalPrice"]. "</td><td>".$row["weight"]."</td><td>" . $delivered. "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No orders";
        }
        ?>
    <br><br><input type="button" value="Client page" onclick="window.location.href='ClientHome.php'">
    </html>