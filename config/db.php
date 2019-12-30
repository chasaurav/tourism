<?php
$dbname = 'vpejypg1a3r2zoja';
$dbhost = 'sp6xl8zoyvbumaa2.cbetxkdyhwsb.us-east-1.rds.amazonaws.com';
$username = 'sm1qc9xvhns8jr9y';
$password = 'y6xsa57ui47c9xn7';
$dsn = "mysql:dbname=$dbname;host=$dbhost";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
date_default_timezone_set('Asia/Kolkata');
