<?php
$conn = new mysqli('localhost', 'cat2user', 'Cat2Pass!', 'CAT2');
if ($conn->connect_error) { die('DB connection failed: ' . $conn->connect_error); }
