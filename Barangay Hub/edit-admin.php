<?php 
   session_start();

   include("config.php");
   if(!isset($_SESSION['valid'])){
    header("Location: admin-login.php");
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
        <div class="logo">
            <p><a href="home.php" style="color: red; font-style: italic; font-weight: 700;
            font-size: 3rem; text-shadow: 0 0 3px white;"><span style="color: blue;">LPG</span> Gasul</a> </p>
        </div>

        <div class="right-links">
            <a href="#" style="color: white;">Change Profile</a>
            <a href="logout.php"> <button class="btn">Log Out</button> </a>
        </div>
    </div>
    <div class="container" style="background-color: #212529;">
        <div class="box form-box" style="background-color: #B7C5E1 !important; box-shadow: 0 0 10px white;
            border: solid 1px black;">
            <?php 
               if(isset($_POST['submit'])){
                $Fullname = $_POST['Fullname'];
                $Username = $_POST['Username'];
                $Email = $_POST['Email'];
                $Password = $_POST['Password'];

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE adminpage SET Fullname='$Fullname', Username='$Username', 
                Email='$Email', Password='$Password' WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
        
                echo "<a href='admin-home.php'><button class='btn' style='margin-left: 10.5rem;'>Home</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM adminpage WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $Fullname = $result['Fullname'];
                    $Username = $result['Username'];
                    $Email = $result['Email'];
                    $Password = $result['Password'];
                }

            ?>
            <header>Change Profile</header>
            <form action="" method="post">
                
                <div class="field input">
                    <label for="Fullname">Fullname</label>
                    <input type="text" name="Fullname" id="username" value="<?php echo $Fullname; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Username">Username</label>
                    <input type="text" name="Username" id="username" value="<?php echo $Username; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Email">Email</label>
                    <input type="text" name="Email" id="email" value="<?php echo $Email; ?>" autocomplete="off" required>
                </div>

                <div class="field input">
                    <label for="Password">Password</label>
                    <input type="text" name="Password" id="age" value="<?php echo $Password; ?>" autocomplete="off" required>
                </div>
                
                <div class="field" style="text-align: center;">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                    <br>
                    <a href="admin-home.php">Cancel</a>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>