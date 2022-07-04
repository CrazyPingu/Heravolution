<?php
    require_once('Connection.php');
    session_unset();
?>

<!DOCTYPE html>
<html>
<Title>Login</Title>
<link rel="stylesheet" href="../css-folder/Login.css" />

<body>
    <form method="post">
        <img src="Heravolution.png" alt="Logo" style="width:30%;" class="formatoimmagine"><br>
        Username <input type="text" name="username" style="position:relative;left:30px;" required><br>
        Password <input type="password" name="password" style="position:relative;left:30px;" required><br>
        <input type="submit" name="submit" class="bottonelog" value="Login"></input><br>
    </form>
    First time entering? <button onclick="window.location.href='Signup.php'" class="bottonelog" style="width:10%">Sign up</button><br><br>
</body>

<?php
    if (isset($_POST["submit"])) {
        
        $query = "SELECT fiscalCode, userType, password FROM client WHERE username = '" . $_POST["username"] . "' LIMIT 1 ";
        $result = $conn->query($query);
        if ($result -> num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($_POST["password"], $row["password"])) {
                $_SESSION["fiscalCode"] = $row["fiscalCode"];
                $_SESSION["rights"] = $row["userType"];
                header("Location: ClientHome.php");
            }
        }
        echo "<script>alert('Invalid username or password')</script>";
    }
?>
</html>