<?php
include('db.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login-form.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reservation_date = $_POST['reservation_date'];
    $user_id = $_SESSION['user_id'];

   
    $stmt = $pdo->prepare("INSERT INTO reservations (user_id, reservation_date) VALUES (?, ?)");
    $stmt->execute([$user_id, $reservation_date]);

    
    $message = "Reservation successfully made for " . $reservation_date;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Make a Reservation</title>
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
        <section class="reservation-section">
            <h2>Make a Reservation</h2>
            <form action="" method="POST">
                <label for="reservation_date">Select Reservation Date:</label>
                <input type="date" name="reservation_date" id="reservation_date" required>

                <button type="submit" class="btn">Confirm Reservation</button>
            </form>

            <?php if (isset($message)): ?>
                <div class="confirmation-message">
                    <p><?= $message ?></p>
                </div>
            <?php endif; ?>
        </section>

        <section class="available-dates">
            <h2>Available Dates</h2>
            <p>Pick a date that works best for you to enjoy our stunning locations!</p>
            <!-- You can add more features here, such as a calendar or date picker UI -->
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Booking. All rights reserved.</p>
    </footer>
</body>