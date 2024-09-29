<?php
session_name("admin_session");
session_start();

include("config.php");
if (!isset($_SESSION['valid'])) {
    header("Location: admin-login.php");
    exit();
}

$searchTerm = '';
if (isset($_POST['search'])) {
    $searchTerm = $_POST['searchTerm'];
}

$searchQuery = '';
if (!empty($searchTerm)) {
    $searchTerm = mysqli_real_escape_string($con, $searchTerm);
    $searchQuery = "WHERE Namess LIKE '%$searchTerm%' OR Contact LIKE '%$searchTerm%' OR Email LIKE '%$searchTerm%'";
}

$query = "SELECT * FROM registered $searchQuery";
$result = mysqli_query($con, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($con));
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
    <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>
    <title>Barangay Hub</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
</head>
<style>
    .delete:hover {
        background-color: red;
        color: white;
        font-weight: 500;
    }
    .reply:hover {
        background-color: green;
        color: white;
        font-weight: 500;
        cursor: pointer;
    }
    .update:hover {
        background-color: green; 
        color: white;
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

    <div style="display: flex; height: 100vh; justify-content: center; align-items: center; flex-direction: column;">
        <h1 class="text-center pb-5" style="font-size: 2rem; font-weight: 700;">Barangay Records</h1>
        <form method="post" action="" class="mb-1 flex">
            <input autocomplete="off" style="width: 300px; border-radius: 4px; margin-right: -60px;" type="text" name="searchTerm" placeholder="Search" value="<?php echo htmlspecialchars($searchTerm); ?>" class="">
            <button style="border-top-right-radius: 3px; border-bottom-right-radius: 3px;" class="bg-green-500 pt-2 pb-2 py-2 px-2 text-white" type="submit" name="search" class="">Search</button>
            <a href="add-person.php">
                <button style="border-radius: 3px; margin-left: 20px; border: solid 1px black;" class="bg-green-500 pt-2 pb-2 py-2 px-2 text-white" type="button" name="Add" class="">Add person</button>
            </a>
            <a href="">
                <button style="border-radius: 3px; margin-left: 20px; border: solid 1px black;" class="bg-green-500 pt-2 pb-2 py-2 px-2 text-white" type="button" name="Add" class="">Notify</button>
            </a>
        </form>
        <section class="relative overflow-x-auto shadow-md sm:rounded-lg max-w-6xl">
            <table border="3" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr style="background-color: white; padding: 10px 10px;">
                        <th style="padding: 10px">ID No.</th>
                        <th style="padding: 10px" colspan="3">Name</th>
                        <th style="padding: 10px" colspan="3">Middle Name</th>
                        <th style="padding: 10px" colspan="3">Last Name</th>
                        <th style="padding: 10px" colspan="3">Contact #</th>
                        <th style="padding: 10px" colspan="3">Email</th>
                       
                        <th style="padding: 10px" colspan="3">Update</th>
                        <th style="padding: 10px" colspan="3">Remove</th>
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td style="padding: 10px 10px;"><?php echo $row['id']; ?></td>
                        <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Namess']; ?></td>
                        <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Middlename']; ?></td>
                        <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Lastnamess']; ?></td>
                        <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Contact']; ?></td>
                        <td style="padding: 10px 10px;" colspan="3"><?php echo $row['Email']; ?></td>
                       
                        <td style="padding: 10px 10px;" colspan="3">
                            <a href="edit-person.php?id=<?php echo $row['id']; ?>" class="update text-center bg-green-500 px-2 py-1 rounded text-white">Update</a>
                        </td>

                        <td style="padding: 10px 10px;" colspan="3">
                            <a href="reg-delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');" class="delete text-center bg-red-500 px-2 py-1 rounded text-white">Delete</a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
        </section>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="https://cdn.tailgrids.com/tailgrids-fallback.js"></script>
</body>
</html>
