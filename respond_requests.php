<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}

$query = "SELECT * FROM blood_requests WHERE status = 'pending'";
$result = mysqli_query($conn, $query);

if(isset($_POST['approve'])){
   $request_id = $_POST['request_id'];
   $update_query = "UPDATE blood_requests SET status = 'approved' WHERE id = $request_id";
   mysqli_query($conn, $update_query);
   header('location:respond_requests.php');
}

if(isset($_POST['decline'])){
   $request_id = $_POST['request_id'];
   $update_query = "UPDATE blood_requests SET status = 'declined' WHERE id = $request_id";
   mysqli_query($conn, $update_query);
   header('location:respond_requests.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Respond to Blood Requests</title>
   <link rel="stylesheet" href="css/respond_request.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarA.php'; ?>

<div class="container">
   <h2>Pending Blood Requests</h2>
   <table>
      <tr>
         <th>Request ID</th>
         <th>Requester Name</th>
         <th>Blood Group</th>
         <th>Quantity</th>
         <th>Status</th>
         <th>Request Date</th>
         <th>Action</th>
      </tr>
      <?php while($row = mysqli_fetch_assoc($result)): ?>
         <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['requester_name']; ?></td>
            <td><?php echo $row['blood_group']; ?></td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['status']; ?></td>
            <td><?php echo $row['request_date']; ?></td>
            <td>
               <form method="POST">
                  <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="approve" class="btn">Approve</button>
                  <button type="submit" name="decline" class="btn">Decline</button>
               </form>
            </td>
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
