<?php
session_start(); // Ensure the session is started

// Check if the user is logged in by verifying the session
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // If not logged in, redirect to login page
    header('Location: auth/login.php');
    exit();
}

// Use `user_id` from session and fetch user details from the database
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    require_once 'includes/db.php';

    // Fetch user info based on session `user_id`
    $sql = "SELECT username, email FROM users WHERE id = '$userId'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch user data
        $user_data = $result->fetch_assoc();
        $username = $user_data['username'];
        $email = $user_data['email'];
    } else {
        // Handle the case if user not found
        die("User not found.");
    }
} else {
    echo "Session not set properly.";
    exit(); // Exit if the session is not set
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['message']) && !empty($_POST['message'])) {
        $message = mysqli_real_escape_string($conn, $_POST['message']);

        // Insert the message with user info into the contact_messages table
        $sql = "INSERT INTO contact_messages (user_id, username, email, message) 
        VALUES ('$userId', '$username', '$email', '$message')";


        if ($conn->query($sql) === TRUE) {
            $success_msg = "Message sent successfully!";
        } else {
            $error_msg = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_msg = "Message cannot be empty.";
    }
}

// Fetch all messages (optional: if you want to display them in the admin panel)
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = $conn->query($sql);


// Fetch all messages (optional: if you want to display them in the admin panel)
$sql = "SELECT * FROM contact_messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediLink Services - Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('includes/Contact Us.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
        }
        header {
            background: rgba(0, 123, 255, 0.8);
            color: white;
            padding: 10px 0;
        }
       /* Navbar styling */
       nav a {
            color: white;
            margin: 0 10px;
            font-weight: bold;
            text-decoration: none;
        }
        nav a:hover {
            color: #ffdd57;
        }
        /* Dropdown menu on hover */
        .navbar .nav-item:hover .dropdown-menu {
            display: block;
            transition: opacity 0.3s;
        }
        .dropdown-menu {
            background-color: rgba(255, 255, 255, 0.8);
            border: none;
            backdrop-filter: blur(5px);
        }
        .dropdown-item {
            color: #333;
        }
        .dropdown-item:hover {
            background-color: rgba(0, 123, 255, 0.3);
        }
        .hero {
            background: url('includes/Contact Us.jpg') no-repeat center center;
            background-size: cover;
            height: 250px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            color: white;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.6);
        }
        .contact-form {
            color: #007bff;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
            margin-top: -100px;
        }
        .contact-form label {
            font-weight: bold;
            color: #333;
        }
        .contact-form textarea {
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            padding: 12px;
            width: 100%;
            font-size: 1rem;
        }
        .contact-form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .contact-form button:hover {
            background-color: #0056b3;
            cursor: pointer;
        }
        footer {
            background: rgba(0, 123, 255, 0.8);
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        .message-table {
            margin-top: 50px;
            color: white;
        }
        .message-table th, .message-table td {
            padding: 15px;
            text-align: left;
        }
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

<header class="text-center">
    <h1>MediLink Services</h1>
    <nav class="navbar navbar-expand-lg">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="about.php" class="nav-link">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link">Contact</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="services.php" id="servicesDropdown">
                            Services
                        </a>
                        <div class="dropdown-menu" aria-labelledby="servicesDropdown">
                            <a class="dropdown-item" href="services/ambulance.php">Ambulance Services</a>
                            <a class="dropdown-item" href="services/nursing.php">Nursing Suppliers</a>
                            <a class="dropdown-item" href="services/clinic.php">Temporary Clinics</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="services/equipment.php" id="equipmentDropdown">
                            Equipment Supplies
                        </a>
                        <div class="dropdown-menu" aria-labelledby="equipmentDropdown">
                            <a class="dropdown-item" href="services/ambulance_equipment_details.php">Ambulance Equipment</a>
                            <a class="dropdown-item" href="services/clinic_equipment_details.php">Temporary Clinic Equipment</a>
                            <a class="dropdown-item" href="services/monitoring_equipment_details.php">Monitoring Equipment</a>
                        </div>
                    </li>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                        <li class="nav-item">
                            <a href="../auth/logout.php" class="nav-link">Logout</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="../auth/login.php" class="nav-link">Login</a>
                        </li>
                        <li class="nav-item">
                            <a href="../auth/register.php" class="nav-link">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
</header>

<div class="hero">
    <h1>Get in Touch with MediLink Services</h1>
</div>

<div class="container contact-form">
    <h2>Contact Us</h2>
    <?php if (isset($success_msg)) { echo "<p class='text-success'>$success_msg</p>"; } ?>
    <?php if (isset($error_msg)) { echo "<p class='text-danger'>$error_msg</p>"; } ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Send Message</button>
    </form>
</div>

<!-- Display submitted messages (optional) -->
<div class="container message-table">
    <h2>All Messages</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Date Submitted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . $row['id'] . "</td>
                            <td>" . $row['username'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['message'] . "</td>
                            <td>" . $row['created_at'] . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No messages found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

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
<script>
        document.querySelectorAll('.dropdown-toggle').forEach(dropdown => {
            dropdown.addEventListener('click', function (e) {
                if (window.innerWidth > 992) {
                    e.stopPropagation();
                }
            });
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>

