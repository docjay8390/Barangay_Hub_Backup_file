
<?php 

if ( isset ($_GET["id"]) ) {
    $id = $_GET["id"];


    $servername = "localhost";
    $username = "root";
    $password ="";
    $database = "delivery";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM orders WHERE id=$id";
    $connection->query($sql);
}


header("Location: messages.php");
exit;
?>