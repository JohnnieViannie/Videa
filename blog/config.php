<?php
$servername = "localhost";
$username = "smartcl2";
$password = "oIM7L]3b2sj*G6";
$dbname = "smartcl2_blog";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>