<?php
require 'config.php';
session_start();
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $s = $conn->prepare("SELECT password FROM users WHERE username = ?");
  $s->bind_param('s', $_POST['username']);
  $s->execute();
  $s->bind_result($hash);
  if ($s->fetch() && password_verify($_POST['password'], $hash)) {
    $_SESSION['user'] = $_POST['username'];
    $msg = "Login successful. Welcome, " . htmlspecialchars($_POST['username']);
  } else { $msg = "Invalid username or password"; }
}
?>
<!DOCTYPE html><html><head><title>Login</title><link rel="stylesheet" href="style.css"></head><body>
<div class="card">
<h2>Login</h2>
<p class="msg"><?= $msg ?></p>
<form method="POST">
  <input name="username" placeholder="Username" required>
  <input name="password" type="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>
<p><a href="signup.php">Sign up</a></p>
</div></body></html>
