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
  
  <!-- Css/Js Link -->
  <link rel="stylesheet" href="./script.js">
  <link rel="stylesheet" href="./style.css">

  <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>
  <title>Barangay Hub</title>

  <!-- tailwind Links-->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

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
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 dark:border-gray-700">
                        <li class="nav-item">     
                            <?php 
                                $id = $_SESSION['id'];
                                $query = mysqli_query($con,"SELECT*FROM adminpage WHERE Id=$id");

                                while($result = mysqli_fetch_assoc($query)){
                                    $Fullname = $result['Fullname'];
                                    $Username = $result['Username'];
                                    $Email = $result['Email'];
                                    $Password = $result['Password'];
                                    $id = $result['Id'];
                                } 
                                echo "<a style='color: white; font-size: 16px' href='edit-admin.php?Id=$id'>Change Profile</a>";
                            ?>                            
                        </li>
                        <li>
                            <a href="purchase-history.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">History</a>
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
    
	<!-- Dashboard -->
	<section>
        <div style="height: 100svh; align-items: center; gap:20px; flex-wrap: wrap;
        " class="flex justify-center pt-20">

            <div style="font-size: 24px; text-align: center; cursor: pointer;" class="bg-green-500 p-10 rounded-md text-white">
                <a href="messages.php">
                    <div>
                        <img class="h-40 ml-5 mr-5" src="./img/message.png" alt="">
                    </div>
                    <div>
                        <p>
                            Messages
                        </p>
                    </div>
                </a>
            </div>

            <div style="font-size: 24px; text-align: center; cursor: pointer;" class="bg-green-500 p-10 rounded-md text-white">
                <a href="doc-requests.php">
                    <div>
                        <img class="h-40 w-40 ml-5" src="./img/7208693_application_folder_files_documents_icon.png" alt="">
                    </div>
                    <div>
                        <p>
                            Document Request
                        </p>
                    </div>
                </a>
            </div>

            <div style="font-size: 24px; text-align: center; cursor: pointer;" class="bg-green-500 p-10 rounded-md text-white">
                <a href="registered.php">
                    <div>
                        <img class="h-40 ml-7" src="./img/211873_person_stalker_icon.png" alt="">
                    </div>
                    <div>
                        <p>
                            Registered Residents
                        </p>
                    </div>
                </a>
            </div>
        </div>
		
	</section>
</body>

<!-- Script Tailwind -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- JAVASCRIPT -->
    <script>
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
    
    
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    
            var themeToggleDarkIcon_2 = document.getElementById('theme-toggle-dark-icon-2');
            var themeToggleLightIcon_2 = document.getElementById('theme-toggle-light-icon-2');
    
            // Change the icons inside the button based on previous settings
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia(
                '(prefers-color-scheme: dark)').matches)) {
                themeToggleLightIcon.classList.remove('hidden');
                if (themeToggleDarkIcon_2) {
                    themeToggleLightIcon_2.classList.remove('hidden');
                }
            } else {
                themeToggleDarkIcon.classList.remove('hidden');
                if (themeToggleDarkIcon_2) {
                    themeToggleDarkIcon_2.classList.remove('hidden');
                }
            }
    
    
            var themeToggleBtn_2 = document.getElementById('theme-toggle-2');
            if (themeToggleBtn_2) {
    
                themeToggleBtn_2.addEventListener('click', function () {
    
                    // toggle icons inside button
                    themeToggleDarkIcon_2.classList.toggle('hidden');
                    themeToggleLightIcon_2.classList.toggle('hidden');
    
                    sync_theme()
    
                });
            }
    
    
            var themeToggleBtn = document.getElementById('theme-toggle');
    
            themeToggleBtn.addEventListener('click', function () {
    
                // toggle icons inside button
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');
    
                sync_theme()
    
    
            });
    
    
            function sync_theme() {
                // if set via local storage previously
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                    // if NOT set via local storage previously
                } else {
                    if (document.documentElement.classList.contains('dark')) {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    } else {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    }
                }
    
            }
    
    
    
            document.addEventListener('DOMContentLoaded', function () {
                // open
                const burger = document.querySelectorAll('.navbar-burger');
                const menu = document.querySelectorAll('.navbar-menu');
    
                if (burger.length && menu.length) {
                    for (var i = 0; i < burger.length; i++) {
                        burger[i].addEventListener('click', function () {
                            for (var j = 0; j < menu.length; j++) {
                                menu[j].classList.toggle('hidden');
                            }
                        });
                    }
                }
    
                // close
                const close = document.querySelectorAll('.navbar-close');
                const backdrop = document.querySelectorAll('.navbar-backdrop');
    
                if (close.length) {
                    for (var i = 0; i < close.length; i++) {
                        close[i].addEventListener('click', function () {
                            for (var j = 0; j < menu.length; j++) {
                                menu[j].classList.toggle('hidden');
                            }
                        });
                    }
                }
            
    
                if (backdrop.length) {
                    for (var i = 0; i < backdrop.length; i++) {
                        backdrop[i].addEventListener('click', function () {
                            for (var j = 0; j < menu.length; j++) {
                                menu[j].classList.toggle('hidden');
                            }
                        });
                    }
                }
            });

    </script>
</html>