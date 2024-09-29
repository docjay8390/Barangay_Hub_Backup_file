<?php
// Display record here...
require("connect.php");
// require("config.php");

//this is viewwing of records inside myql db

$result = mysqli_query($connection, 'SELECT * FROM admin');
$result = mysqli_query($connection, 'SELECT * FROM accounts');


// these are record inside MYSQL
?>


<?php
// Add record here...

    //connecting the page using 

    require("connect.php");
    // require("config.php");

    $msg = ""; //to not display error an msg

    if (isset($_POST ['new']) && $_POST ['new'] == 1) {
        //collecting the inputed data inside the form

        $Fullname = $_REQUEST [ "Fullname"];
        $Contact = $_REQUEST [ "Contact"];
        $Destination = $_REQUEST [ "Destination"];
        $Quantity = $_REQUEST [ "Quantity"];

    //this is database format for inserting the data

    $insert_query = "INSERT INTO `accounts` (`Fullname`, 
    `Contact`, `Address`, `Quantity`)

    VALUES ('$Fullname', '$Contact', '$Destination', '$Quantity') 
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
 
    <h1>Orders</h1>

    <table border="3">
        <!-- this is the title of the records -->
        <thead>
            <tr>
                <!-- <td>ID No.</td> -->
                <td>Full Name</td>
                <td>Contact Number</td>
                <td>Address</td>
                <td>Quantity</td>
                <td>Delete</td>
            </tr>
        </thead>

        
        <?php
            // these are record inside MYSQL

            while($row = mysqli_fetch_array($result) ) 
            {

        ?>

        <tr>
            <!--  -->
            <td><?php echo $row['Fullname']; ?>
            <td><?php echo $row['Contact']; ?>
            <td><?php echo $row['Destination']; ?>
            <td><?php echo $row['Quantity']; ?>
        </tr>
        <?php } ?>

    </table>
</body>

</html>


<!-- <td><a href="edit.php?user_id=<php echo $row ["user_id"]; ?>">EDIT</a></td> -->