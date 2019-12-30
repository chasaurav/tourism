<?php
$dbname = 'interview';
$dbhost = 'localhost';
$password = '';
$username = 'root';
$dsn = "mysql:dbname=$dbname;host=$dbhost";
$pdo = new PDO($dsn, $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
date_default_timezone_set('Asia/Kolkata');
