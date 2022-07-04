<?php
    require_once("Connection.php");
    if (is_null($_SESSION["fiscalCode"])) {
        header("Location: Login.php");
    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Client Home</title>
    <link rel="stylesheet" href="../css-folder/General.css" />
    <h1>Client page</h1>
    <?php
        if ($_SESSION["rights"] == "driver") {
            echo "<input type='button' value='Driver page' onclick='window.location.href=\"DriverHome.php\"'></input>";
        }else if($_SESSION["rights"] == "warehouse_worker"){
            echo "<input type='button' value='Warehouse Worker page' onclick='window.location.href=\"WarehouseWorkerHome.php\"'></input>";
        }
    ?>
    <input type="button" value="Logout" onclick="window.location.href='Login.php'"></input>
    <input type="button" value="History of orders" onclick="window.location.href='HistoryOfOrders.php'"></input><br><br>
    <form method="POST">
        <h2>Order of products</h2>
        <br>
        Address:<input type="text" name="address" required><br>       
        <select name = "product[]" multiple required>
            <?php
                $query = "SELECT * FROM product WHERE IDOrder IS NULL ORDER BY productType";
                $result = $conn -> query($query);
                while ($row = $result -> fetch_assoc()) {
                    echo "<option value='" . $row["IDProduct"] . "'>" . $row["productType"] . " | price: " . $row["price"] . " | capacity: " . $row["capacity"] . "</option>";
                }
            ?>
        </select>

        <br><input type="submit" name="submit" value="Submit">
    </form>
    
    <form method="POST">
        <h2>Pick up garbage</h2>
        <h5>The price for each trashbag of garbage is 1€</h5>
        <input type="date" name="date" required><br>
        Time:<input type="text" name="time" required pattern="[0-2]{1}[0-9]{1}[:]{1}[0-5]{1}[0-9]{1}" placeholder = "00:00"><br>
        Address:<input type="text" name="address" required><br>

        <select name = "garbage[]" multiple required>
            <?php
                //forse bisogna usare il join
                $query = "SELECT product.* FROM product, trashbag WHERE product.productType = 'trashbag' 
                    AND trashbag.IDOrderGarbage IS NULL AND product.IDOrder = ANY
                    ( SELECT IDOrderOfProduct FROM order_of_product WHERE fiscalcode = '".$_SESSION['fiscalCode']."' AND licensePlate IS NOT NULL)
                    AND product.IDProduct = trashbag.IDProduct";
                $result = $conn -> query($query);
                while ($row = $result -> fetch_assoc()) {
                    echo "<option value='" . $row["IDProduct"] . "'>" . $row["productType"] . " | type: ".$row["garbageType"]." | capacity: ".$row["capacity"]." </option>";
                }
            ?>
        </select>
        <br><input type="submit" name="submit2" value="Submit">
    </form>

    <?php
        function get_discount($conn) {
            $query = "SELECT COUNT(*) AS counter FROM order_of_product WHERE fiscalCode = '".$_SESSION['fiscalCode']."'";
            $result = $conn -> query($query);
            $row = $result -> fetch_assoc();
            if ($row['counter'] >= 10 && $row['counter'] < 15) {
                return 10;
            } else if ($row['counter'] >= 15) {
                return 20;
            } else {
                return 0;
            }
        }

        function get_array($array) {
            return implode(",", array_map("intval", $array));
        }

        function get_weight($conn, $product) {
            $query = "SELECT SUM(capacity) AS weight FROM product 
                WHERE IDProduct IN (".get_array($product).")";
            $result = $conn -> query($query);
            $row = $result -> fetch_assoc();
            return $row['weight'];
        }

        if(isset($_POST['submit2'])) {
            if (empty($_POST['garbage'])) {
                echo "<script>alert('No product selected')</script>";
            } else {
                $weight = get_weight($conn, $_POST['garbage']);
                $totalPrice = count($_POST["garbage"]);
                $query = "INSERT INTO pick_up_garbage(fiscalCode, date, time, address, totalPrice, weight) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn -> prepare($query);
                $stmt -> bind_param("ssssii", $_SESSION['fiscalCode'], $_POST['date'], $_POST['time'], $_POST['address'], $totalPrice, $weight);
                $stmt -> execute();
                $last_id = $conn -> insert_id;

                //aggiungo l'id dell'ordine ai prodotti
                $query = "UPDATE trashbag SET IDOrderGarbage = ".$last_id." WHERE IDProduct IN (".get_array($_POST["garbage"]).")";
                $conn -> query($query);
                echo "<script>alert('Order added')</script>";
                header("Location: ClientHome.php");
            }

        }

        if (isset($_POST['submit'])) {
            $discount = get_discount($conn);
            if (empty($_POST['product'])) {
                echo "<script>alert('No product selected')</script>";
            } else {
                $weight = get_weight($conn, $_POST['product']);

                $query = "SELECT SUM(price) as totalPrice FROM product WHERE IDProduct IN (".get_array($_POST["product"]).")";
                $result = $conn -> query($query);
                $row = $result -> fetch_assoc();
                $totalPrice = $row['totalPrice'];
                if ($discount > 0) {
                    $totalPrice -= $totalPrice * $discount / 100;
                }
                $time = date("H-i");
                $date = date("Y-m-d");
                $query = "INSERT INTO order_of_product(date, time, address, discountValue, totalPrice, fiscalCode, weight)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn -> prepare($query);
                $stmt -> bind_param("sssiisi", $date, $time, $_POST['address'], $discount, $totalPrice, $_SESSION['fiscalCode'], $weight);
                $stmt -> execute();
                $last_id = $conn -> insert_id;

                //aggiungo l'id dell'ordine ai prodotti
                $query = "UPDATE product SET IDOrder = ".$last_id." WHERE IDProduct IN (".get_array($_POST["product"]).")";
                $conn -> query($query);
                echo "<script>alert('Order added')</script>";
                header("Location: ClientHome.php");
            }
        }
    ?>

</html>