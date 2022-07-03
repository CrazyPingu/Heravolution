<?php
    require_once("Connection.php");
?>

<!DOCTYPE html>
<html>
    <title> Enter vehicle </title>
    <h1> Enter vehicle </h1>
    <?php
        $query = "SELECT IDDrives from drives where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDDrives"] != null) {
            echo "<input type='button' value='Driver page' onclick='window.location.href=\"DriverHome.php\"'></input><br><br>";
        }
    ?>

    <form method = "POST">
        <select name = "vehicle" required>
            <?php
                $query = "SELECT vehicle.* FROM vehicle, driver WHERE driver.licensePlate != vehicle.licensePlate AND driverLicense = ANY 
                (SELECT type from owns where fiscalCode = '". $_SESSION["fiscalCode"] ."')";
                $result = $conn->query($query);
                while($row = $result->fetch_assoc()) {
                    echo "<option value = '".$row['licensePlate']."'>".$row['licensePlate']." 
                    | brand: ".$row["brandName"]." | load capacity: ".$row["loadCapacity"]." kg | license: ".$row["driverLicense"]."</option>";
                }
            ?>
            </select>        
            <br><input type = "submit" name = "submit" value = "Submit">       
    </form>

    <?php
        if(isset($_POST['submit'])) {
            $query = "UPDATE driver SET licensePlate = '".$_POST['vehicle']."' WHERE fiscalCode = '". $_SESSION["fiscalCode"] ."'";
            $result = $conn->query($query);
            $query2 = "INSERT INTO drives(fiscalCode, licensePlate, date) VALUES(?, ?, ?)";
            $stmt = $conn->prepare($query2);
            $stmt->bind_param("sss", $_SESSION["fiscalCode"], $_POST['vehicle'], date("Y-m-d"));
            $stmt->execute();
            echo "<script>alert('Vehicle successfully added!')</script>";
            echo "<script>window.location.href='DriverHome.php'</script>";
        }
    ?>
</html>