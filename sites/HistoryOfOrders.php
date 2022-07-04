<?php
    require_once("Connection.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>History of Orders</title>
    </head>
    <body>
    <input type="button" value="Client page" onclick="window.location.href='ClientHome.php'"><br><br>
    <h1>History of Orders</h1>
    <?php
        $query = "SELECT * FROM order_of_product WHERE fiscalCode = '" . $_SESSION["fiscalCode"] . "' ORDER BY IDOrderOfProduct";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>Date</th><th>Address</th><th>Discount value</th><th>Total price</th><th>Delivered</th></tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if (is_null($row["licensePlate"])) {
                    $delivered = "no";
                } else {
                    $delivered = "yes";
                }
                echo "<tr><td>" . $row["date"]. "</td><td>" . $row["address"]. "</td>
                    <td>" . $row["discountValue"]. "</td><td>" . $row["totalPrice"]. "</td><td>" . $delivered. "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No orders";
        }
    ?>
    </body>
</html>