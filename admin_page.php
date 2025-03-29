<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>
   <link rel="stylesheet" href="css/admin_page.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarA.php'; ?>

<div class="container">
   <div class="content">
      <h3>Hi, <span>Admin</span></h3>
      <h1>Welcome <span><?php echo $_SESSION['admin_name']; ?></span></h1>
      <p>This is an admin page</p>

      <!-- Admin Panel Options -->
      <div class="admin-options">
         <a href="view_inventory.php" class="btn">View Blood Inventory</a>
         <a href="respond_requests.php" class="btn">Blood Requests</a>
         <a href="view_donors.php" class="btn">View Donors</a>
         <a href="registeredusers.php" class="btn">User list</a>
         <a href="Admin_list.php" class="btn">Admin list</a>
         <a href="view_feedback.php" class="btn">View Feedback</a>
      </div>
   </div>
</div>

<footer>
        <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
    </footer>

    <script src="jsfile/new.js"></script>
</body>
</html>
