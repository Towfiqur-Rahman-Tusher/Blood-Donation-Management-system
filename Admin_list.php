<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$query = "SELECT id, name, blood_group, contact_number FROM user_form WHERE user_type = 'admin'";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin(Registered Users)</title>
   <link rel="stylesheet" href="css/registeredusers.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarA.php'; ?>

<div class="container22">
   <h2>Registered Users</h2>
   <table>
      <tr>
         <th>Donor ID</th>
         <th>Name</th>
         <th>Blood Group</th>
         <th>Contact</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo $row['contact_number']; ?></td>
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
