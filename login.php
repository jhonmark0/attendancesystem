<?php
if(isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  // Connect to database
  $conn = mysqli_connect("localhost", "root", "", "mydb");

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Check if user exists
  $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
  $result = mysqli_query($conn, $query);
  $count = mysqli_num_rows($result);

  if($count == 1) {
    // Successful login
    mysqli_close($conn);
    header("Location: dashboard.php");
    exit();
  } else {
    // Invalid login
    echo "<h1>Invalid email or password</h1>";
  }

  mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="main.css">
</head>
<body>
  <div class="container">
    <form class="login-form" method="POST">
      <h1>Login</h1>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn" name="login">Login</button>
      <div class="signup-link">
        Don't have an account yet? <a href="signup.php" id="signup-link">Sign up</a>
      </div>
    </form>
  </div>
</body>
</html>
