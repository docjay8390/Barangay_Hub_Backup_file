<?php 
  session_name("user_session");
  session_start();
  
  include("config.php");
  if (!isset($_SESSION['valid'])) {
      header("Location: admin-home.php");
      exit();
  }

  // Initialize variables
  $Namess = $Middlename = $Lastnamess = $Contact = $Email = $Street = "";

  if(isset($_GET['id'])) {
      $id = $_GET['id'];
      $_SESSION['id'] = $id; // Store the id in the session for later use
  } else {
      $id = $_SESSION['id']; // Retrieve the id from the session if not in the URL
  }

  if(isset($_POST['submit'])){
      $Namess = $_POST['Namess'];
      $Middlename = $_POST['Middlename'];
      $Lastnamess = $_POST['Lastnamess'];
      $Contact = $_POST['Contact'];
      $Email = $_POST['Email'];
      $Street = $_POST['Street'];

      $edit_query = mysqli_query($con,"UPDATE registered SET Namess='$Namess', Middlename='$Middlename', 
      Lastnamess='$Lastnamess', Contact='$Contact', Email='$Email', Street='$Street' WHERE Id=$id ") or die("error occurred");

      if($edit_query){
          echo "<div class='message'>
          <p>Profile Updated!</p>
          </div> <br>";

          echo "<a href='registered.php'><button class='btn' style='margin-left: 10.5rem;'>Go back</button>";
      }
  } else {
      $query = mysqli_query($con,"SELECT * FROM registered WHERE Id=$id ");

      if($result = mysqli_fetch_assoc($query)){
          $Namess = $result['Namess'];
          $Middlename = $result['Middlename'];
          $Lastnamess = $result['Lastnamess']; // Ensure this matches the column name in your database
          $Contact = $result['Contact'];
          $Email = $result['Email'];
          $Street = $result['Street'];
      }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>Change Profile</title>
</head>
<body>
    <div class="nav" style="background-color: #212529; padding: 1rem 2rem;">
        <div class="right-links">
            <a href="#" style="color: white;">Change Profile</a>
            <a href="logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container" style="background-color: #212529;">
        <div class="box form-box" style="background-color: #B7C5E1 !important; box-shadow: 0 0 10px white;
            border: solid 1px black;">
            <header>Change Profile</header>
            <form action="" method="post">
                <div class="field input">
                    <label for="Fullname">Fullname</label>
                    <input type="text" name="Namess" id="username" value="<?php echo htmlspecialchars($Namess); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Username">Middlename</label>
                    <input type="text" name="Middlename" id="username" value="<?php echo htmlspecialchars($Middlename); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Email">Lastname</label>
                    <input type="text" name="Lastnamess" id="email" value="<?php echo htmlspecialchars($Lastnamess); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Destination">Contact</label>
                    <input type="text" name="Contact" id="age" value="<?php echo htmlspecialchars($Contact); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Contact">Email</label>
                    <input type="email" name="Email" id="age" value="<?php echo htmlspecialchars($Email); ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Contact">Street</label>
                    <input type="text" name="Street" id="age" value="<?php echo htmlspecialchars($Street); ?>" autocomplete="off" required>
                </div>
                
                <div class="field" style="text-align: center;">
                    <input type="submit" class="btn" name="submit" value="Update" required>
                    <br>
                    <a href="registered.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
