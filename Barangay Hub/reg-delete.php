
<?php 

if ( isset ($_GET["id"]) ) {
    $id = $_GET["id"];


    $servername = "localhost";
    $username = "root";
    $password ="";
    $database = "delivery";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM registered WHERE id=$id";
    $connection->query($sql);
}


header("Location: registered.php");
exit;
?>