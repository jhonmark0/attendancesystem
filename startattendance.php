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
    <h1>Please Enter or Tap Your Card Id</h1>
<?php
date_default_timezone_set('Asia/Manila');

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $card_id = $_POST["card_id"];

  // Retrieve student's information from the database
  $sql = "SELECT * FROM user WHERE card_id = $card_id";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      $name = $row["name"];

      // Get current date and time
      $date = date("Y-m-d");
      $time = date("H:i:s");

      // Check if user already recorded time in and time out on the current date
      $sql = "SELECT * FROM attendances WHERE card_id = $card_id AND date = '$date'";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        // User already recorded time in and time out on the current date
        $row = $result->fetch_assoc();
        $time_in = $row["time_in"];
        $time_out = $row["time_out"];

        if ($time_in != "" && $time_out == "00:00:00") {
          // User has already recorded time in but has not recorded time out on the current date
          $sql = "UPDATE attendances SET time_out = '$time' WHERE card_id = $card_id AND date = '$date'";
          if ($conn->query($sql) === TRUE) {
            // Output success message
            echo "<h2>Time out recorded for $name (Card ID: $card_id) on $date at $time</h2>";
          } else {
            // Output error message
            echo "<h2>Error recording time out: " . $conn->error . "</h2>";
          }
        } else {
          // User has already recorded time in and time out on the current date
          echo "<h2>Error: $name (Card ID: $card_id) already recorded time in and time out on $date</h2>";
        }
      } else {
        // User has not recorded time in on the current date
        $sql = "INSERT INTO attendances (card_id, name, date, time_in) VALUES ('$card_id', '$name', '$date', '$time')";
        if ($conn->query($sql) === TRUE) {
          // Output success message
          echo "<h2>Time in recorded for $name (Card ID: $card_id) on $date at $time</h2>";
        } else {
          // Output error message
          echo "<h2>Error recording time in: " . $conn->error . "</h2>";
        }
      }
    }
  } else {
    // Output error message
    echo "<h2>No student found with Card ID: $card_id</h2>";
  }
}

$conn->close();
?>
<form method="post">
  <label for="card_id">Card ID:</label>
  <input type="text" name="card_id" required><br>

  <input type="submit" value="Submit">
</form>
<br>
</div>
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