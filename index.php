<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login-form.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM reservations WHERE user_id = ?");
$stmt->execute([$user_id]);
$reservations = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Our Booking Service</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="assets/logo.png" alt="Logo">
    </div>
    <nav>
        <a href="index.php">Home</a>
        <a href="reservation.php">Make a Reservation</a>
        <a href="logout.php">Logout</a>
    </nav>
</header>

<main>
    <section class="hero">
        <h1>Book Your Dream Vacation</h1>
        <p>Find the perfect location for your getaway.</p>
        <a href="reservation.php" class="btn">Reserve Now</a>
    </section>

    <section class="gallery">
        <h2>Our Stunning Locations</h2>
        <div class="gallery-grid">
            <img src="location1.jpg" alt="Location 1">
            <img src="location2.jpg" alt="Location 2">
            <img src="location3.jpg" alt="Location 3">
        </div>
    </section>

    <section class="reservations">
        <h2>Your Reservations</h2>
        <div class="reservation-list">
            <?php if (count($reservations) > 0): ?>
                <ul>
                    <?php foreach ($reservations as $reservation): ?>
                        <li>Reservation on: <?= $reservation['reservation_date'] ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No reservations yet.</p>
            <?php endif; ?>
        </div>
    </section>
</main>

<footer>
    <p>&copy; 2025 Booking. All rights reserved.</p>
</footer>

</body>
</html>