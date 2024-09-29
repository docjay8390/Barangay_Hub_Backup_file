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

    <!-- Css/Js Link -->
    <link rel="stylesheet" href="./script.js">
    <link rel="stylesheet" href="./style.css">

    <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>
    <title>Barangay Hub</title>

    <!-- tailwind Links-->
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
                    <ul class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 bg-gray-900 dark:border-gray-700">
                        <li>
                            <a href="#home" class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500" aria-current="page">Home</a>
                        </li>
                        <li>
                            <a href="#services" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
                        </li>
                        <li>
                            <a href="#team" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Team</a>
                        </li>
                        <li>
                            <a href="#map" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Map</a>
                        </li>
                        <li>
                            <a href="track-order.php" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Track my order</a>
                        </li>
                        <li>     
                            <?php 
                                $id = $_SESSION['id'];
                                $query = mysqli_query($con,"SELECT*FROM accounts WHERE Id=$id");

                                while($result = mysqli_fetch_assoc($query)){
                                    $Fullname = $result['Fullname'];
                                    $Username = $result['Username'];
                                    $Email = $result['Email'];
                                    $Destination = $result['Destination'];
                                    $Contact = $result['Contact'];
                                    $id = $result['Id'];
                                } 
                                echo "<a style='color: white; font-size: 16px' href='edit.php?Id=$id'>Change Profile</a>"; 
                            ?> 
                                                       
                        </li>
                        <li>
                            <a class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent" href="logout.php">
                                Sign Out
                            </a>
                        </li>
                        <li>
                            <img style="width: 30px; cursor: pointer;" id="drk" src="./img/moon.png" alt="">
                        </li>
                    </ul>
              </div>
            </div>
        </nav>
    </header>

    <!-- Home Section -->
    <section id="home" class="flex justify-center body-font min-h-screen">
        <div id="home" class="container mx-auto flex px-5 py-24 md:flex-row flex-col items-center bg-white">
            <div class="lg:flex-grow md:w-1/2 lg:pr-24 md:pr-16 flex flex-col md:items-start md:text-left mb-16 md:mb-0 items-center text-center">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-orange-500">Welcome to
                    <br class="hidden lg:inline-block text-5xl">Pabanlag, Florida Blanca, Pampanga
                </h1>
                <p class="mb-8 leading-relaxed">Barangay Pabanlag in Floridablanca, Pampanga, is a vibrant and close-knit community, celebrated for its rich cultural heritage, warm hospitality, and active participation in local traditions and events.</p>
                <div class="flex justify-center">
                    <a href="./contact.php">
                        <button class="inline-flex text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-gray-800 rounded text-lg">Contact Us</button>
                    </a>  
                </div>
            </div>
            <div class="">
                <img style="height: 200px;" class="object-fit object-center rounded" alt="hero" src="./img/logo-pandaguirig.jpg">
            </div>
        </div>
    </section>

    <!-- News Section-->
    <div id="News" class="z-0 max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16 relative">
      <h2 id="news" class="text-3xl font-bold mb-5 text-center">News</h2><br>
      <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
        
          <div class="sm:col-span-5">
              <a href="#">
                  <div class="bg-cover text-center overflow-hidden"
                      style="min-height: 300px; background-image: url('https://api.time.com/wp-content/uploads/2020/07/never-trumpers-2020-election-01.jpg?quality=85&amp;w=1201&amp;h=676&amp;crop=1')"
                      title="Woman holding a mug">
                  </div>
              </a>
              <div
                  class="mt-3 bg-white rounded-b lg:rounded-b-none lg:rounded-r flex flex-col justify-between leading-normal">
                  <div class="" id="home">
                      <a href="#" id="nws"
                          class="text-xs uppercase font-medium hover:text-gray-900 transition duration-500 ease-in-out">
                          Election
                      </a>
                      <a href="#" id="nws"
                          class="block font-bold text-2xl mb-2 hover:text-indigo-600 transition duration-500 ease-in-out">Revenge
                          of the Never Trumpers</a>
                      <p  id="nws" class="text-base mt-2">Meet the Republican dissidents fighting to push Donald Trump
                          out of office—and reclaim their party</p>
                  </div>
              </div>
          </div>
  
          <div class="sm:col-span-7 grid grid-cols-2 lg:grid-cols-3 gap-5">
              <div class="">
                  <a href="#">
                      <div class="h-40 bg-cover text-center overflow-hidden"
                          style="background-image: url('https://api.time.com/wp-content/uploads/2020/07/president-trump-coronavirus-election.jpg?quality=85&amp;w=364&amp;h=204&amp;crop=1')"
                          title="Woman holding a mug">
                      </div>
                  </a>
                  <a href="#" id="nws"
                      class="inline-block font-semibold text-md my-2 hover:text-indigo-600 transition duration-500 ease-in-out">Trump
                      Steps Back Into Coronavirus Spotlight</a>
              </div>
              <div class="">
                  <a href="#">
                      <div class="h-40 bg-cover text-center overflow-hidden"
                          style="background-image: url('https://api.time.com/wp-content/uploads/2020/06/GettyImages-1222922545.jpg?quality=85&amp;w=364&amp;h=204&amp;crop=1')"
                          title="Woman holding a mug">
                      </div>
                  </a>
                  <a href="#"
                      class="text-gray-900 inline-block font-semibold text-md my-2 hover:text-indigo-600 transition duration-500 ease-in-out">How
                      Trump's Mistakes Became Biden's Big Breaks</a>
              </div>
              <div class="">
                  <a href="#">
                      <div class="h-40 bg-cover text-center overflow-hidden"
                          style="background-image: url('https://api.time.com/wp-content/uploads/2020/07/American-Flag.jpg?quality=85&amp;w=364&amp;h=204&amp;crop=1')"
                          title="Woman holding a mug">
                      </div>
                  </a>
                  <a href="#"
                      class="text-gray-900 inline-block font-semibold text-md my-2 hover:text-indigo-600 transition duration-500 ease-in-out">Survey:
                      Many Americans 'Dissatisfied' With U.S.</a>
              </div>
              <div class="">
                  <a href="#">
                      <div class="h-40 bg-cover text-center overflow-hidden"
                          style="background-image: url('https://api.time.com/wp-content/uploads/2020/06/GettyImages-1222922545.jpg?quality=85&amp;w=364&amp;h=204&amp;crop=1')"
                          title="Woman holding a mug">
                      </div>
                  </a>
                  <a href="#"
                      class="text-gray-900 inline-block font-semibold text-md my-2 hover:text-indigo-600 transition duration-500 ease-in-out">How
                      Trump's Mistakes Became Biden's Big Breaks</a>
              </div>
              <div class="">
                  <a href="#">
                      <div class="h-40 bg-cover text-center overflow-hidden"
                          style="background-image: url('https://api.time.com/wp-content/uploads/2020/07/American-Flag.jpg?quality=85&amp;w=364&amp;h=204&amp;crop=1')"
                          title="Woman holding a mug">
                      </div>
                  </a>
                  <a href="#"
                      class="text-gray-900 inline-block font-semibold text-md my-2 hover:text-indigo-600 transition duration-500 ease-in-out">Survey:
                      Many Americans 'Dissatisfied' With U.S.</a>
              </div>
              <div class="">
                  <a href="#">
                      <div class="h-40 bg-cover text-center overflow-hidden"
                          style="background-image: url('https://api.time.com/wp-content/uploads/2020/07/president-trump-coronavirus-election.jpg?quality=85&amp;w=364&amp;h=204&amp;crop=1')"
                          title="Woman holding a mug">
                      </div>
                  </a>
                  <a href="#"
                      class="text-gray-900 inline-block font-semibold text-md my-2 hover:text-indigo-600 transition duration-500 ease-in-out">Trump
                      Steps Back Into Coronavirus Spotlight</a>
              </div>
          </div>
  
      </div>
    </div>

    <!-- Search Section-->
    <div style="background-color: #172E4D !important;">
        <div class="dark:bg-transparent">
            <div class="mx-auto flex flex-col items-center py-12 sm:py-24">
                <div class="w-11/12 sm:w-2/3 lg:flex justify-center items-center flex-col mb-5 sm:mb-10">
                    <h1
                        class="text-4xl sm:text-5xl md:text-5xl lg:text-5xl xl:text-6xl text-center text-white dark:text-white font-black leading-10">
                        Search a Business
                        <span class="text-green-500 dark:text-green-500">you want to find</span>
                    </h1>
                    <p class="mt-5 sm:mt-10 lg:w-10/12 text-gray-600 dark:text-gray-200 font-normal text-center text-xl">
                        Barangay Hub-Help Online
                    </p>
                </div>
                <div class="flex w-11/12 md:w-8/12 xl:w-6/12">
                    <div class="flex rounded-md w-full">
                        <input type="text" name="q"
                            class="w-full p-3 rounded-md rounded-r-none border border-2 border-gray-300 placeholder-current dark:bg-gray-500  dark:text-gray-300 dark:border-none "
                            placeholder="Search..." />
                        <button
                            class="inline-flex items-center gap-2 bg-violet-700 text-white text-lg font-semibold py-3 px-6 rounded-r-md">
                            <span>Find</span>
                            <svg class="text-gray-200 h-5 w-5 p-0 fill-current" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" x="0px" y="0px"
                                viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;"
                                xml:space="preserve">
                                <path
                                    d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
                            </svg>
                    </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Services Section -->
    <section id="services" itemid="services" class="py-10">
        <div class="container mx-auto px-4" style=" display: flex !important; flex-direction: column !important;">
            <h2 id="nws" class="text-3xl font-bold mb-5 text-center">Our Services</h2>
            <p class=" mb-8 text-center">Get your important documents</p>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="./img/business-permit.jpg" alt="wheat flour grinding"
                        class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-medium text-gray-800 mb-2">Business Permit</h3>
                        <p class="text-gray-700 text-base">To get a business permit, complete the online application form on our website. Upload the necessary documents, and you'll receive your permit via email.</p>
                        <br>
                        <a class="buys" href="./orders.php">
                            <button class="bg-blue-700 text-white p-2 rounded">
                                Proceed
                            </button>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="./img/indigency.webp" alt="Coffee"
                        class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-medium text-gray-800 mb-2">Certificate of Indigency</h3>
                        <p class="text-gray-700 text-base">For a certificate of indigency, fill out the online form on our barangay website. Upload a valid ID and proof of residence. The certificate will be emailed to you upon approval.</p>
                        <br>
                        <a class="buys" href="./orders2.php">
                            <button class="bg-blue-700 text-white p-2 rounded">
                                Proceed
                            </button>
                        </a>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="./img/barangay-clearance-1-f499.jpg" alt="Coffee"
                        class="w-full h-64 object-cover">
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-medium text-gray-800 mb-2">Barangay Clearance</h3>
                        <p class="text-gray-700 text-base">To obtain a barangay clearance, visit our website and complete the application form. Submit the required documents, and your clearance will be sent to your email after verification.
                        </p>
                        <br>
                        <a class="buys" href="./orders3.php">
                            <button class="bg-blue-700 text-white p-2 rounded">
                                Proceed
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section-->
    <section id="team" class="text-white body-font border-t ml-10 mr-10 rounded-lg" style="background-color: #172E4D !important; border: solid #172E4D !important">
        <div class="container px-5 py-24 mx-auto" style="background-color: #172E4D !important; display: flex !important; flex-direction: column !important;">
            <div class="flex flex-col text-center w-full mb-20">
                <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-white">Our Team</h1>
                <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Meet our team at Barangay Pabanlag, including our hardworking Barangay Captain, Vice Captain, and dedicated SK members. Together, they strive to serve and improve our community.</p>
            </div>
            <div class="flex flex-wrap justify-center -m-2">
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="./img/captain.jpg">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Barangay Captain</h2>
                        <p class="text-gray-500">Captain</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -m-2">
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/80x80/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Vice Captain</h2>
                        <p class="text-gray-500">V-Captain</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/84x84/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Secretary</h2>
                        <p class="text-gray-500">Sec.</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/88x88/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Treasurer</h2>
                        <p class="text-gray-500">Lorem</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/90x90/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">PRO</h2>
                        <p class="text-gray-500">DevOps</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/94x94/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Martin Eden</h2>
                        <p class="text-gray-500">Software Engineer</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/98x98/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Boris Kitua</h2>
                        <p class="text-gray-500">UX Researcher</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/100x90/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Atticus Finch</h2>
                        <p class="text-gray-500">QA Engineer</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/104x94/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Alper Kamu</h2>
                        <p class="text-gray-500">System</p>
                    </div>
                    </div>
                </div>
                <div class="p-2 lg:w-1/3 md:w-1/2 w-full">
                    <div class="h-full flex items-center border-gray-200 border p-4 rounded-lg">
                        <img alt="team" class="w-16 h-16 bg-gray-100 object-cover object-center flex-shrink-0 rounded-full mr-4" src="https://dummyimage.com/108x98/edf2f7/a5afbd">
                    <div class="flex-grow">
                        <h2 class="text-white title-font font-medium">Rodrigo Monchi</h2>
                        <p class="text-gray-500">Product Manager</p>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section-->
    <section id="map" class="p-10">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3854.487086258938!2d120.48968077601803!3d14.965642685565092!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x339661d4d03a2dc1%3A0x6d23279eeedb2b20!2sPandaguirig!5e0!3m2!1sen!2sph!4v1719743075910!5m2!1sen!2sph" width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy" class="rounded-lg" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </section>

    <!-- Footer Section-->
    <div class="px-4 pt-16 mx-auto sm:max-w-3xl md:max-w-full lg:max-w-screen-2xl md:px-24 lg:px-8">
        <div class="grid gap-10 row-gap-6 mb-8 sm:grid-cols-2 lg:grid-cols-4">
          <div class="sm:col-span-2">
            <a href="/" aria-label="Go home" title="Company" class="inline-flex items-center">
              <img src="./img/2000px-Flag_of_the_Philippines.svg_.png" class="w-15 h-10 rounded" alt="">
              <span class="ml-2 text-xl font-bold tracking-wide uppercase">Pabanlag</span>
            </a>
            <div class="mt-6 lg:max-w-sm">
              <p class="text-sm">
                Meet the team at Barangay Pabanlag, comprising our diligent Barangay Captain, Vice Captain, and SK members. They are dedicated to serving and enhancing our vibrant community.
              </p>
              <p class="mt-4 text-sm">
                Visit our Barangay Hall!
              </p>
            </div>
          </div>
          <div class="space-y-2 text-sm">
            <p class="text-base font-bold tracking-wide">Contacts</p>
            <div class="flex">
              <p class="mr-1 ">Phone:</p>
              <a href="tel:850-123-5021" aria-label="Our phone" title="Our phone" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">850-123-5021</a>
            </div>
            <div class="flex">
              <p class="mr-1 ">Email:</p>
              <a href="mailto:info@lorem.mail" aria-label="Our email" title="Our email" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">pabanlag@gmail.com</a>
            </div>
            <div class="flex">
              <p class="mr-1 ">Address:</p>
              <a href="https://www.google.com/maps" target="_blank" rel="noopener noreferrer" aria-label="Our address" title="Our address" class="transition-colors duration-300 text-deep-purple-accent-400 hover:text-deep-purple-800">
                Pabanlag, Florida Blanca, Pampanga
              </a>
            </div>
          </div>
          <div>
            <span class="text-base font-bold tracking-wide">Social</span>
            <div class="flex items-center mt-1 space-x-3">
              <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                  <path
                    d="M24,4.6c-0.9,0.4-1.8,0.7-2.8,0.8c1-0.6,1.8-1.6,2.2-2.7c-1,0.6-2,1-3.1,1.2c-0.9-1-2.2-1.6-3.6-1.6 c-2.7,0-4.9,2.2-4.9,4.9c0,0.4,0,0.8,0.1,1.1C7.7,8.1,4.1,6.1,1.7,3.1C1.2,3.9,1,4.7,1,5.6c0,1.7,0.9,3.2,2.2,4.1 C2.4,9.7,1.6,9.5,1,9.1c0,0,0,0,0,0.1c0,2.4,1.7,4.4,3.9,4.8c-0.4,0.1-0.8,0.2-1.3,0.2c-0.3,0-0.6,0-0.9-0.1c0.6,2,2.4,3.4,4.6,3.4 c-1.7,1.3-3.8,2.1-6.1,2.1c-0.4,0-0.8,0-1.2-0.1c2.2,1.4,4.8,2.2,7.5,2.2c9.1,0,14-7.5,14-14c0-0.2,0-0.4,0-0.6 C22.5,6.4,23.3,5.5,24,4.6z"
                  ></path>
                </svg>
              </a>
              <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                <svg viewBox="0 0 30 30" fill="currentColor" class="h-6">
                  <circle cx="15" cy="15" r="4"></circle>
                  <path
                    d="M19.999,3h-10C6.14,3,3,6.141,3,10.001v10C3,23.86,6.141,27,10.001,27h10C23.86,27,27,23.859,27,19.999v-10   C27,6.14,23.859,3,19.999,3z M15,21c-3.309,0-6-2.691-6-6s2.691-6,6-6s6,2.691,6,6S18.309,21,15,21z M22,9c-0.552,0-1-0.448-1-1   c0-0.552,0.448-1,1-1s1,0.448,1,1C23,8.552,22.552,9,22,9z"
                  ></path>
                </svg>
              </a>
              <a href="/" class="text-gray-500 transition-colors duration-300 hover:text-deep-purple-accent-400">
                <svg viewBox="0 0 24 24" fill="currentColor" class="h-5">
                  <path
                    d="M22,0H2C0.895,0,0,0.895,0,2v20c0,1.105,0.895,2,2,2h11v-9h-3v-4h3V8.413c0-3.1,1.893-4.788,4.659-4.788 c1.325,0,2.463,0.099,2.795,0.143v3.24l-1.918,0.001c-1.504,0-1.795,0.715-1.795,1.763V11h4.44l-1,4h-3.44v9H22c1.105,0,2-0.895,2-2 V2C24,0.895,23.105,0,22,0z"
                  ></path>
                </svg>
              </a>
            </div>
            <p class="mt-4 text-sm">
              Try to reach us through our social media accounts
            </p>
          </div>
        </div>
        <div class="flex flex-col-reverse justify-between pt-5 pb-10 border-t lg:flex-row">
          <p class="text-sm ">
            © Copyright 2020 Pabanlag Inc. All rights reserved.
          </p>
          <ul class="flex flex-col mb-3 space-y-2 lg:mb-0 sm:space-y-0 sm:space-x-5 sm:flex-row">
            <li>
              <a href="/" class="text-sm  transition-colors duration-300 hover:text-deep-purple-accent-400">F.A.Q</a>
            </li>
            <li>
              <a href="/" class="text-sm  transition-colors duration-300 hover:text-deep-purple-accent-400">Privacy Policy</a>
            </li>
            <li>
              <a href="/" class="text-sm  transition-colors duration-300 hover:text-deep-purple-accent-400">Terms &amp; Conditions</a>
            </li>
          </ul>
        </div>
    </div>
</body>

    <!-- CSS STYLE -->
        <style>
            :root {
        --primary-color: black;
        --secondary-color: white;
            }

            .dark-theme {
                --primary-color: white;
                --secondary-color: #333;
            }

            body {
                background-color: var(--secondary-color);
                color: var(--primary-color);
            }

            #home {
                background-color: var(--secondary-color);
                color: var(--primary-color);
            }

            #News{
                background-color: var(--secondary-color);
                color: var(--primary-color);
            }

            #news {
                background-color: var(--secondary-color);
                color: var(--primary-color);
            }
        </style>
    <!-- Script Tailwind -->
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- JAVASCRIPT -->
    <script>

        // Dark Mode

        var drk = document.getElementById("drk");
        var icon = document.getElementById("drk"); // Assuming the icon is the same element as the dark mode toggle

        drk.onclick = function() {
            document.body.classList.toggle("dark-theme");
            if(document.body.classList.contains("dark-theme")) {
                icon.src = "./img/sun.png";
                localStorage.setItem('theme', 'dark');
            } else {
                icon.src = "./img/moon.png";
                localStorage.setItem('theme', 'light');
            }
        }

        // Apply the theme preference from localStorage on page load
        document.addEventListener('DOMContentLoaded', function () {
            const theme = localStorage.getItem('theme');
            if (theme === 'dark') {
                document.body.classList.add("dark-theme");
                icon.src = "./img/sun.png";
            } else {
                document.body.classList.remove("dark-theme");
                icon.src = "./img/moon.png";
            }
        });


        

        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
            var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    
            var themeToggleDarkIcon_2 = document.getElementById('theme-toggle-dark-icon-2');
            var themeToggleLightIcon_2 = document.getElementById('theme-toggle-light-icon-2');
            
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
                    themeToggleDarkIcon_2.classList.toggle('hidden');
                    themeToggleLightIcon_2.classList.toggle('hidden');
    
                    sync_theme()
    
                });
            }
            var themeToggleBtn = document.getElementById('theme-toggle');
    
            themeToggleBtn.addEventListener('click', function () {
                themeToggleDarkIcon.classList.toggle('hidden');
                themeToggleLightIcon.classList.toggle('hidden');
    
                sync_theme()
            });
            function sync_theme() {
                if (localStorage.getItem('color-theme')) {
                    if (localStorage.getItem('color-theme') === 'light') {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                  
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
