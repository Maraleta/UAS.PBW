<?php
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    </head>
<body>
    <a href="logout.php" class="btn btn-danger btn-sm w-100 fw-bold">🚪 Logout</a>
    
    <h3>Selamat Datang, <?php echo $_SESSION['user']; ?>!</h3>
    </body>
</html>