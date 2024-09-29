<?php 
session_name("user_session");
session_start();

include("config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>order petron brand</title>
</head>
<body style="background-color: black;">

    <div class="container" style="background-color: skyblue;">
        <div class="box form-box" style="background-color: skyblue !important;">

            <?php 
            include("config.php");
            
            if (isset($_POST['submit'])) {
                $Fullname = $_POST['Fullname'];
                $Destination = $_POST['Destination'];
                $Contact = $_POST['Contact'];
                $Quantity = $_POST['Quantity'];
                $Brand = $_POST['Brand'];
                $Total = $Quantity * 699;
            
                mysqli_query($con, "INSERT INTO orders (Fullname, Addresss, Contact, Brand, Quantity, Total) 
                                    VALUES ('$Fullname', '$Destination', '$Contact', '$Brand', '$Quantity', '$Total')")
                or die("Error Occurred");
            
                mysqli_query($con, "INSERT INTO history (Fullname, Addresss, Contact, Brand, Quantity, Total) 
                                    VALUES ('$Fullname', '$Destination', '$Contact', '$Brand', '$Quantity', '$Total')")
                or die("Error Occurred");
            
                echo "<div class='message'>
                        <p><h2 style='color: black;'>Transaction Complete!</h2></p>
                        <br><hr>
                        <br>
                        <p><h3>Order Receipt</h3></p>
                        <p>&quotTake a screenshot of this confirmation for your records.&quot</p>
                        <br>
                        <p><span style='color: black;'>Brand:</span> $Brand</p>
                        <p><span style='color: black;'>Quantity:</span> $Quantity</p>
                        <p><span style='color: black;'>Purchase total: </span>₱" . number_format($Total, 2) . "</p>
                        <br>
                      </div> <br>";
                echo "<a href='home.php'><button class='btn'>Home</button>";
            }
            else {
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM accounts WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $Fullname = $result['Fullname'];
                    $Destination = $result['Destination'];
                    $Contact = $result['Contact'];
                    $Brand = $result['Brand'];
                }
            ?>

            <header>Fill the form for your order/s</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="Fullname">Fullname</label>
                    <input type="text" name="Fullname" id="username" value="<?php echo $Fullname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Destination">Address</label>
                    <input type="text" name="Destination" id="username" value="<?php echo $Destination; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Contact">Contact</label>
                    <input type="number" name="Contact" id="username" value="<?php echo $Contact; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Brand">Brand</label>
                    <input type="text" name="Brand" id="ag" value="Calor" readOnly autocomplete="off" required>
                </div>
                
                <div class="field input">
                    <label id="quant" for="Quantity">Quantity</label>
                    <input type="number" name="Quantity" id="age" autocomplete="off" required>
                </div>
                <br>
                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Place Order" required>
                </div>

                <div class="field">
                    <a style="text-align: center;" href="home.php">Cancel</a>
                </div>
            </form>
            <?php } ?>
        </div>
    </div>

</body>
</html>
