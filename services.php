<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediLink Services - Our Services</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body { font-family: Arial, sans-serif; }
        header { background: #007aff; color: white; padding: 10px 0; }
        footer {
            background: #004aad;
            color: white;
            padding: 40px 0;
            text-align: center;
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
        .card {
            transition: transform 0.3s ease;
            cursor: pointer;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .card img {
            height: 150px;
            object-fit: cover;
        }
        .footer-links, .footer-contact, .footer-social {
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

<div class="container mt-5">
    <!-- Service Overview Section -->
    <div class="text-center mt-3">
        <p>At MediLink Services, we are committed to providing reliable, high-quality healthcare services to meet a wide range of needs. From rapid ambulance dispatch to trained nursing staff, temporary clinics, and medical equipment supplies, we aim to deliver seamless healthcare support whenever and wherever you need it.</p>
        <p>Explore our services below to find out how we can assist you or your loved ones in times of need.</p>
    </div>

    <h2 class="mt-5">Our Services</h2>
    <div class="row">
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card" onclick="window.location.href='services/ambulance.php'">
                <img src="includes/ambulance.jpg" alt="Ambulance" class="card-img-top">
                <div class="card-body text-center">
                    <a href="services/ambulance.php" class="stretched-link font-weight-bold">Ambulance Services</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card" onclick="window.location.href='services/nursing.php'">
                <img src="includes/nursing.jpg" alt="Nursing" class="card-img-top">
                <div class="card-body text-center">
                    <a href="services/nursing.php" class="stretched-link font-weight-bold">Nursing Suppliers</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card" onclick="window.location.href='services/clinic.php'">
                <img src="includes/clinic.jpg" alt="Clinic" class="card-img-top">
                <div class="card-body text-center">
                    <a href="services/clinic.php" class="stretched-link font-weight-bold">Temporary Clinics</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 mb-4">
            <div class="card" onclick="window.location.href='services/equipment.php'">
                <img src="includes/equipment.jpg" alt="Equipment" class="card-img-top">
                <div class="card-body text-center">
                    <a href="services/equipment.php" class="stretched-link font-weight-bold">Medical Equipment Supplies</a>
                </div>
            </div>
        </div>
    </div>
    <p class="mt-3 text-center">For more information on each service, please contact us or visit the respective pages.</p>

    <!-- Call to Action for Custom Solutions -->
    <p class="text-center mt-4">Need a custom solution? Contact our team to discuss tailored healthcare services for your unique requirements.</p>

    <!-- Highlighted Features Section -->
    <div class="container mt-5">
        <h3 class="text-center">Why Choose MediLink Services?</h3>
        <div class="row text-center mt-4">
            <div class="col-md-4">
                <h5>Reliability</h5>
                <p>Our trained professionals and well-equipped vehicles ensure dependable service every time.</p>
            </div>
            <div class="col-md-4">
                <h5>24/7 Availability</h5>
                <p>Whether it’s an emergency or a planned service, we are available around the clock.</p>
            </div>
            <div class="col-md-4">
                <h5>Quality Care</h5>
                <p>Our dedicated team provides compassionate and professional healthcare support.</p>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
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

        <!-- Footer Motivational Message -->
        <p class="mt-4">"Your health and safety are our top priorities. At MediLink Services, we’re here to serve you with compassion, professionalism, and dedication to quality care."</p>
        
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
