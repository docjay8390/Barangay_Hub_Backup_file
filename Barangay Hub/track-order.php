<?php
session_name("user_session");
session_start();

include("config.php");

// Check if the user is logged in
if (!isset($_SESSION['valid'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

// Execute the query
$query = mysqli_query($con, "SELECT * FROM bpermit WHERE Id=$id");

// Check if the query was successful
if ($query) {
    $result = mysqli_fetch_assoc($query);

    // Check if the result is not null
    if ($result) {
        $Statuss = $result['Statuss'];
    } else {
        $Statuss = "Pending";
    }
} else {
    // Handle query error
    $Statuss = "Error executing query: " . mysqli_error($con);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>
    <title>Barangay Hub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
</head>
<body>
    <header>
        <nav class="bg-green-500 border-gray-200 dark:bg-gray-900 fixed w-full z-50">
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
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 bg-green-500 dark:border-gray-700">
                        <li>
                            <a href="home.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Go back</a>
                        </li>
                        <li>
                            <a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" href="logout.php">
                                Sign Out
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Track Order Section -->
    <div style="display: flex; height: 100vh; justify-content: center; align-items: center;">
        <section class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-6xl p-1 bg-white">
            <form method="post" action="" class="mb-1">
                <input autocomplete="off" style="width: 310px; border-radius: 4px; margin-right: -68px;
                " type="text" name="referral_code" placeholder="Enter your 11-digit referral code" class="form-input" required>
                <button style="border-top-right-radius: 3px; border-bottom-right-radius: 3px;" class="bg-green-500 pt-2 pb-2 py-2 px-2 text-white" type="submit" name="search" class="btn-search">Search</button>
            </form>

            <hr>
            <?php
            if (isset($_POST['search'])) {
                $referral_code = trim($_POST['referral_code']);
                
                if (strlen($referral_code) === 11) {
                    $referral_code = mysqli_real_escape_string($con, $referral_code);
                    
                    $stmt = $con->prepare("SELECT * FROM bpermit WHERE ReferralCode = ?");
                    $stmt->bind_param("s", $referral_code);
                    $stmt->execute();
                    $result = $stmt->get_result();
                } else {
                    $result = false;
                }
            } else {
                $result = false;
            }
            ?>
            
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
                        <th style="padding: 10px">Ref. Code</th>
                        <th style="padding: 10px">Status</th>
                    </tr>
                </thead>
                
                <?php if ($result && mysqli_num_rows($result) > 0) { ?>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td style="padding: 10px 10px;"><?php echo $row['id']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Firstname']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Middlename']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Lastname']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Bloodtype']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Email']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Street']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['City']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Province']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Postal']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['Purpose']; ?></td>
                        <td style="padding: 10px 10px;"><?php echo $row['ReferralCode']; ?></td>

                        <td class="text-center bg-blue-500 text-white">
                            <p class="text-white-700 text-center"><span id="status"><?php echo htmlspecialchars($Statuss); ?></span></p>
                        </td>
                    </tr>

                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="13" style="text-align: center; padding: 10px">View your transaction here</td>
                    </tr>
                <?php } ?>
                
            </table>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
</body>
</html>