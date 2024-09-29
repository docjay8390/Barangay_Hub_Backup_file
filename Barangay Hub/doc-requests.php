<?php
session_name("admin_session");
session_start();

include("config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: admin-login.php");
    exit();
}

function generateReferralCode($length = 11) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST['mark_finish'])) {
    $id = $_POST['id'];
    $update_query = "UPDATE bpermit SET Statuss='Ready to Pickup' WHERE id='$id'";
    mysqli_query($con, $update_query);
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

  <script src="./script.js"></script>   
  
  <!-- Css/Js Link -->
  <link rel="stylesheet" href="./script.js">
  <link rel="stylesheet" href="./style.css">

  <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>
  <title>Barangay Hub</title>

  <!-- Tailwind Links-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />

</head>
<style>
  .delete:hover {
    background-color: green;
    color: white;
    font-weight: 500;
  }
  .reply:hover {
    background-color: green;
    color: white;
    font-weight: 500;
    cursor: pointer;
  }
</style>
<body>
    <header>
        <nav class="bg-white border-gray-200 dark:bg-gray-900 fixed w-full z-50">
            <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
              <a href="#" class="flex items-center">
                  <img src="./img/2000px-Flag_of_the_Philippines.svg_.png" class="h-8 rounded" alt="Logo"/>
              </a>
              <button data-collapse-toggle="navbar-default" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-default" aria-expanded="false">
                  <span class="sr-only">Open main menu</span>
                  <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                  </svg>
              </button>
              <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        <li class="nav-item">     
                            <?php 
                                $id = $_SESSION['id'];
                                $query = mysqli_query($con,"SELECT * FROM bpermit WHERE Id=$id");

                                while($result = mysqli_fetch_assoc($query)){
                                    $Firstname = $result['Firstname'];
                                    $Middlename = $result['Middlename'];
                                    $Lastname = $result['Lastname'];
                                    $Bloodtype = $result['Bloodtype'];
                                    $Email = $result['Email'];
                                    $Street = $result['Street'];
                                    $City = $result['City'];
                                    $Province = $result['Province'];
                                    $Postal = $result['Postal'];
                                    $City = $result['City'];
                                    $Purpose = $result['Purpose'];
                                    $id = $result['id'];
                                    
                                } 
                                echo "<a style='color: black; font-size: 16px' href='edit-admin.php?Id=$id'>Change Profile</a>";
                            ?>                            
                        </li>
                        <li>
                            <a href="purchase-history.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">History</a>
                        </li>
                        <li>
                            <a href="admin-home.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Go back</a>
                        </li>
                        <li class="nav-item">
                            <a class="w-auto text-center min-w-[100px] px-2 py-2 bg-blue-700 text-white transition-all bg-blue-700 text-white rounded-md sm:w-auto hover:bg-blue-400 hover:text-white shadow-neutral-300 dark:shadow-neutral-700 hover:shadow-2xl hover:shadow-neutral-400 hover:-tranneutral-y-px" href="logout-admin.php">
                                Sign Out
                            </a>
                        </li>
                    </ul>
              </div>
            </div>
        </nav>
    </header>

    <?php

        require("connect.php");

        $msg = "";

        if (isset($_POST['new']) && $_POST['new'] == 0) {
            $Firstname = $result['Firstname'];
            $Middlename = $result['Middlename'];
            $Lastname = $result['Lastname'];
            $Bloodtype = $result['Bloodtype'];
            $Email = $result['Email'];
            $Street = $result['Street'];
            $City = $result['City'];
            $Province = $result['Province'];
            $Postal = $result['Postal'];
            $Purpose = $result['Purpose'];
            $ReferralCode = $result['ReferralCode'];
            $ReferralCode = generateReferralCode();

            $insert_query = "INSERT INTO `bpermit` (`Firstname`, `Middlename`, `Lastname`, `Bloodtype`, `Email`, `Street`, `Province`, `Postal`, `City`, `Purpose`, `id`, `ReferralCode`, `Statuss`)
                            VALUES ('$Firstname', '$Middlename', '$Lastname', '$Bloodtype', '$Email', '$Street', '$Province', '$Postal', '$City', '$Purpose', '$id', '$ReferralCode', 'Pending')";

            if (mysqli_query($connection, $insert_query)) {
                $msg = "Record was successfully added to the database!";
            } else {
                $msg = "Error: " . mysqli_error($connection);
            }
        }

        $result = mysqli_query($connection, 'SELECT * FROM bpermit'); 
    ?>

    <div style="display: flex; height: 100vh; justify-content: center; align-items: center;">
        <section class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-6xl">
            <table border="3" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr style="background-color: white; padding: 10px 10px;">
                        <th style="padding: 10px">ID No.</th>
                        <th style="padding: 10px">First Name</th>
                        <th style="padding: 10px">Middlename</th>
                        <th style="padding: 10px">Last Name</th>
                        <th style="padding: 10px">Blood Type</th>
                        <th style="padding: 10px">Email</th>
                        <th style="padding: 10px">Street</th>
                        <th style="padding: 10px">City</th>
                        <th style="padding: 10px">Province</th>
                        <th style="padding: 10px">Postal</th>
                        <th style="padding: 10px">Purpose</th>
                        <th style="padding: 10px">Referral Code</th>
                        <th style="padding: 10px">Status</th>
                        <th style="padding: 10px">Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <tr style="background-color: white;">
                        <td style="text-align: center; padding: 5px;"><?php echo $row['id']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Firstname']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Middlename']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Lastname']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Bloodtype']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Email']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Street']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['City']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Province']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Postal']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['Purpose']; ?></td>
                        <td style="text-align: center; padding: 5px;"><?php echo $row['ReferralCode']; ?></td>
                        <td style="text-align: center; padding: 5px;" id="status-<?php echo $row['id']; ?>"><?php echo $row['Statuss']; ?></td>
                        <td style="text-align: center; padding: 5px;">
                            <form method="post" action="">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <input type="submit" name="mark_finish" value="Mark as Finish" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </section>
    </div>
</body>
</html>
