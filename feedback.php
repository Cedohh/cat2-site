<?php
require 'config.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $s = $conn->prepare("INSERT INTO feedback (name, message) VALUES (?,?)");
  $s->bind_param('ss', $_POST['name'], $_POST['message']);
  $msg = $s->execute() ? "Feedback saved" : "Error: " . $s->error;
}
$rows = $conn->query("SELECT id, name, message, created_at FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html><html><head><title>Feedback</title><link rel="stylesheet" href="style.css"></head><body>
<div class="card wide">
<h2>Feedback Form</h2>
<p class="msg"><?= $msg ?></p>
<form method="POST">
  <input name="name" placeholder="Your name" required>
  <textarea name="message" placeholder="Your message" required></textarea>
  <button type="submit">Submit</button>
</form>
<h3>Submitted feedback</h3>
<table>
<tr><th>ID</th><th>Name</th><th>Message</th><th>Time</th></tr>
<?php while ($r = $rows->fetch_assoc()): ?>
<tr><td><?= $r['id'] ?></td><td><?= htmlspecialchars($r['name']) ?></td><td><?= htmlspecialchars($r['message']) ?></td><td><?= $r['created_at'] ?></td></tr>
<?php endwhile; ?>
</table>
<p><a href="signup.php">Sign up</a> | <a href="login.php">Login</a></p>
</div></body></html>
