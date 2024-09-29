<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Register</title>
</head>
<body style="background-color: black;">
      <div class="container">
        <div class="box form-box" style="background-color: skyblue !important;">

        <?php 
         
         include("config.php");
         if(isset($_POST['submit'])){
            $Fullname = $_POST['Fullname'];
            $Username = $_POST['Username'];
            $Email = $_POST['Email'];
            $Destination = $_POST['Destination'];
            $Contact = $_POST['Contact'];
            $password = $_POST['password'];

         //verifying the unique email

         $verify_query = mysqli_query($con,"SELECT Email FROM accounts WHERE Email='$Email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This Email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($con,"INSERT INTO accounts(Fullname,Username,Email,Destination,Contact,Password) 
            VALUES('$Fullname','$Username','$Email', '$Destination', '$Contact','$password')") or die("Error Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Login Now</button>";
         

         }

         }else{
         
        ?>

            <header style="background-color: skyblue;">Sign Up</header>
            <form action="" method="post" style="background-color: skyblue;">
                <div class="field input">
                    <label for="Fullname">Fullname</label>
                    <input type="text" name="Fullname" id="Username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Username">Username</label>
                    <input type="text" name="Username" id="username" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Email">Email</label>
                    <input type="text" name="Email" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Destination">Address</label>
                    <input type="text" name="Destination" id="email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Contact">Contact</label>
                    <input type="number" name="Contact" id="age" autocomplete="off" required>
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Register" required>
                </div>
                <div class="links">
                    Already a member? <a href="index.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>