<?php
    require_once("Connection.php");
?>

<!DOCTYPE html>
<html>
    <title> Driver Home </title>
    <h1> Driver Home </h1>
    <br><br>
    <?php
        $query = "SELECT IDOwns from owns where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDOwns"] == null) {
            echo "<script>window.location.href='SignupLicenseDriver.php'</script>";
        }
        $query = "SELECT IDDrives from drives where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDDrives"] == null) {
            echo "<script>window.location.href='JoinVehicle.php'</script>";
        }
    ?>
    <input type="button" value="Logout" onclick="window.location.href='Login.php'">
    <input type="button" value="Client page" onclick="window.location.href='ClientHome.php'">
    <input type="button" value="Add license" onclick="window.location.href='SignupLicenseDriver.php'">
    <input type="button" value="Change vehicle" onclick="window.location.href='JoinVehicle.php'">

    <br><br>
    <?php
        $query = "SELECT licensePlate FROM driver WHERE fiscalCode = '". $_SESSION["fiscalCode"] ."' LIMIT 1";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        echo "License plate: ".$data["licensePlate"];
    ?>

    <br><br>
    <h3> Deliver order</h3>
    <br><br>

    <form method="post">
        <select name = "order[]" multiple required>
            <?php
                $query = "SELECT * FROM order_of_product WHERE licensePlate IS NULL";
                $result = $conn->query($query);
                while($data =  $result->fetch_assoc()) {
                    echo "<option value='".$data["IDOrderOfProduct"]."'>Address: ".$data["address"]."</option>";
                }
            ?>
        </select>
    </form>

    <br><br>
    <h3> Pick up garbage </h3>
    <br><br>

    <form method="post">
        <select name = "garbage[]" multiple required>
            <?php
                $query = "SELECT * FROM pick_up_garbage";
                $result = $conn->query($query);
                while($data =  $result->fetch_assoc()) {
                    echo "<option value='".$data["IDGarbage"]."'>Address: ".$data["address"]." 
                        | date: ".$row["date"]." | time: ".$row["time"]."</option>";
                }
            ?>
        </select>
    </form>
    
</html>