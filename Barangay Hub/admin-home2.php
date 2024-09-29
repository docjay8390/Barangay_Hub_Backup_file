<?php
// Display record here...
require("connect.php");
// require("config.php");

//this is viewwing of records inside myql db

// $result = mysqli_query($connection, 'SELECT * FROM admin');
$result = mysqli_query($connection, 'SELECT id, Fullname, Contact, Addresss, Quantity, (Quantity * 899) AS Total FROM orders');


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

    $insert_query = "INSERT INTO `orders` (`Fullname`, `Brand`, 
    `Contact`, `Addresss`, `Quantity`, `Total`)

    VALUES ('$Fullname', '$Contact', '$Addresss', '$Brand', '$Quantity', '$Total') 
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
 
    <h1 style="color: White; font-size: 3rem;">Orders</h1>
    <br>
    <table border="3" style="border: solid red;">
        <!-- this is the title of the records -->
        <thead>
            <tr style="background-color: white;">
                <td>ID No.</td>
                <td colspan="3" style="padding: 0 5px">Full Name</td>
                <td colspan="3" style="padding: 0 5px">Contact Number</td>
                <td colspan="3" style="padding: 0 5px">Address</td>
                <td colspan="3" style="padding: 0 5px">Quantity</td>
                <td colspan="3" style="padding: 0 5px">Brand</td>
                <td colspan="3" style="padding: 0 5px">Total</td>
                <td colspan="3" style="padding: 0 5px">Delete</td>
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
            <td colspan="3" style="padding: 0 5px"><?php echo $row['Quantity'];?>
            <td colspan="3" style="padding: 0 5px"><?php echo number_format($row['Total'], 2);?>
            
            <td><a href="delete.php?id=<?php echo $row ["id"];?>">Delete</a></td>
        </tr>
        <?php }?>

    </table>
</body>

</html>
