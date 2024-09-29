<?php
session_name("admin_session");
session_start();

include("config.php");
if (!isset($_SESSION['valid'])) {
  header("Location: admin-login.php");
  exit();
}

// rest of your admin home page code
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>

    <title>Business Permit Request</title>

    <!-- Css Link -->
    <link rel="stylesheet" href="./style.css">

    <!-- Links -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
</head>
<body>
    <!-- Request -->
    <form action="" method="post" class="px-4 md:px-8 max-w-3xl mx-auto py-12">
        <div class="space-y-12"></div>
        <div class="border-b border-gray-900/10 pb-12">
            <!-- PHP CODE -->
            <?php 
            include("config.php");
            
            if (isset($_POST['submit'])) {
                $Namess = isset($_POST['Namess']) ? $_POST['Namess'] : '';
                $Middlename = isset($_POST['Middlename']) ? $_POST['Middlename'] : '';
                $Lastnamess = isset($_POST['Lastnamess']) ? $_POST['Lastnamess'] : '';
                $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
                $Contact = isset($_POST['Contact']) ? $_POST['Contact'] : '';
                $Street = isset($_POST['Street']) ? $_POST['Street'] : '';
                $Postal = isset($_POST['Postal']) ? $_POST['Postal'] : '';
                $id = isset($_POST['id']) ? $_POST['id'] : '';

                mysqli_query($con, "INSERT INTO registered (Namess, Middlename, Lastnamess, Email, Contact, Street, Postal, id) 
                                    VALUES ('$Namess', '$Middlename', '$Lastnamess', '$Email', '$Contact', '$Street', '$Postal', '$id')")
                or die("Error Occurred");

                echo "<div class='message'>
                        <p><h2 style='color: black;'>This person is successfully added in the record</h2></p>
                        <br><hr><br>";
                echo "<a href='admin-home.php'><button type='button' class='btn'>Home</button></a></div>";
            } else {
                $id = $_SESSION['id'];
                $query = mysqli_query($con, "SELECT * FROM accounts WHERE Id=$id");

                while($result = mysqli_fetch_assoc($query)){
                    $Fullname = $result['Fullname'];
                    $Email = $result['Email'];
                    $Contact = $result['Contact'];  
                }
            ?>
            <!-- PHP CODE -->
          <div style="display: flex; height: 100vh; justify-content: center; align-items: center; flex-direction: column;">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="Namess" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                <div class="mt-2">
                  <input type="text" name="Namess" id="Namess" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>
      
              <div class="sm:col-span-3">
                <label for="middle-name" class="block text-sm font-medium leading-6 text-gray-900">Middle name (Optional)</label>
                <div class="mt-2">
                  <input type="text" name="Middlename" id="middle-name" autocomplete="additional-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                <div class="mt-2">
                  <input type="text" name="Lastnamess" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="contact" class="block text-sm font-medium leading-6 text-gray-900">Contact</label>
                <div class="mt-2">
                  <input type="number" name="Contact" id="contact" autocomplete="contact" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>
      
              <div class="sm:col-span-4">
                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                <div class="mt-2">
                  <input id="email" name="Email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>
      
              <div class="col-span-full">
                <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                <div class="mt-2">
                  <input type="text" name="Street" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>
      
              <div class="sm:col-span-2">
                <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                <div class="mt-2">
                  <input type="text" name="Postal" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>

              <input style="margin: 20px 20px 0 0"
                class="shadow bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit" name="submit" value="Send ➤" required>
              <a href="registered.php" style="margin: 20px 20px 0 0">
                <button type="button" class="hadow bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cancel</button>
              </a>
              
            </div>
          </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
            

          
        </div>
        <?php } ?>
    </form>
    </div>
</body>

<style>
    .rounded-md:hover {
        cursor: pointer;
    }
    .message {
        text-align: center;
        margin: 20px;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #f9f9f9;
    }
    .btn {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>
</html>
