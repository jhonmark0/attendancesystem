<!DOCTYPE html>
<html>
  <head>
    <title>Attendance System Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="script.js"></script>

  </head>
  <body>
    <header class="sticky">
      <div class="logo">
        <h1>Attendance System</h1>
      </div>
      <nav>
        <ul>
          <li class="active"><a href="dashboard.php">Dashboard</a></li>
          <li><a href="startattendance.php">Start Atendancing</a></li>
          <li><a href="attendancereports.php">Attendance Reports</a></li>
          <li><a href="enrollcard.php">Enroll Card</a></li>
          <li class="dropdown">
            <a href="#" class="dropbtn">Menu</a>
            <div class="dropdown-content">
              <a href="Users.php">Users</a>
              <a href="About.html">About</a>
              <a href="index.php">Logout</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <main>
	<div class="dashboard">
 
	<h1>User Information Form</h1>

    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = '';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $card_id = $_POST['card_id'];
    $name = $_POST['name'];

    // Insert data into the table
    $sql = "INSERT INTO user (card_id, name)
    VALUES ('$card_id', '$name')";

    if ($conn->query($sql) === TRUE) {
        $message = "Thank you for submitting your information!";        
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<?php if(empty($message)): ?>
    <form method="post" action="">
        <label for="card_id">Card ID:</label>
        <input type="text" name="card_id" required><br>

        <label for="name">Name:</label>
        <input type="text" name="name" required><br>

        <input type="submit" value="Submit">
    </form>
<?php else: ?>
    <p><?php echo $message; ?></p>
    <p>What would you like to do next?</p>
    <ul>
    <li><a href="enrollcard.php">Enroll Another Card</a></li>
    <li><a href="homepage.html">Quit</a></li>
    </ul>
<?php endif; ?>

    </main>
      
      <footer>
        <div class="footer-content">
          <p>&copy; 2023 Attendance System</p>
          
          <label class="switch">
            <input type="checkbox" onclick="toggleDarkMode()">
            <span class="slider round"></span>
            <span class="mode-text">Light Mode</span>
          </label>
        </div>
      </footer>
	</div>
  </body>
</html>
