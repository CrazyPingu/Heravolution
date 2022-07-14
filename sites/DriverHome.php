<?php
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"]) || $_SESSION["rights"] != "driver") {
        header("Location: Login.php");
    }

?>

<!DOCTYPE html>
<html>
    <title> Driver Home </title>
    <link rel="stylesheet" href="../css-folder/General.css" />
    <link rel="icon" href="../images/Heravolution_logo.png">
    <h1> Driver Home </h1>
    
    <?php
        $query = "SELECT IDOwns from owns where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDOwns"] == null) {
            echo "<script>window.location.href='SignupLicenseDriver.php'</script>";
        }
        $query = "SELECT licensePlate from driver where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["licensePlate"] == null) {
            echo "<script>window.location.href='JoinVehicle.php'</script>";
        }

        $query = "SELECT driver.licensePlate, loadCapacity FROM driver, vehicle WHERE driver.fiscalCode = '". $_SESSION["fiscalCode"] ."' 
            AND driver.licensePlate = vehicle.licensePlate LIMIT 1";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        $licensePlate = $data["licensePlate"];
        $loadCapacity = $data["loadCapacity"];
        echo "License plate: ".$licensePlate." | Load capacity: ".$loadCapacity."<br>";
    ?>
    <br>
    <input type="button" value="Logout" onclick="window.location.href='Login.php'">
    <input type="button" value="Client page" onclick="window.location.href='ClientHome.php'">
    <input type="button" value="Add license" onclick="window.location.href='SignupLicenseDriver.php'">
    <input type="button" value="Change vehicle" onclick="window.location.href='JoinVehicle.php'">
    <input type="button" value="History of driven vehicles" onclick="window.location.href='HistoryDrivenVehicles.php'">

    <br>
    <h3> Deliver order</h3>
    <?php
    $query = "SELECT IDOrderOfProduct, address, weight FROM order_of_product WHERE licensePlate IS NULL";
    $result = $conn->query($query);
    if ($result->num_rows > 0) { ?>
    <form method="post">
        <select name = "order[]" multiple required>
            <?php
                while($data =  $result->fetch_assoc()) {
                    echo "<option value='".$data["IDOrderOfProduct"]."'>Address: ".$data["address"]." | Weight: ".$data["weight"]."</option>";
                }
            ?>
        </select>
        <br><br><input type="submit" name="submit" value="Submit">
    </form>
    <?php } else {
        echo "No orders to deliver";
    } ?>
    <br>
    <h3> Pick up garbage </h3>
    <?php 
    $query = "SELECT * FROM pick_up_garbage WHERE licensePlate IS NULL";
    $result = $conn->query($query);
    if($result->num_rows > 0) { ?>
        <form method="post">
            <select name = "garbage[]" multiple required>
                <?php
                    while($data =  $result->fetch_assoc()) {
                        echo "<option value='".$data["IDOrderGarbage"]."'>Address: ".$data["address"]." 
                            | date: ".$data["date"]." | time: ".$data["time"]." ! weight: ".$data["weight"]."</option>";
                    }
                ?>
            </select><br>
            Waste disposal: <select name = "disposal" required>
                <?php
                    $query = "SELECT * FROM waste_disposal";
                    $result = $conn->query($query);
                    while($data =  $result->fetch_assoc()) {
                        echo "<option value='".$data["IDWasteDisposal"]."'>".$data["address"]."</option>";
                    }
                ?>
            </select>
            <br><br><input type="submit" name="submit2" value="Submit">
        </form>
    <?php } else {
        echo "No garbage to pick up";
        }
        function getWeight($conn, $product, $table, $id) {
            $query = "SELECT SUM(weight) as totalWeight FROM ".$table." WHERE ".$id." IN (".implode(",", $product).") LIMIT 1";
            $result = $conn->query($query);
            $data =  $result->fetch_assoc();
            return $data["totalWeight"];
        }

        function removeLicensePlate($conn) {
            $query = "UPDATE driver SET licensePlate = NULL WHERE fiscalCode = '". $_SESSION["fiscalCode"] ."'";
            $result = $conn->query($query);
        }

        if(isset($_POST["submit"])) { //delivery order
            $totalWeight = getWeight($conn, $_POST["order"], "order_of_product", "IDOrderOfProduct");
            if ($loadCapacity >= $totalWeight) {
                $query = "UPDATE order_of_product SET licensePlate = '".$licensePlate."' 
                            WHERE IDOrderOfProduct IN (".implode(",", $_POST["order"]).")";
                $result = $conn->query($query);
                removeLicensePlate($conn);
                echo "<script>alert('Order delivered!')</script>";
                header("Location: ClientHome.php");
            } else {
                echo "<script>alert('Not enough load capacity!')</script>";
            }
        }
        if(isset($_POST["submit2"])) { //pick up garbage
            $totalWeight = getWeight($conn, $_POST["garbage"], "pick_up_garbage", "IDOrderGarbage");
            if ($loadCapacity >= $totalWeight) {
                $query = "UPDATE pick_up_garbage SET licensePlate = '".$licensePlate."', IDWasteDisposal = '".$_POST["disposal"]."' 
                            WHERE IDOrderGarbage IN (".implode(",", $_POST["garbage"]).")";
                $result = $conn->query($query);
                removeLicensePlate($conn);
                echo "<script>alert('Garbage picked up!')</script>";
                header("Location: ClientHome.php");
            } else {
                echo "<script>alert('Not enough load capacity!')</script>";
            }         
        }
    ?>
</html>