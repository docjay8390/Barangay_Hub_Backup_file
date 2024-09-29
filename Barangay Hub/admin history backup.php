<?php 
   session_start();

   include("config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: admin-login.php");
   }

?>
<!--  -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">

    <link rel="stylesheet" href="./styles.css">
    <title>Admin Home</title>
</head>
<body>
    <div class="nav" style="background-color: #212529; padding: 1rem 2rem;">
        <div class="logo">
            <p><a href="home.php" style="color: red; font-style: italic; font-weight: 700;
            font-size: 3rem;"><span style="color: blue;">LPG</span> Gasul</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
           
           
           ?>
            <a href="admin-home.php"> <button class="btn">Home</button> </a>
            <a href="logout-admin.php"> <button class="btn">Sign Out</button> </a>
        </div>
    </div>

    <div class="about12" style="background-color: #212529; height: 90vh;
            display: flex; align-items: center; justify-content: center;
            padding: 0 2rem; flex-direction: column;">
        <?php
// Display record here...
require("connect.php");
// require("config.php");

//this is viewwing of records inside myql db

// $result = mysqli_query($connection, 'SELECT * FROM admin');
$result = mysqli_query($connection, 'SELECT * FROM history');


// these are record inside MYSQL
?>


<?php
// Add record here...

    //connecting the page using 

    // require("connect.php");
    require("config.php");

    $msg = ""; //to not display error an msg

    if (isset($_POST ['new']) && $_POST ['new'] == 0) {
        //collecting the inputed data inside the form

        $Fullname = $_REQUEST [ "Fullname"];
        $Contact = $_REQUEST [ "Contact"];
        $Addresss = $_REQUEST [ "Addresss"];
        $Quantity = $_REQUEST [ "Quantity"];
        $Brand = $_REQUEST [ "Brand"];
        $Total = $Quantity * 899;
        

    //this is database format for inserting the data

    $insert_query = "INSERT INTO `history` (`Fullname`, ``Brand`,
    `Contact`, `Addresss`, `Quantity`, `Total`)

    VALUES ('$Fullname', '$Contact', '$Addresss', '$Quantity', '$Brand', '$Total') 
    ";

    //requesting the db to add the new record

    mysqli_query ($connection, $insert_query);
    $msg = "Record was Successfully added inside the db!";
    }
    
?>

<?php
// Display record here...
require("connect.php");
// require("config.php");

//this is viewwing of records inside myql db

// $result = mysqli_query($connection, 'SELECT * FROM admin');
$result = mysqli_query($connection, 'SELECT id, Fullname, Contact, Addresss, Quantity, Brand, (Quantity * 899) AS Total FROM history');


// these are record inside MYSQL
?>


<?php
// Add record here...

    //connecting the page using 

    // require("connect.php");
    require("config.php");

    $msg = ""; //to not display error an msg

    if (isset($_POST ['new']) && $_POST ['new'] == 0) {
        //collecting the inputed data inside the form

        $Fullname = $_REQUEST [ "Fullname"];
        $Contact = $_REQUEST [ "Contact"];
        $Addresss = $_REQUEST [ "Addresss"];
        $Quantity = $_REQUEST [ "Quantity"];
        $Brand = $_REQUEST [ "Brand"];
        $Total = $Quantity * 899; // calculate total price

    //this is database format for inserting the data

    $insert_query = "INSERT INTO `history` (`Fullname`, 
    `Contact`, `Addresss`, `Quantity`, `Brand`, `Total`)

    VALUES ('$Fullname', '$Contact', '$Addresss', '$Quantity', '$Brand', '$Total') 
    ";

    //requesting the db to add the new record

    mysqli_query ($connection, $insert_query);
    $msg = "Record was Successfully added inside the db!";
    }
    
?>

<html>

<head>
    <title>User Accounts</title>
</head>

<body>
    <!-- this is the destination for inserting record -->
 
    <h1 style="color: White; font-size: 3rem;">Purchase History</h1>
    <br>
    <table border="3" style="border: solid red;">
        <!-- this is the title of the records -->
        <thead>
            <tr style="background-color: white;">
                <td>ID No.</td>
                <td colspan="3" style="padding: 0 5px">Full Name</td>
                <td colspan="3" style="padding: 0 5px">Contact Number</td>
                <td colspan="3" style="padding: 0 5px">Address</td>
                <td colspan="3" style="padding: 0 5px">Brand</td>
                <td colspan="3" style="padding: 0 5px">Quantity</td>
                
                <td colspan="3" style="padding: 0 5px">Total</td>
                
            </tr>
        </thead>

        
        <?php
            // these are record inside MYSQL

            while($row = mysqli_fetch_array($result) ) 
            {

     ?>

        <tr style="background-color: white;">
            <!--  -->
            <td colspan="" style="padding: 0 5px"><?php echo $row['id'];?>
            <td colspan="3" style="padding: 0 5px"><?php echo $row['Fullname'];?>
            <td colspan="3" style="padding: 0 5px"><?php echo $row['Contact'];?>
            <td colspan="3" style="padding: 0 5px"><?php echo $row['Addresss'];?>
            <td colspan="3" style="padding: 0 5px"><?php echo $row['Brand'];?>
            <td colspan="3" style="padding: 0 5px"><?php echo $row['Quantity'];?>
            
            <td colspan="3" style="padding: 0 5px"><?php echo number_format($row['Total'], 2);?>
            
            
        </tr>
        <?php }?>

    </table>
</body>

</html>
