<?php 
    require_once("Connection.php");
?>
<!DOCTYPE html>
<html>
    <title> Sign in Warehouse </title>
    <?php
        $query = "SELECT IDWarehouse from warehouse_worker where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDWarehouse"] != null) {
            echo "<input type='button' value='Warehouse Worker Home page' onclick='window.location.href=\"WarehouseWorkerHome.php\"'></input>";
        }
    ?>
    <form method="post">
        <select name="warehouse" required>
            <?php
                $query = "SELECT IDWarehouse, address FROM warehouse";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=".$row["IDWarehouse"].">".$row["address"]."</option>";
                }
            ?>
        </select>
        <input type="submit" name="submit" value="submit">
        <?php
            if(isset($_POST["submit"])){
                $query = "UPDATE warehouse_worker SET IDWarehouse = '".$_POST["warehouse"]."' WHERE fiscalCode = '".$_SESSION["fiscalCode"]."'";
                $conn->query($query);
                echo "Added to warehouse";
                header("refresh:2;url=WarehouseWorkerHome.php");
            }
        ?>
    </form>
</html>