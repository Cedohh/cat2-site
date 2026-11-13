<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $u = trim($_POST['username']); $f = trim($_POST['fullname']); $e = trim($_POST['email']);
  $p = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $s = $conn->prepare("INSERT INTO users (username, fullname, email, password) VALUES (?,?,?,?)");
  $s->bind_param('ssss', $u, $f, $e, $p);
  $msg = $s->execute() ? "Registered: " . htmlspecialchars($u) : "Error: " . $s->error;
}
?>
<!DOCTYPE html><html><head><title>Sign Up</title><link rel="stylesheet" href="style.css"></head><body>
<div class="card">
<h2>Sign Up</h2>
<p class="msg"><?= $msg ?></p>
<form method="POST">
  <input name="username" placeholder="Username" required>
  <input name="fullname" placeholder="Full name">
  <input name="email" type="email" placeholder="Email">
  <input name="password" type="password" placeholder="Password" required>
  <button type="submit">Register</button>
</form>
<p><a href="login.php">Login</a> | <a href="feedback.php">Feedback</a></p>
</div></body></html>
