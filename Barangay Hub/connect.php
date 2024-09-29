<?php
// Database connection configuration
// database nmae and properties (uname, pword)
$connection = mysqli_connect('localhost', 'root', '','delivery');


//Checking of db connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL Server" .
    mysqli_connect_errno();
} else {
    echo "";
}
?>