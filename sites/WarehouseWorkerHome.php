<?php
    require_once("Connection.php");
?>
<!DOCTYPE html>
<html>
    <title> WarehouseWorkerHome </title>
    <?php
        $query = "SELECT IDWarehouse from warehouse_worker where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDWarehouse"] == null) {
            echo "<script>window.location.href='SignupWarehouse.php'</script>";
        }
    ?>
    <input type="button" value="Logout" onclick="window.location.href='Login.php'">
    <input type="button" value="Client Home" onclick="window.location.href='ClientHome.php'">
    <input type="button" value="Change Warehouse" onclick="window.location.href='SignupWarehouse.php'">
    <input type="button" value="Warehouse inventory" onclick="window.location.href='InventoryWarehouse.php'">
    <form method = "POST">
        <select name="productType" required>
            <?php
                $query = "SELECT productType FROM product_type";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["productType"].">".$row["productType"]."</option>";
                }
            ?>
        </select>
        <select name="garbageType" required>
            <?php
                $query = "SELECT type FROM garbage";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["type"].">".$row["type"]."</option>";
                }
            ?>
        </select>
        Quantity: <input type='number' name='quantity' required min=1 placeholder = "0">
        Capacity: <input type='number' name='capacity' required min=1 placeholder = "0">
        Price: <input type='text' name='price' required min = 1 placeholder = "0">
        <input type="submit" name="submit" value="submit">
    </form>

    <?php
        if(isset ($_POST["submit"])) {
            $query = "SELECT IDWarehouse from warehouse_worker where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
            $result = $conn->query($query);
            $data =  $result->fetch_assoc();
            for ($i=0; $i < $_POST["quantity"]; $i++) { 
                $query = "INSERT INTO product (price, productType, capacity, garbageType, IDWarehouse) VALUES (?,?,?,?,?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("isisi", $_POST["price"], $_POST["productType"], $_POST["capacity"], $_POST["garbageType"], $data["IDWarehouse"]);
                $stmt->execute();
                // * PRODOTTO AGGIUNTO, AGGIUNGO IL PRODOTTO AL MAGAZZINO
                $last_id = $conn->insert_id;
                $query2 = "INSERT INTO " .$_POST["productType"]. "(IDProduct) VALUES (?)";
                $stmt = $conn->prepare($query2);
                $stmt->bind_param("i", $last_id);
                $stmt->execute();
            }
            echo "<script>alert('Product added')</script>";
        }
    ?>
</html>
