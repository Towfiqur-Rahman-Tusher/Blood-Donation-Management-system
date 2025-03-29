<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User Page</title>
   <link rel="stylesheet" href="css/user_page.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarB.php'; ?>

<div class="container">
   <div class="content">
      <h3>Hi, <span>User</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['user_name']; ?></span></h1>
      <p>This is a user page</p>

      <!-- User Panel Options -->
      <div class="user-options">
         <a href="request_blood.php" class="btn">Request Blood</a>
         <a href="donate_blood.php" class="btn">Become a Donor</a>
         <a href="register_form.php" class="btn">Register</a>
         <a href="view_notifications.php" class="btn">View Notifications</a> <!-- Added button -->
      </div>
   </div>
</div>

<footer>
    <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
</footer>

<script src="jsfile/new.js"></script>
</body>
</html>
