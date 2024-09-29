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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>

    <title>Business Permit</title>

    <!-- Css Link -->
    <link rel="stylesheet" href="./style.css">

    <!-- Links -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />

    <!-- tailwind Links-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
</head>
<body>

<div class="min-h-screen bg-gray-800 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
            <div
                class="absolute inset-0 bg-gradient-to-r from-indigo-700 to-purple-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
            </div>
            <div class="text-white relative px-4 py-10 bg-indigo-400 shadow-lg sm:rounded-3xl sm:p-20">
    
                <div class="text-center pb-6">
                    <h1 class="text-3xl">Contact Us!</h1>
    
                    
                </div>
            <?php 
            include("config.php");
            
            if (isset($_POST['submit'])) {
                $Fullname = isset($_POST['Fullname']) ? $_POST['Fullname'] : '';
                $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
                $Contact = isset($_POST['Contact']) ? $_POST['Contact'] : '';
                $Messages = isset($_POST['Messages']) ? $_POST['Messages'] : '';
                $Dates = isset($_POST['Dates']) ? $_POST['Dates'] : '';

                mysqli_query($con, "INSERT INTO orders (Fullname, Email, Contact, Messages, Dates) 
                                    VALUES ('$Fullname', '$Email', '$Contact', '$Messages', '$Dates')")
                or die("Error Occurred");

                mysqli_query($con, "INSERT INTO history (Fullname, Email, Subjects, Messages, Dates) 
                                    VALUES ('$Fullname', '$Email', '$Contact', '$Messages', '$Dates')")
                or die("Error Occurred");

                echo "<div class='message'>
                        <p><h2 style='color: black;'>Your message has been sent to the admin!</h2></p>
                        <br><hr>
                        <br>";
                echo "<a href='home.php'><button class='btn'>Home</button></a></div>";
            }
            else {
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM accounts WHERE Id=$id");

                while($result = mysqli_fetch_assoc($query)){
                    $Fullname = $result['Fullname'];
                    $Email = $result['Email'];
                    $Contact = $result['Contact'];  
                }
            ?>
           <form action="" method="post" id="contact-form">
    
                    <input
                            class="shadow mb-4 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="<?php echo $Fullname; ?>" autocomplete="off" required
                            type="text" name="Fullname">

                    <input
                            class="shadow mb-4 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="<?php echo $Email; ?>" autocomplete="off" required
                            type="email" placeholder="Email" name="Email">

                    <input
                            class="shadow mb-4 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Subject" name="Contact">

                    <textarea
                            class="shadow mb-4 min-h-0 appearance-none border rounded h-64 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            type="text" placeholder="Type your message here..." name="Messages" style="height: 121px;"></textarea>

                    <div class="flex justify-between">
                        <input 
                            class="shadow bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="submit" name="submit" value="Send ➤" required>

                        <div>
                            <input
                            class="shadow bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                            type="reset">
                            <a href="home.php">
                                <input
                                    class="shadow bg-blue-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                    type="button" value="Go back">
                            </a>
                        </div>
                    </div>
                </form>
                <?php } ?>
            </div>
            
        </div>
    </div>

</body>

<style>
    .rounded-md:hover {
        cursor: pointer;
    }
</style>

<!-- Tailwind Links -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</html>
