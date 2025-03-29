<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blood_donation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $feedback = $conn->real_escape_string($_POST['feedback']);

    $sql = "INSERT INTO feedback (Name, Email, Feedback) VALUES ('$name', '$email', '$feedback')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for your feedback!";
    } else {
        $message = "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
    <link rel="stylesheet" href="css/feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <nav class="navbar">
    <div class="navbar-brand">
            <a href="new.html">
                <img src="css/Logomain.png" alt="logo" class="logo">
            </a>
            <a href="new.html" class="brand-name">LIFELINE</a>
        </div>
        <ul class="navbar-nav">
        <li><a href="new.html"><i class="fa-solid fa-house"></i> Home</a></li>
            <li><a href="Aboutus.html"><i class="fa-solid fa-address-card"></i> About us</a></li>
            <li><a href="register_form.php"><i class="fa-solid fa-pencil"></i> Register</a></li>
            <li><a href="login_form.php"><i class="fa fa-lock"></i> Login</a></li>
            <li><a href="contactus.html"><i class="fas fa-phone"></i> Contact</a></li>
        </ul>
        <div class="navbar-toggle" id="navbar-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </nav>
    <div class="feedback-container">
        <h1>Feedback</h1>
        <div class="feedback-form">
            <form method="post" action="">
                Name:<input type="text" name="name" required><br>
                Email: <input type="email" name="email" required><br>
                Feedback: <textarea name="feedback" required></textarea><br>
                <input type="submit" value="Submit Feedback">
            </form>
        </div>
        <?php if (!empty($message)): ?>
            <div class='message'><?php echo $message; ?></div>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; 2024 Lifeline Blood Management authority. All rights reserved.</p>
    </footer>
    <script src="jsfile/new.js"></script>
</body>

</html>