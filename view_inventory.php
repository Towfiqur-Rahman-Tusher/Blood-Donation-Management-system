<?php

@include 'config.php';

session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:login_form.php');
    exit();
}

// Query to fetch data from blood_inventory table
$query = "SELECT blood_group, last_updated, quantity FROM blood_inventory";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blood Inventory</title>
    <link rel="stylesheet" href="css/inventory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<?php include 'navbarA.php'; ?>

<div class="container13">
    <h2>Available Blood Inventory</h2><br>
    <div class="card1">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="card">
                <h3><?php echo htmlspecialchars($row['blood_group']); ?></h3>
                <p>Last Updated: <?php echo htmlspecialchars($row['last_updated']); ?></p>
                <p>Quantity: <?php echo htmlspecialchars($row['quantity']); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</div>

<footer>
        <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
    </footer>
    <script src="jsfile/new.js"></script>

</body>
</html>
