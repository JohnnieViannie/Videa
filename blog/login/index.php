<?php
include '../config.php';

session_start();

try {
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $pdo->prepare("SELECT user_id, username, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['username'] = $row['username'];
                header("Location: dashboard.php");
                exit();
            } else {
                $error = "Wrong password";
            }
        } else {
            $error = "Email not found";
        }
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
<div class="container">
  <div class="card">
    <h2>Login</h2>
    <form method="POST" action="">
      <input type="email" id="email" name="email" placeholder="Email" required>
      <input type="password" id="password" name="password" placeholder="Password" required>
      <button type="submit">Login</button>
    </form>
    <?php
    if (isset($error)) {
        echo "<p>$error</p>";
    }
    ?>
  </div>
</div>
</body>
</html>