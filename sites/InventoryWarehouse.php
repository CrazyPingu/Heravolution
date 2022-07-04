<?php
    require_once("Connection.php");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Inventory of the warehouse</title>
    </head>
    <body>
    <input type="button" value="Worker page" onclick="window.location.href='WarehouseWorkerHome.php'"><br><br>
    <h1>Inventory of the warehouse</h1>
    <?php
        $query = "SELECT address, productType, capacity, price, garbageType FROM warehouse, product 
            WHERE IDOrder IS NULL AND product.IDWarehouse = warehouse.IDWarehouse ORDER BY warehouse.IDWarehouse";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            echo "<table><tr><th>Address</th><th>Product type</th><th>Capacity</th><th>Price</th><th>Garbage type</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["address"] . "</td><td>" . $row["productType"] . "</td><td>" . $row["capacity"] . "</td><td>" . $row["price"] . "</td><td>" . $row["garbageType"] . "</td></tr>";
            }
            echo "</table>";
        } else {
            echo "No products in stock";
        }
    ?>
    </body>
</html>