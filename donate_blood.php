<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

if(isset($_POST['submit'])){

   $user_name = $_SESSION['user_name'];
   $blood_group = $_POST['blood_group'];
   $contact = $_POST['contact'];
   $location = $_POST['location'];
   $availability = $_POST['availability'];

   $insert = "INSERT INTO donors(user_name, blood_group, contact, location, availability) VALUES('$user_name','$blood_group','$contact','$location','$availability')";

   if(mysqli_query($conn, $insert)){
      $message[] = 'Thank you for signing up as a donor!';
   }else{
      $message[] = 'Failed to sign up, please try again!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Donate Blood</title>
   <link rel="stylesheet" href="css/donate_blood.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarB.php'; ?>

<div class="container">
   <div class="content">
      <h3>Become a Donor</h3>
      
      <?php
      if(isset($message)){
         foreach($message as $msg){
            echo '<div class="message">'.$msg.'</div>';
         }
      }
      ?>

      <form action="" method="post">
         <label>Blood Group:</label>
         <select name="blood_group" required>
            <option value="A+">A+</option>
            <option value="A-">A-</option>
            <option value="B+">B+</option>
            <option value="B-">B-</option>
            <option value="O+">O+</option>
            <option value="O-">O-</option>
            <option value="AB+">AB+</option>
            <option value="AB-">AB-</option>
         </select>
         <label>Contact Number:</label>
         <input type="text" name="contact" required>
         <label>Location:</label>
         <input type="text" name="location" required>
         <label>Availability:</label>
         <input type="date" name="availability" required>
         <input type="submit" name="submit" value="Sign Up" class="btn">
      </form>
   </div>
</div>

<footer>
        <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
    </footer>

<script src="jsfile/new.js"></script>
</body>
</html>
