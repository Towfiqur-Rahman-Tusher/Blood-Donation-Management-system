<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_name'])){
   header('location:login_form.php');
}

// Get user information from the session
$user_name = $_SESSION['user_name'];

// Fetch blood requests for the user
$query = "SELECT * FROM blood_requests WHERE requester_name = '$user_name' ORDER BY request_date DESC";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Notifications</title>
   <link rel="stylesheet" href="css/view_notifications.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarB.php'; ?>

<div class="container">
   <div class="content">
      <h2>Request Notifications</h2>
      <?php if(mysqli_num_rows($result) > 0): ?>
         <table>
            <tr>
               <th>Request ID</th>
               <th>Blood Group</th>
               <th>Quantity</th>
               <th>Status</th>
               <th>Request Date</th>
               <th>Donor Details</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
               <tr>
                  <td><?php echo $row['id']; ?></td>
                  <td><?php echo $row['blood_group']; ?></td>
                  <td><?php echo $row['quantity']; ?></td>
                  <td><?php echo $row['status']; ?></td>
                  <td><?php echo $row['request_date']; ?></td>
                  <td>
                     <?php if($row['status'] == 'approved'): ?>
                        <?php
                           // Fetch donor details
                           $donor_query = "SELECT * FROM donors WHERE blood_group = '{$row['blood_group']}' ORDER BY availability DESC LIMIT 1";
                           $donor_result = mysqli_query($conn, $donor_query);
                           $donor = mysqli_fetch_assoc($donor_result);
                        ?>
                        <?php if($donor): ?>
                           <p>Donor Name: <?php echo $donor['user_name']; ?></p>
                           <p>Contact: <?php echo $donor['contact']; ?></p>
                        <?php else: ?>
                           <p>No donors available.</p>
                        <?php endif; ?>
                     <?php elseif($row['status'] == 'declined'): ?>
                        <p>Please contact the main office for further assistance.</p>
                     <?php endif; ?>
                  </td>
               </tr>
            <?php endwhile; ?>
         </table>
      <?php else: ?>
         <p>No notifications found.</p>
      <?php endif; ?>
   </div>
</div>

<footer>
    <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
</footer>

<script src="jsfile/new.js"></script>
</body>
</html>
