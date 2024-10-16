<?php
session_start(); // Start a session for user management
$errorMessage = '';

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    
    if (empty($username) || empty($password)) {
        $errorMessage = "Both fields are required.";
    } else {
        $credentials = array_map('str_getcsv', file('users.csv'));
        $valid = false;

        // Debugging: Check if the file is being read correctly
        foreach ($credentials as $cred) {
            echo "Checking: Username: " . $cred[0] . ", Password: " . $cred[1] . "<br>"; // Debugging line
            if (trim($cred[0]) == trim($username) && trim($cred[1]) == trim($password)) {
                $valid = true;
                break;
            }
        }

        if ($valid) {
            $_SESSION['username'] = $username; // Set session variable
            header('Location: games.php'); 
            exit;
        } else {
            $errorMessage = "Incorrect username: " . htmlspecialchars($username);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <?php include 'header.php'; ?> <!-- Include header -->
    
    <h1>Login</h1>

    <?php if (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
