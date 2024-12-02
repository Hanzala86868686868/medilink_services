<?php
session_start();
require_once '../includes/db.php'; // Include the database connection file

$error = ''; // Initialize an error variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if 'email' and 'password' keys exist in $_POST
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare and bind
        $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");

        // Check if statement preparation was successful
        if ($stmt === false) {
            // Log the error internally without exposing it to the user
            error_log("Error preparing statement: " . $conn->error);
            die("An error occurred, please try again later.");
        }

        $stmt->bind_param("s", $email); // Bind the email parameter

        // Execute the statement
        $stmt->execute();

        // Store result
        $stmt->store_result();

        // Check if email exists
        if ($stmt->num_rows == 1) {
            $stmt->bind_result($id, $hashed_password, $role);
            $stmt->fetch();

            // Verify password
            if (password_verify($password, $hashed_password)) {
                // Set session variables
                $_SESSION['user_id'] = $id;
                $_SESSION['role'] = $role;
                $_SESSION['loggedin'] = true; // Set logged-in session variable

                // Redirect based on user role
                if ($role === 'admin') {
                    header('Location: ../dashboard/admin_dashboard.php');
                } else {
                    header('Location: ../index.php'); // Redirect to user dashboard
                }
                exit();
            } else {
                // Invalid password
                $error = "Invalid email or password.";
            }
        } else {
            // No user found with the email
            $error = "Invalid email or password.";
        }

        $stmt->close(); // Close the prepared statement
    } else {
        $error = "Please fill in all fields."; // Handle the case where email or password is missing
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - MediLink Services</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
        header, footer { text-align: center; padding: 10px; background: #007bff; color: white; }
        main { padding: 20px; text-align: center; }
        input { margin: 10px 0; padding: 10px; width: 200px; }
        button { padding: 10px 20px; background-color: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #0056b3; }
        footer-links, .footer-contact, .footer-social {
            margin-bottom: 20px;
        }
        .footer-links a, .footer-social a {
            color: #ffdd57;
            text-decoration: none;
            margin: 0 10px;
        }
        .footer-social a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <?php if (!empty($error)): ?>
            <p style="color:red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </main>
    <footer>
    <div class="container">
        <div class="row">
            <!-- Quick Links -->
            <div class="col-md-4 footer-links">
                <h5>Quick Links</h5>
                <a href="about.php">About Us</a> | 
                <a href="contact.php">Contact</a> | 
                <a href="faq.php">FAQ</a>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 footer-contact">
                <h5>Contact Us</h5>
                <p>Phone: +123 456 7890</p>
                <p>Email: <a href="mailto:info@medilinkservices.com" style="color: #ffdd57;">info@medilinkservices.com</a></p>
                <p>Address: 123 Health St., MedCity</p>
            </div>

            <!-- Social Media Links -->
            <div class="col-md-4 footer-social">
                <h5>Follow Us</h5>
                <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i> Facebook</a>
                <a href="#" title="Twitter"><i class="fab fa-twitter"></i> Twitter</a>
                <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i> LinkedIn</a>
            </div>
        </div>

        <!-- Newsletter Subscription -->
        <div class="mt-4">
            <h5>Subscribe to Our Newsletter</h5>
            <form action="subscribe.php" method="post" class="form-inline justify-content-center">
                <input type="email" name="email" placeholder="Enter your email" class="form-control mr-2" required>
                <button type="submit" class="btn btn-warning">Subscribe</button>
            </form>
        </div>

        <p class="mt-4">&copy; 2024 MediLink Services. All Rights Reserved.</p>
    </div>
</footer>
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>

