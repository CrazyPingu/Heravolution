<?php
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"]) || $_SESSION["rights"] != "warehouse_worker") {
        header("Location: Login.php");
    }
?>
<!DOCTYPE html>
<html>
    <title> WarehouseWorkerHome </title>
    <link rel="stylesheet" href="../css-folder/General.css" />
    <link rel="icon" href="../images/Heravolution_logo.png">
    <?php
        $query = "SELECT IDWarehouse from warehouse_worker where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDWarehouse"] == null) {
            echo "<script>window.location.href='SignupWarehouse.php'</script>";
        }
        $idwarehouse = $data["IDWarehouse"];
    ?>
    <h1>Warehouse worker home</h1>
    <input type="button" value="Logout" onclick="window.location.href='Login.php'">
    <input type="button" value="Client page" onclick="window.location.href='ClientHome.php'">
    <input type="button" value="Change Warehouse" onclick="window.location.href='SignupWarehouse.php'">
    <input type="button" value="Warehouse inventory" onclick="window.location.href='InventoryWarehouse.php'">

    <br><br>
    <h2>Add products</h2>
    <form method = "POST">
        <select name="productType" required>
            <option value="container">Container</option>
            <option value="trashbag">Trashbag</option>
        </select>
        <br>
        <select name="garbageType" required>
            <?php
                $query = "SELECT type FROM garbage";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["type"].">".$row["type"]."</option>";
                }
            ?>
        </select>
        <br>
        Quantity: <input type='number' name='quantity' required min=1 placeholder = "0"><br>
        Capacity: <input type='number' name='capacity' required min=1 placeholder = "0"><br>
        Price: <input type='number' name='price' required min = 1 placeholder = "0" style="position:relative;left:20px;"><br>
        <input type="submit" name="submit" value="submit">
    </form>

    <?php
        if(isset ($_POST["submit"])) {
            $query = "INSERT INTO product (price, productType, capacity, garbageType, IDWarehouse) VALUES ";
            for ($i=0; $i < $_POST["quantity"]; $i++) {     
                $query .= "('".$_POST["price"]."','".$_POST["productType"]."','".$_POST["capacity"]."',
                '".$_POST["garbageType"]."','". $idwarehouse."'),";
            }
            $query = rtrim($query, ",") . ";";
            $result = $conn->query($query);
            $first_id = $conn->insert_id;
            // * PRODOTTO AGGIUNTO, AGGIUNGO IL PRODOTTO AL MAGAZZINO
            $query = "INSERT INTO " .$_POST["productType"]. "(IDProduct) VALUES";
            for ($i=0; $i < $_POST["quantity"]; $i++) {     
                
                $query .= "('".$first_id."'),";
                $first_id++;
            }
            $query = rtrim($query, ", ") . ";";
            $result = $conn->query($query);
            echo "<script>alert('Product added')</script>";
        }
    ?>
</html>
