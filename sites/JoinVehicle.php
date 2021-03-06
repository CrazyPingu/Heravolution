<?php
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"]) || $_SESSION["rights"] != "driver") {
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
    <title> Enter vehicle </title>
    <link rel="stylesheet" href="../css-folder/General.css" />
    <link rel="icon" href="../images/Heravolution_logo.png">
    <h1> Enter vehicle </h1>
    <?php
        $query = "SELECT licensePlate from driver where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["licensePlate"] != null) {
            echo "<input type='button' value='Driver page' onclick='window.location.href=\"DriverHome.php\"'></input><br><br>";
        }
    ?>
    <input type='button' value='Client page' onclick='window.location.href="ClientHome.php"'></input><br><br>
    <?php
        $query = "SELECT vehicle.* FROM vehicle, driver WHERE
            driverLicense IN
            (SELECT type from owns where fiscalCode = '". $_SESSION["fiscalCode"] ."')
            AND vehicle.licensePlate NOT IN (SELECT licensePlate FROM driver WHERE licensePlate IS NOT NULL)
            GROUP BY vehicle.licensePlate";
        $result = $conn->query($query);
        if ($result->num_rows > 0) { ?>
    <form method = "POST">
        <select name = "vehicle" required>
            <?php
                while($row = $result->fetch_assoc()) {
                    echo "<option value = '".$row['licensePlate']."'>".$row['licensePlate']." 
                    | brand: ".$row["brandName"]." | load capacity: ".$row["loadCapacity"]." kg | license: ".$row["driverLicense"]."</option>";
                }
            ?>
            </select>        
            <br><input type = "submit" name = "submit" value = "Submit">       
    </form>
    <?php
        } else {
            echo "No vehicles available";
        }
        if(isset($_POST['submit'])) {
            $query = "UPDATE driver SET licensePlate = '".$_POST['vehicle']."' WHERE fiscalCode = '". $_SESSION["fiscalCode"] ."'";
            $result = $conn->query($query);
            $query2 = "INSERT INTO drives(fiscalCode, licensePlate, date) VALUES(?, ?, ?)";
            $stmt = $conn->prepare($query2);
            $stmt->bind_param("sss", $_SESSION["fiscalCode"], $_POST['vehicle'], date("Y-m-d"));
            $stmt->execute();
            echo "<script>alert('Vehicle successfully added!')</script>";
            header("Location: DriverHome.php");
        }
    ?>
</html>