<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

// Get user information from the session
$user_name = $_SESSION['user_name'];

$query = "SELECT * FROM user_form WHERE name = '$user_name'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if(isset($_POST['submit'])){
   $requester_name = $user['name'];
   $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
   $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
   $status = 'pending';
   $request_date = date('Y-m-d H:i:s');

   $insert_query = "INSERT INTO blood_requests (requester_name, blood_group, quantity, status, request_date) 
                    VALUES ('$requester_name', '$blood_group', '$quantity', '$status', '$request_date')";

   if(mysqli_query($conn, $insert_query)){
      $success_message = "Blood request submitted successfully!";
   } else {
      $error_message = "Failed to submit the blood request.";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Request Blood</title>
   <link rel="stylesheet" href="css/request_blood.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarB.php'; ?>

<div class="container">
   <div class="content">
      <h2>Request Blood</h2>

      <?php
      if(isset($success_message)){
         echo "<p class='success'>$success_message</p>";
      } elseif(isset($error_message)){
         echo "<p class='error'>$error_message</p>";
      }
      ?>

      <form action="" method="post">
         <div class="form-group">
            <label for="blood_group">Blood Group:</label>
            <select name="blood_group" id="blood_group" required>
               <option value="A+">A+</option>
               <option value="A-">A-</option>
               <option value="B+">B+</option>
               <option value="B-">B-</option>
               <option value="O+">O+</option>
               <option value="O-">O-</option>
               <option value="AB+">AB+</option>
               <option value="AB-">AB-</option>
            </select>
         </div>
         <div class="form-group">
            <label for="quantity">Quantity (in units):</label>
            <input type="number" name="quantity" id="quantity" required min="1">
         </div>
         <button type="submit" name="submit" class="btn">Submit Request</button>
      </form>
   </div>
</div>

<footer>
        <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
    </footer>
    <script src="jsfile/new.js"></script>
</body>
</html>
