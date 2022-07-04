<?php
require_once('Connection.php');
?>
<!DOCTYPE html>
<html>
<title> Registration </title>
<link rel="stylesheet" href="../css-folder/Login.css" />

<body onload="zoom()">
    <img src="Heravolution.png" alt="Logo" style="width:26%;" class="formatoimmagine"><br>
    <form method="POST">
        Name <input type="text" name="name" style="position:relative;left:100px" required><br>
        Surname <input type="text" name="surname" style="position:relative;left:80px" required><br>
        FiscalCode<input type="text" name="fiscalCode" style="position:relative;left:70px" pattern="[A-Z]{6}[0-9]{2}[A-Z]{1}[0-9]{2}[A-Z]{1}[0-9]{3}[A-Z]{1}" required><br>
        Username <input type="text" name="username" style="position:relative;left:75px" required><br>
        Password <input type="password" name="password" style="position:relative;left:75px" required><br>
        Confirm <input type="password" name="confirm" style="position:relative;left:90px" required><br>
        <select name="type" style="position:relative;left:75px;width:30%;font-size: 30px;" required>
            <option value="client">Client</option>
            <option value="driver">Driver</option>
            <option value="warehouse_worker">Warehouse Worker</option>
        </select><br>
        <input type="submit" value="Submit" class="bottonelog" name="submit"></input>
    </form>
    Do you already have an account? <button onclick="window.location.href='Login.php'" class="bottonelog" style="width:10%">Login now</button><br>
</body>
<script>
    function zoom() {
        document.body.style.zoom = "65%";
    }
</script>
<?php
if (isset($_POST["submit"])) {
    $query = "SELECT * FROM client WHERE fiscalCode = '" . $_POST["fiscalCode"] . "'";
    $result = $conn -> query($query);
    $query2 = "SELECT * FROM client WHERE username = '" . $_POST["username"] . "'";
    $result2 = $conn -> query($query2);
    if ($result -> num_rows > 0) {
        echo "<script>alert('Fiscal Code already exists')</script>";
    } elseif ($result2 -> num_rows > 0) {
        echo "<script>alert('Username already exists')</script>";
    } elseif (strcmp($_POST["password"], $_POST["confirm"]) != 0) {
        echo "<script>alert('Wrong password')</script>";
    } else {
        $stmt = $conn->prepare("insert into client(name, surname, fiscalCode, username, password, userType) values (?,?,?,?,?,?)");
        $hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
        $stmt->bind_param("ssssss", $_POST["name"], $_POST["surname"], $_POST["fiscalCode"], $_POST["username"], $hash, $_POST["type"]);
        $stmt->execute();
        if (strcmp($_POST["type"], "client") != 0) {
            $query = $conn -> prepare("INSERT INTO ".$_POST['type']."(fiscalCode) VALUES (?)");
            $query->bind_param("s", $_POST["fiscalCode"]);
            $query->execute();
        }
        echo "User created, you can now login";
        header("refresh:3;url=Login.php");    //lo mando alla pagina del login dopo 3 secondi
    }
}
?>

</html>