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
        <section class="admin-list">
          
  <?php
  // Establish a database connection
  $conn = mysqli_connect("localhost", "root", "", "mydb");

  // Check the connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Fetch the admin users from the database
  $admins_query = "SELECT name, email FROM admin";
  $admins_result = mysqli_query($conn, $admins_query);

  // Output the admin users table
  echo '<section class="admin-list">
          <h2>Admin List</h2>
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
              </tr>
            </thead>
            <tbody>';

  while ($row = mysqli_fetch_assoc($admins_result)) {
    echo '<tr>
            <td>' . $row['name'] . '</td>
            <td>' . $row['email'] . '</td>
          </tr>';
  }

  echo '</tbody>
        </table>
      </section>';

  // Fetch the enrolled cards from the database
  $cards_query = "SELECT card_id, name FROM user";
  $cards_result = mysqli_query($conn, $cards_query);

  // Output the enrolled cards table
  echo '<section class="enrolled-cards">
          <h2>Enrolled Cards</h2>
          <table>
            <thead>
              <tr>
                <th>Card ID</th>
                <th>Name</th>
              </tr>
            </thead>
            <tbody>';

  while ($row = mysqli_fetch_assoc($cards_result)) {
    echo '<tr>
            <td>' . $row['card_id'] . '</td>
            <td>' . $row['name'] . '</td>
          </tr>';
  }

  echo '</tbody>
        </table>
      </section>';

  // Close the database connection
  mysqli_close($conn);
?>

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
