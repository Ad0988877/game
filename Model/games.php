<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php'); 
    exit;
}

// Read video game data from CSV
$games = array_map('str_getcsv', file('View/games.csv'));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Video Game Display</title>
</head>
<body>
    <?php include 'header.php'; ?> 
    
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <h2>Video Games</h2>
    
    <ul>
        <?php foreach ($games as $game): ?>
            <li>
                <h3><?php echo htmlspecialchars($game[0]); ?></h3>
                <p>Genre: <?php echo htmlspecialchars($game[1]); ?></p>
                <p>Platform: <?php echo htmlspecialchars($game[2]); ?></p>
                <img src="<?php echo htmlspecialchars($game[3]); ?>" alt="<?php echo htmlspecialchars($game[0]); ?>" style="width: 100px; height: auto;">
            </li>
        <?php endforeach; ?>
    </ul>
    

</body>
</html>
