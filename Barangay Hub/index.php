<?php 

   session_name("user_session");
   session_start();
   
   include("config.php");
   
   if (isset($_SESSION['valid'])) {
       // Redirect to user home page or any other page
       header("Location: home.php");
       exit();
   }
   
   // rest of your login code
   
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../img/logo-pandaguirig.jpg"/>

    <title>Login</title>

      <!-- tailwind Links-->
   <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdn.tailgrids.com/tailgrids-fallback.css" />
</head>
<style>
    .message {
        background-color: white !important;
        font-weight: 500;
    }

    .btn {
        background-color: skyblue;
        padding: 2px 10px;
        border-radius: 5px;
        font-weight: 500;
    }
</style>
<body>

    <div class="min-h-screen bg-gray-900 py-6 flex flex-col justify-center sm:py-12">
        <div class="relative py-3 sm:max-w-xl sm:mx-auto">
        
          <div
            class="absolute inset-0 bg-gradient-to-r from-cyan-400 to-sky-500 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl">
          </div>
          
          <div class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20">
          <?php       
            include("config.php");
            if(isset($_POST['submit'])){
            $Email = mysqli_real_escape_string($con,$_POST['Email']);
            $password = mysqli_real_escape_string($con,$_POST['password']);

            $result = mysqli_query($con,"SELECT * FROM accounts WHERE Email='$Email' AND Password='$password' ") or die("Select Error");
            $row = mysqli_fetch_assoc($result);

            if(is_array($row) && !empty($row)){
                $_SESSION['Fullname'] = $row['Fullname'];
                $_SESSION['valid'] = $row['Email'];
                $_SESSION['Username'] = $row['Username'];
                $_SESSION['Destination'] = $row['Destination'];
                $_SESSION['Contact'] = $row['Contact'];
                $_SESSION['id'] = $row['Id'];
            }else{
                echo "<div class='message'>
                    <p>Wrong Username or Password</p>
                    </div> <br>";
                echo "<a href='index.php'><button class='btn'>Go Back</button>";
        
            }
            if(isset($_SESSION['valid'])){
                header("Location: home.php");
            }
            }else{
        
        ?>
            <div class="max-w-md mx-auto">
                
              <div>
                <h1 class="text-2xl font-semibold">Login</h1>
              </div>
              <div class="divide-y divide-gray-200">
                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                <form action="" method="post">
                  <div class="relative mb-5">
                    <input type="text" name="Email" id="email" autocomplete="off" required class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                    <label for="Email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                  </div>
                  <div class="relative mb-5">
                    <input type="password" name="password" id="password" autocomplete="off" required class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                    <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                  </div>
                  <div class="relative">
                    <input class="bg-cyan-500 text-white rounded-md px-2 py-1" type="submit" name="submit" value="Sign in" required>
                  </div>
                </div>
              </div>
            </div>
      
            <div class="w-full flex justify-center">
              <button class="flex items-center bg-cyan-200 border border-gray-300 rounded-lg shadow-md px-6 py-2 text-sm font-medium text-gray-800 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                <span><a href="register.php"><span>Don't have account? </span>Sign Up Now</a></span>
              </button>
            </div>
            
          </div>
        </div>
        </form>
        <?php } ?>
        
    </div>



      <!-- <div class="container" style="background-color: #212529 !important; height: 100svh !important;">
        <div class="box form-box" style="background-color: #B7C5E1 !important; box-shadow: 0 0 10px white;
            border: solid 1px black;">
            
             
            //   include("config.php");
            //   if(isset($_POST['submit'])){
            //     $Email = mysqli_real_escape_string($con,$_POST['Email']);
            //     $password = mysqli_real_escape_string($con,$_POST['password']);

            //     $result = mysqli_query($con,"SELECT * FROM accounts WHERE Email='$Email' AND Password='$password' ") or die("Select Error");
            //     $row = mysqli_fetch_assoc($result);

            //     if(is_array($row) && !empty($row)){
            //         $_SESSION['Fullname'] = $row['Fullname'];
            //         $_SESSION['valid'] = $row['Email'];
            //         $_SESSION['Username'] = $row['Username'];
            //         $_SESSION['Destination'] = $row['Destination'];
            //         $_SESSION['Contact'] = $row['Contact'];
            //         $_SESSION['id'] = $row['Id'];
            //     }else{
            //         echo "<div class='message'>
            //           <p>Wrong Username or Password</p>
            //            </div> <br>";
            //         echo "<a href='index.php'><button class='btn'>Go Back</button>";
         
            //     }
            //     if(isset($_SESSION['valid'])){
            //         header("Location: home.php");
            //     }
            //   }else{

            
            // 
            <header style="font-size: 2.3rem; text-align: center;">Sign in</header>
            <form action="" method="post">
                <br>
                <div class="field input">
                    <label for="Email">Email</label>
                    <input type="text" name="Email" id="email" autocomplete="off" required>
                </div>
                <br>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>
                <br>
                <div class="field">
                    <input style="box-shadow: -3px 5px 10px white;" type="submit" class="btn" name="submit" value="Sign in" required>
                </div>
                <br>
                <div class="links" style="text-align: center;">
                    Don't have account? <a href="register.php">Sign Up Now</a>
                </div>
            </form>
        </div>
        
      </div> -->
</body>

<!-- Script Tailwind -->
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</html>