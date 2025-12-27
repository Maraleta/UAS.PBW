<?php
session_start();

if (isset($_SESSION['login'])) {
    header("Location: index.php");
    exit;
}
if (isset($_POST['submit_login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    if ($user == "Ahmad Faiz" && $pass == "123") {
        $_SESSION['login'] = true;
        $_SESSION['nama'] = "Ahmad Faiz";
        header("Location: index.php");
        exit;
    } else {
        $error = "Maaf, akun salah!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>M-Pay | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f8fafc; display: flex; align-items: center; justify-content: center; height: 100vh; font-family: sans-serif; }
        .card { width: 350px; border: none; border-radius: 15px; box-shadow: 0 10px 20px rgba(0,0,0,0.05); }
    </style>
</head>
<body>
    <div class="card p-4">
        <h4 class="text-center fw-bold mb-4">M-PAY LOGIN</h4>
        <?php if(isset($error)) : ?>
            <div class="alert alert-danger p-2 small"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label class="small fw-bold">Username</label>
                <input type="text" name="username" class="form-control" required placeholder="admin">
            </div>
            <div class="mb-3">
                <label class="small fw-bold">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="123">
            </div>
            <button type="submit" name="submit_login" class="btn btn-primary w-100 fw-bold py-2">MASUK</button>
        </form>
    </div>
</body>
</html>