<?php
session_start();

// Logout: visiting login.php?logout=1 ends the session
if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();  
    header("Location: login.php");
    exit;
}

// Already logged in? Go straight to the dashboard.
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

$valid_username = "admin";
$valid_password = "admin";

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === $valid_username && $password === $valid_password) {
        session_regenerate_id(true);
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-3">
<div class="w-75 mx-auto">
<h2 class="text-black text-center">Login</h2>

<div class="border rounded p-3 mt-3 mx-auto" style="max-width: 400px;">

<?php if ($error): ?>
<div class="alert alert-danger py-2"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>

<form method="POST" action="login.php">
<div class="mb-3">
    <label class="form-label">Username</label>
    <input type="text" name="username" class="form-control" required autofocus>
</div>
<div class="mb-3">
<label class="form-label">Password</label>
<input type="password" name="password" class="form-control" required>
</div>
<button type="submit" class="btn btn-primary btn-sm">Login</button>
</form>

</div>
</div>
</div>

</body>
</html>