<?php 
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"]) || $_SESSION["rights"] != "warehouse_worker") {
        header("Location: Login.php");
    }
?>
<!DOCTYPE html>
<html>
    <title> Sign in Warehouse </title>
    <link rel=stylesheet href="../css-folder/General.css" />
    <link rel="icon" href="../images/Heravolution_logo.png">
    <h1> Sign in Warehouse </h1>
    <?php
        $query = "SELECT IDWarehouse from warehouse_worker where fiscalCode = '". $_SESSION["fiscalCode"] ."' LIMIT 1";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDWarehouse"] != null) {
            echo "<input type='button' value='Warehouse worker page' onclick='window.location.href=\"WarehouseWorkerHome.php\"'></input>";
        }
    ?>
    <br>
    <br>
    <form method="post">
        Warehouse available: <select name="warehouse" required>
            <?php
                $query = "SELECT warehouse.IDWarehouse, address FROM warehouse, warehouse_worker 
                    WHERE warehouse.IDWarehouse != warehouse_worker.IDWarehouse AND fiscalCode = '". $_SESSION["fiscalCode"] ."'";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["IDWarehouse"].">".$row["address"]."</option>";
                }
            ?>
        </select>
        <br><br>
        <input type="submit" name="submit" value="submit">
        <?php
            if(isset($_POST["submit"])){
                $query = "UPDATE warehouse_worker SET IDWarehouse = '".$_POST["warehouse"]."' WHERE fiscalCode = '".$_SESSION["fiscalCode"]."'";
                $conn->query($query);
                echo "<script>alert('Warehouse updated');</script>";
                header("refresh:2;url=WarehouseWorkerHome.php");
            }
        ?>
    </form>
</html>