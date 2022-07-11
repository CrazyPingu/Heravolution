<?php
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"]) || $_SESSION["rights"] != "driver") {
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>
    <title> Driver license </title>
    <h1>Add driver license</h1>
    <link rel="stylesheet" href="../css-folder/General.css" />
    <link rel="icon" href="../images/Heravolution_logo.png">
    <?php
        $query = "SELECT IDOwns from owns where fiscalCode = '". $_SESSION["fiscalCode"] ."'";
        $result = $conn->query($query);
        $data =  $result->fetch_assoc();
        if($data["IDOwns"] != null) {
            echo "<input type='button' value='Driver page' onclick='window.location.href=\"DriverHome.php\"'></input><br>";
        }
        $query = "SELECT type FROM driver_license WHERE type NOT IN
            (SELECT type FROM owns WHERE fiscalCode = '". $_SESSION["fiscalCode"] ."')";
        $result = $conn->query($query);
        if ($result->num_rows > 0) { 
    ?>
    <form method = "POST">
        <select name = "license[]" multiple required>
            <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row["type"] . "'>type: " . $row["type"] . "</option>";
                    }
                }
            ?>
        </select>
        <br><input type = "submit" name = "submit" value = "Submit">
    </form>
    <?php
        } else {
            echo "No more licenses available";
        }
        if (isset($_POST["submit"])) {
            if (empty($_POST['license'])) {
                echo "<script>alert('You must select at least one license!')</script>";
            } else {
                $license = $_POST["license"];
                $query = "INSERT INTO owns (type, fiscalCode) VALUES ";
                foreach ($license as $l) {                   
                    $query .= "('".$l."','".$_SESSION["fiscalCode"]."'),";
                }
                $query = rtrim($query, ", ") . ";";
                $result = $conn->query($query);
                echo "<script>alert('License successfully added!')</script>";
                echo "<script>window.location.href='DriverHome.php'</script>";
            }
        }
    ?>
</html>