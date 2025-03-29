<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
   header('location:login_form.php');
}

$query = "SELECT id, name, email, feedback FROM feedback";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>View Feedback</title>
   <link rel="stylesheet" href="css/view_feedback.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

   <?php include 'navbarA.php'; ?>

   <div class="container22">
      <h2>Feedback</h2>
      <table>
         <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Feedback</th>
         </tr>
         <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
               <td><?php echo $row['id']; ?></td>
               <td><?php echo $row['name']; ?></td>
               <td><?php echo $row['email']; ?></td>
               <td><?php echo $row['feedback']; ?></td>
            </tr>
         <?php endwhile; ?>
      </table>
   </div>

   <footer>
      <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
   </footer>

   <script src="jsfile/new.js"></script>
</body>

</html>