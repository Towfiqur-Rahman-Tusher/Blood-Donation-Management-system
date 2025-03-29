<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
   $age = mysqli_real_escape_string($conn, $_POST['age']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $father_name = mysqli_real_escape_string($conn, $_POST['fatherName']);
   $mother_name = mysqli_real_escape_string($conn, $_POST['motherName']);
   $contact_number = mysqli_real_escape_string($conn, $_POST['contactNumber']);
   $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_images/'.$image;

   $select = "SELECT * FROM user_form WHERE email = '$email'";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
      $error[] = 'User already exists!';
   } else {
      if($pass != $cpass){
         $error[] = 'Passwords do not match!';
      } else {
         $insert = "INSERT INTO user_form(name, email, blood_group, age, address, father_name, mother_name, contact_number, user_type, password, image) 
                    VALUES('$name','$email','$blood_group','$age','$address','$father_name','$mother_name','$contact_number','$user_type','$pass','$image')";
         mysqli_query($conn, $insert);
         move_uploaded_file($image_tmp_name, $image_folder);
         header('location:login_form.php');
      }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Register Form</title>
   <link rel="stylesheet" href="css/register_form.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   
<?php include 'navbar.php'; ?>

<div class="form-container">
   <form action="" method="post" enctype="multipart/form-data">
      <h3>Register Now</h3>
      <?php
      if(isset($error)){
         foreach($error as $error){
            echo '<span class="error-msg">'.$error.'</span>';
         }
      }
      ?>
      <input type="text" name="name" required placeholder="Enter your full name">
      <input type="email" name="email" required placeholder="Enter your email">
      
      <div class="radio-group">
         <label>Blood Group:</label>
         <label><input type="radio" name="blood_group" value="A+" required> A+</label>
         <label><input type="radio" name="blood_group" value="A-" required> A-</label>
         <label><input type="radio" name="blood_group" value="B+" required> B+</label>
         <label><input type="radio" name="blood_group" value="B-" required> B-</label>
         <label><input type="radio" name="blood_group" value="O+" required> O+</label>
         <label><input type="radio" name="blood_group" value="O-" required> O-</label>
         <label><input type="radio" name="blood_group" value="AB+" required> AB+</label>
         <label><input type="radio" name="blood_group" value="AB-" required> AB-</label>
      </div>

      <input type="number" name="age" required placeholder="Enter your age" min="18" max="70">
      <input type="text" name="address" required placeholder="Enter your address">
      <input type="text" name="fatherName" required placeholder="Enter your father's name">
      <input type="text" name="motherName" required placeholder="Enter your mother's name">
      <input type="tel" name="contactNumber" required placeholder="Enter your contact number">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="password" name="cpassword" required placeholder="Confirm your password">
      
      <select name="user_type" required>
         <option value="user">User</option>
         <option value="admin">Admin</option>
      </select>
      
      <label for="image">Upload Image (300x300px):</label>
      <input type="file" id="image" name="image" accept="image/*" required>

      <input type="submit" name="submit" value="Register Now" class="form-btn">
      <p>Already have an account? <a href="login_form.php">Login now</a></p>
   </form>
</div>

<footer>
        <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
    </footer>

<script src="jsfile/new.js"></script>
</body>
</html>