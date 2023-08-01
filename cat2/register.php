<?php

include 'config.php';

if(isset($_POST['submit'])){

    $name=mysqli_real_escape_string($conn, $_POST['name']);
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $pass=mysqli_real_escape_string($conn, md5($_POST['password']));
    $cpass=mysqli_real_escape_string($conn, md5($_POST['cpassword']));
    $image=$_FILES['image']['name'];
    $image_size=$_FILES['image']['size'];
    $image_tmp_name=$_FILES['image']['tmp_name'];
    $image_folder=$_FILES='uploaded_img/'.$image;


    $select=mysqli_query($conn, "SELECT * FROM `user_form` WHERE  email ='$email' AND password ='$pass'") or die('query failed');

    if(mysqli_num_rows($select)>0){
        $message[]='user already exists';
    }else{
        if($pass != $cpass ){
            $message[]='password do not match';
        }elseif($image_size >2000000 ){
            $message[]='image size is too large!';

        }else{
            $insert= mysqli_query($conn, "INSERT INTO `user_form` (name,email,password,image) VALUES('$name', '$email','$pass','$image')") or die('query failed');

            if($insert){
                move_uploaded_file($image_tmp_name, $image_folder);
                $message[]='registered sucessfully';
                header('location:login.php');

                
            }else{
                $message[]='registration failed';
            }
        }
    }




}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="style.css">
<script src="javascript/script.js"></script>

</head>
<body>


    <h1 style="text-align: center;">COURSES OFFERED</h1>
    <p>Welcome to Strathmore University where excellence meets innovation</p>
    <hr>
    <div class="navbar">
        <ul>
            <li><a href="register.php">Home</a></li>
        <li><a href="home1.php">Menu</a></li>
      <li> <a href="away.php">Sports</a></li>
    </ul>
    </div>
    <p>Some of the courses we offer are as follows</p>
    
    <ol>
        <li>DBIT</li>
        <li>LLB</li>
        <li>ICS</li>
    </ol>
 <figure>
        <img src="images/students.jpg" alt="Students" width="30%">
        <figcaption>Students at Strathmore University</figcaption>
    </figure>
     <div class="product-display">
    <table class="product-display-table" >
        <thead>
            <tr>
                <th colspan="3">Courses Offered</th>

                
            </tr>
            
            <tr>
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Instructor</th>
            </tr>
           </thead>
            <tr>
                <td>DBIT</td>
                <td>CSC232</td>
                <td>Prof Smith</td>
            </tr>
            <tr>
                <td>LLB</td>
                <td>LBL545</td>
                <td>Prof. Johnson</td>
            </tr>
            <tr>
                <td>ICS</td>
                <td>ICS4433</td>
                <td>Prof Braithwait</td>
            </tr>
            <tr>
                <td>Literature</td>
                <td>ENG6372</td>
                <td>Prof. Davis</td>
            </tr>

        </table>
    </div>





<h2 style="text-align: center; text-decoration: underline;">Submit your info below to register to our univeristy</h2>
        <br>





<div class="form-container">

<div class="inputs">


<form action="" method="post" enctype="multipart/form-data">
    <h3>register now</h3>
    <?php
    
    if(isset($message)){
        foreach($message as $message){
            echo '<div class= "message">'.$message.'</div>';
        }
    }
    ?>
                     
                  <div>
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="name" placeholder="enter username" class="box" required>
                    <p id="username-error"></p>
                </div>

<div>
    <label for="email">Email:</label>
<input type="email" name="email" placeholder="enter email" class="box" required>
</div>
               <div>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" placeholder="enter password" class="box" required>
                    <p id="password-error"></p>
                </div>
               <div>
                    
                    <input type="password" id="password" name="cpassword" placeholder="confirm password" class="box" required>
                    <p id="password-error"></p>
                </div>

                 <div>
                    <label for="age">Year of birth:</label>
                    <input type="number" id="age" name="age" placeholder="Enter your year of birth" class="box" required>
                    <p id="age-error"></p>
                </div>


      <div>
        <label for="image"> Set profile picture:</label>
  <input type="file" name="image" class="box" accept="image/jpg, image/jpeg, image/png">

</div>

                  <div>
                    <label for="select">Register as:</label>
                    <select id="select" name="select">
                        <option value="choose">Choose</option>
                        <option value="admin">Staff</option>
                        <option value="customer">Student</option>
                    </select>
                    <p id="select-error"></p>
                </div>
<input type="submit" name="submit" value="register now" class="btn">
<p style="color: navy;">already have an account? <a href="login.php">login now</a></p>
</form>
</div>
</div>


    
</body>
</html>