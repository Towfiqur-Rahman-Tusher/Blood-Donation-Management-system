<?php
// Include configuration file
@include 'config.php';

// Start session
session_start();

// Handle form submission
if (isset($_POST['submit'])) {

    // Sanitize input data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    // Query to select user from the database
    $select = "SELECT * FROM user_form WHERE email = '$email' && password = '$pass'";
    $result = mysqli_query($conn, $select);

    // Check if user exists and handle login
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if ($row['user_type'] == 'admin') {
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
        } elseif ($row['user_type'] == 'user') {
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
        }
    } else {
        $error[] = 'Incorrect email or password!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/login_form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="form-container">
        <form action="" method="post">
            <h3>Login Now</h3>
            <?php
            // Display error message if exists
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class="error-msg">' . $error . '</span>';
                }
            }
            ?>
            <input type="email" name="email" required placeholder="Enter your email">
            <input type="password" name="password" required placeholder="Enter your password">
            <input type="submit" name="submit" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="register_form.php">Register now</a></p>
        </form>
    </div>

    <footer>
        <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
    </footer>

    <script src="jsfile/new.js"></script>
</body>

</html>
