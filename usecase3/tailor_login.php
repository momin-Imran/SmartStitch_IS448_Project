<?php
/**
 * Tailor Login Script
 * 
 * This script handles the login process for tailors:
 * - Verifies credentials against the database
 * - Implements brute-force protection with lockout
 * - Rehashes outdated password hashes
 * - Stores authenticated user data in session
 * - Redirects to availability update page upon success
 */

include_once('config.php'); // Optional config file (useful for constants or settings)

session_start(); // Start or resume the session

// Connect to the MySQL database using the current credentials
$db = mysqli_connect("studentdb-maria.gl.umbc.edu", "eubini1", "eubini1", "eubini1");

// If database connection fails, stop execution
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Set constants for login security
define('MAX_LOGIN_ATTEMPTS', 5);     // Max allowed failures before lockout
define('LOCKOUT_TIME', 900);         // Lockout time in seconds (15 minutes)

// Handle form submission only on POST request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];        // Get email from form
    $password = $_POST['password'];  // Get password from form

    // --- STEP 1: Check if the user is currently locked out ---
    $stmt = $db->prepare("SELECT failed_attempts, last_failed_attempt FROM Tailors WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($failed_attempts, $last_failed_attempt);
    $stmt->fetch();
    $stmt->close();

    // If too many attempts and lockout time not expired, block login
    if ($failed_attempts >= MAX_LOGIN_ATTEMPTS && (time() - strtotime($last_failed_attempt)) < LOCKOUT_TIME) {
        die("Too many failed login attempts. Please try again later.");
    }

    // --- STEP 2: Check if the user exists and retrieve stored hash ---
    $stmt = $db->prepare("SELECT tailor_id, password FROM Tailors WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($tailor_id, $stored_hash);
    $stmt->fetch();
    $stmt->close();

    if ($stored_hash) {
        // --- STEP 3: Rehash password if needed (security upgrade) ---
        if (password_needs_rehash($stored_hash, PASSWORD_DEFAULT)) {
            $new_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE Tailors SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $new_hash, $email);
            $stmt->execute();
            $stmt->close();
        }

        // --- STEP 4: Verify password and login if correct ---
        if (password_verify($password, $stored_hash)) {
            session_regenerate_id(true); // Prevent session fixation

            // Reset login failure counter on success
            $stmt = $db->prepare("UPDATE Tailors SET failed_attempts = 0 WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();

            // Store user data in session variables
            $_SESSION['tailor_email'] = $email;
            $_SESSION['tailor_id'] = $tailor_id;

            // Redirect to tailor availability dashboard
            header("Location: tailor-availability.php");
            exit();
        } else {
            // --- STEP 5: Incorrect password - increment failed attempts ---
            $stmt = $db->prepare("UPDATE Tailors SET failed_attempts = failed_attempts + 1, last_failed_attempt = NOW() WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->close();

            echo "Incorrect password.";
        }
    } else {
        // If no matching email found in database
        echo "No user found with that email.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tailor Login</title>
</head>
<body>
    <h2>Tailor Login</h2>

    <!-- Login form for tailors -->
    <form method="POST" action="tailor_login.php">
        <!-- Email input -->
        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="john@example.com" required>
        
        <!-- Password input -->
        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="password123" required>
        
        <!-- Submit button -->
        <button type="submit">Login</button>
    </form>
</body>
</html>


