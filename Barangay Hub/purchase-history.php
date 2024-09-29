<?php 

session_name("admin_session");
session_start();

include("config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: admin-login.php");
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

    <link rel="stylesheet" href="./styles.css">
    <title>Admin Home</title>
</head>

<body>
    
        <?php
        include("config.php");

        if (!isset($_SESSION['valid'])) {
            header("Location: admin-login.php");
        }

        require("connect.php");

        $msg = "";

        if (isset($_POST['new']) && $_POST['new'] == 0) {
            $Fullname = $_POST["Fullname"];
            $Email = $_POST["Email"];
            $Subjects = $_POST["Subjects"];
            $Dates = $_POST["Dates"];
            $Messages = $_POST["Messages"];
        
            $insert_query = "INSERT INTO `history` (`Fullname`, `Email`, `Subjects`, `Dates`, Messages)
                            VALUES ('$Fullname', '$Email', '$Subjects', '$Dates', '$Messages')";

            if (mysqli_query($connection, $insert_query)) {
                $msg = "Record was successfully added to the database!";
            } else {
                $msg = "Error: " . mysqli_error($connection);
            }
        }
        $result = mysqli_query($connection, 'SELECT * FROM history');
        $result = mysqli_query($connection, 'SELECT id, Fullname, Email, Subjects, Dates, Messages FROM history');
        ?>
    <!-- Your HTML and other content here -->
    <nav class="nav" style="background-color: #212529; padding: 1rem 2rem;">
        <a href="admin-home.php"> <button class="btn">Home</button> </a>
        <a href="logout-admin.php"> <button class="btn">Sign Out</button> </a>
        <a href=""> <button class="btn">Clear History</button> </a>
    </nav>

    <div class="about12" style="background-color: #212529; height: 90vh;
            display: flex; align-items: center; justify-content: center;
            padding: 0 2rem; flex-direction: column;">
                
    <h1 style="color: white; font-size: 3rem;">Message History</h1>
    <br>
    <table border="3" style="border: solid red;">
        <thead>
            <tr style="background-color: white; padding: 10px 10px;">
                <td style="padding: 10px 10px;">ID No.</td>
                <td style="padding: 10px 10px;" colspan="3">Full Name</td>
                <td style="padding: 10px 10px;" colspan="3">Email</td>
                <td style="padding: 10px 10px;" colspan="3">Subject</td>
                <td style="padding: 10px 10px;" colspan="3">Date</td>
                <td style="padding: 10px 10px;" colspan="3">Messages</td>
            </tr>
        </thead>

        <?php
        while ($row = mysqli_fetch_array($result)) {
        ?>
            <tr style="background-color: white; text-align: center;">
                <td style="padding: 10px 10px;"><?php echo $row['id']; ?></td>
                <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Fullname']; ?></td>
                <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Email']; ?></td>
                <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Subjects']; ?></td>
                <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Dates']; ?></td>
                <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Messages']; ?></td>
            </tr>
        <?php } ?>

    </table>

    </div>
</body>

</html>
