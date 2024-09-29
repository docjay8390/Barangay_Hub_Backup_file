<?php 
session_name("user_session");
session_start();

include("config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: index.php");
    exit();
}

function generateReferralCode($length = 11) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
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

    <!-- tailwind Links-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
</head>
<body>
    <!-- Request -->

    <form action="" method="post" class="px-4 md:px-8 max-w-3xl mx-auto py-12 ">
        <div class="space-y-12"></div>
        <div class="border-b border-gray-900/10 pb-12">
            <!-- PHP CODE -->
            <?php 
            include("config.php");
            
            if (isset($_POST['submit'])) {
                $Firstname = isset($_POST['Firstname']) ? $_POST['Firstname'] : '';
                $Middlename = isset($_POST['Middlename']) ? $_POST['Middlename'] : '';
                $Lastname = isset($_POST['Lastname']) ? $_POST['Lastname'] : '';
                $Bloodtype = isset($_POST['Bloodtype']) ? $_POST['Bloodtype'] : '';
                $Email = isset($_POST['Email']) ? $_POST['Email'] : '';
                $Street = isset($_POST['Street']) ? $_POST['Street'] : '';
                $City = isset($_POST['City']) ? $_POST['City'] : '';
                $Province = isset($_POST['Province']) ? $_POST['Province'] : '';
                $Postal = isset($_POST['Postal']) ? $_POST['Postal'] : '';
                $Purpose = isset($_POST['Purpose']) ? $_POST['Purpose'] : '';
                $id = isset($_POST['id']) ? $_POST['id'] : '';
                $Statuss = isset($_POST['Statuss']) ? $_POST['Statuss'] : '';

                $ReferralCode = generateReferralCode();

                mysqli_query($con, "INSERT INTO bpermit (Firstname, Middlename, Lastname, Bloodtype, Email, Street, City, Province, Postal, Purpose, id, Statuss, ReferralCode) 
                                    VALUES ('$Firstname', '$Middlename', '$Lastname', '$Bloodtype', '$Email', '$Street', '$City', '$Province', '$Postal', '$Purpose', '$id', '$Statuss', '$ReferralCode')")
                or die("Error Occurred");

                echo "<div class='message'>
                        <p><h2 style='color: black;'>Your request has been sent to the admin!</h2></p>
                        <p style='color: black;'>Here's your referral code. Please Copy or Screenshot it: <strong>$ReferralCode</strong></p>
                        <br><hr>
                        <br>";
                echo "<a href='home.php'><button type='button' class='btn'>Home</button></a></div>";
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
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
              <div class="sm:col-span-3">
                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                <div class="mt-2">
                  <input type="text" name="Firstname" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
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
                  <input type="text" name="Lastname" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>

              <div class="sm:col-span-3">
                <label for="blood-type" class="block text-sm font-medium leading-6 text-gray-900">Blood type</label>
                <div class="mt-2">
                    <select name="Bloodtype" id="blood-type" class="block w-full pl-3 rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="0+">0+</option>
                        <option value="0-">0-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                    </select>
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
      
              <div class="sm:col-span-2 sm:col-start-1">
                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                <div class="mt-2">
                  <input type="text" name="City" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>
      
              <div class="sm:col-span-2">
                <label for="province" class="block text-sm font-medium leading-6 text-gray-900">State / Province</label>
                <div class="mt-2">
                  <input type="text" name="Province" id="province" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>
      
              <div class="sm:col-span-2">
                <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                <div class="mt-2">
                  <input type="text" name="Postal" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" required>
                </div>
              </div>
            </div>
          </div>
          <div class="col-span-full mt-5 mb-5">
            <label for="purpose" class="block text-sm font-medium leading-6 text-gray-900">Purpose</label>
            <div class="mt-2">
              <textarea id="purpose" name="Purpose" rows="3" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
            </div>
            <p class="mt-3 text-sm leading-6 text-gray-600">Write your purpose of getting Business Permit</p>
          </div>
          <div class="col-span-full">
            <label for="file-upload" class="block text-sm font-medium leading-6 text-gray-900">Upload your copy of PSA</label>
            <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
              <div class="text-center">
                <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                  <path fill-rule="evenodd"
                    d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z"
                    clip-rule="evenodd" />
                </svg>
                <div class="mt-4 flex text-sm leading-6 text-gray-600">
                  <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                    <span>Upload a file</span>
                    <input id="file-upload" name="file-upload" type="file" class="sr-only">
                  </label>
                  <p class="pl-1">or drag and drop</p>
                </div>
                <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
              </div>
            </div>
          </div>
          
        </div>
      
        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="home.php">
          <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button></a>

          <input 
                class="shadow bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                type="submit" name="submit" value="Send ➤" required>
        </div>
        <?php } ?>
    </form>
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
    .message h2 {
        margin-bottom: 10px;
    }
    .message p {
        margin-bottom: 10px;
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
        border-radius: 16px;
    }
    .btn:hover {
        background-color: #45a049;
    }
</style>

<!-- Tailwind Links -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
<script src="../path/to/flowbite/dist/flowbite.min.js"></script>
<script src="https://cdn.tailwindcss.com"></script>
</html>
