<?php
// Database Connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Signup Functionality
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];

  // Check if user already exists
  $check_user_sql = "SELECT * FROM admin WHERE email='$email'";
  $result = $conn->query($check_user_sql);

  if ($result->num_rows > 0) {
    echo "User with this email already exists.";
  } else {
    // Insert user into database
    $insert_user_sql = "INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($insert_user_sql) === TRUE) {
      echo "User registered successfully.";
    } else {
      echo "Error: " . $insert_user_sql . "<br>" . $conn->error;
    }
  }

  $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="main.css">
</head>
<body>
  <div class="container">
    <form class="signup-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <h1>Sign up</h1>
      <div class="form-group">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit" class="btn">Sign up</button>
      <div class="login-link">
    Already have an account? <a href="login.php">Login</a>
  </div>
</form>
</div>
  <script src="loginscript.js"></script>
</body>
</html> 