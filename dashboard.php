<?php
// Database connection
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

// Total Employees count
$sql_total_employees = "SELECT COUNT(*) AS total_employees FROM user";
$result_total_employees = $conn->query($sql_total_employees);
if ($result_total_employees->num_rows > 0) {
  $row_total_employees = $result_total_employees->fetch_assoc();
  $total_employees = $row_total_employees["total_employees"];
} else {
  $total_employees = 0;
}

// Daily Attendance count
$sql_daily_attendance = "SELECT COUNT(*) AS daily_attendance FROM attendances";
$result_daily_attendance = $conn->query($sql_daily_attendance);
if ($result_daily_attendance->num_rows > 0) {
  $row_daily_attendance = $result_daily_attendance->fetch_assoc();
  $daily_attendance = $row_daily_attendance["daily_attendance"];
} else {
  $daily_attendance = 0;
}

// Present count
$sql_present = "SELECT COUNT(*) AS present FROM attendances";
$result_present = $conn->query($sql_present);
if ($result_present->num_rows > 0) {
  $row_present = $result_present->fetch_assoc();
  $present = $row_present["present"];
} else {
  $present = 0;
}

// Absent count
$sql_absent = "SELECT COUNT(*) AS absent FROM user WHERE name NOT IN (SELECT name FROM attendances)";
$result_absent = $conn->query($sql_absent);
if ($result_absent->num_rows > 0) {
  $row_absent = $result_absent->fetch_assoc();
  $absent = $row_absent["absent"];
} else {
  $absent = 0;
}

// Monthly Attendance percentage
$sql_monthly_attendance = "SELECT COUNT(DISTINCT name) AS monthly_attendance FROM attendances WHERE MONTH(date) = MONTH(CURDATE())";
$result_monthly_attendance = $conn->query($sql_monthly_attendance);
if ($result_monthly_attendance->num_rows > 0) {
  $row_monthly_attendance = $result_monthly_attendance->fetch_assoc();
  $monthly_attendance = ($row_monthly_attendance["monthly_attendance"] / $total_employees) * 100;
} else {
  $monthly_attendance = 0;
}

// Close database connection
$conn->close();
?>

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
        <li class="active"><a href="#dashboard">Dashboard</a></li>
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
<div id= "dashboard">
  <section class="dashboard">
    <h2>Attendance Summary</h2>
    <div class="summary">
      <?php
        $conn = mysqli_connect("localhost", "root", "", "mydb");
        if ($conn === false) {
          die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        // Count total employees
        $sql = "SELECT COUNT(*) FROM user";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $total_employees = $row[0];

        // Count daily attendance
        $sql = "SELECT COUNT(*) FROM attendances";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $daily_attendance = $row[0];

        // Count present
        $sql = "SELECT COUNT(*) FROM attendances WHERE time_out IS NOT NULL";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $present = $row[0];

        // Count absent
        $sql = "SELECT COUNT(*) FROM user WHERE name NOT IN (SELECT name FROM attendances)";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $absent = $row[0];

        // Count monthly attendance
        $month = date('m');
        $year = date('Y');
        $sql = "SELECT COUNT(*) FROM attendances WHERE YEAR(date) = $year AND MONTH(date) = $month";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $monthly_attendance = round(($row[0] / $total_employees) * 100);

        mysqli_close($conn);
      ?>
      <div class="card">
        <h3>Total Employees</h3>
        <p class="count"><?php echo $total_employees; ?></p>
      </div>
      <div class="card">
        <h3>Daily Attendance</h3>
        <p class="count"><?php echo $daily_attendance; ?></p>
        <p>Present: <?php echo $present; ?> / Absent: <?php echo $absent; ?></p>
      </div>
      <div class="card">
        <h3>Monthly Attendance</h3>
        <p class="count"><?php echo $monthly_attendance; ?>%</p>
      </div>
    </div>

    <div class="recent-entries">
            <h2>Recent Attendance Entries</h2>
            <table>
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Employee Name</th>
                  <th>Time In</th>
                  <th>Time Out</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  // Connect to the database
                  $servername = "localhost";
                  $username = "root";
                  $password = "";
                  $dbname = "mydb";
                  $conn = new mysqli($servername, $username, $password, $dbname);

                  // Check connection
                  if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                  }

                  // Fetch attendance entries from the database
                  $sql = "SELECT date, name, time_in, time_out FROM attendances ORDER BY date DESC LIMIT 6";
                  $result = $conn->query($sql);

                  // Output attendance entries as HTML table rows
                  if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                      echo "<tr><td>" . $row["date"] . "</td><td>" . $row["name"] . "</td><td>" . $row["time_in"] . "</td><td>" . $row["time_out"] . "</td></tr>";
                    }
                  } else {
                    echo "<tr><td colspan='4'>No attendance entries found</td></tr>";
                  }

                  // Close the database connection
                  $conn->close();
                ?>
              </tbody>
            </table>
          </div>
  </section>
</div>

<div id="FAQs" class="dashboard">
          <section class="FAQs">
            <h1>Attendance System FAQ</h1>
    <h2>General Questions</h2>
    <ul>
      <li>
        <h3>What is the Attendance System?</h3>
        <p>The Attendance System is a web-based application that allows organizations to track employee attendance and manage leave requests.</p>
      </li>
      <li>
        <h3>How do I access the Attendance System?</h3>
        <p>You can access the Attendance System by going to the URL provided by your organization's administrator and logging in with your credentials.</p>
      </li>
      <li>
        <h3>What browsers are supported?</h3>
        <p>The Attendance System is compatible with the latest versions of Chrome, Firefox, and Safari.</p>
      </li>
    </ul>
    <h2></h2>
    <h2>Using the Attendance System</h2>
    <ul>
      <li>
        <h3>How do I clock in and clock out?</h3>
        <p>To clock in and clock out, simply click the "Clock In" or "Clock Out" button on the home page of the Attendance System.</p>
      </li>
      <li>
        <h3>What do I do if I forget to clock in or clock out?</h3>
        <p>If you forget to clock in or clock out, please contact your supervisor to have them make the necessary adjustments in the system.</p>
      </li>
      <li>
        <h3>How do I request time off?</h3>
        <p>To request time off, click on the "Request Time Off" button on the home page of the Attendance System and fill out the necessary information. Your request will be sent to your supervisor for approval.</p>
      </li>
    </ul>
          </section>         
        </div>

        <div id="contactus" class="dashboard">
              <h1>Contact Us</h1>
              <h2>Phone No:</h2>
                <p>+639123456789</p>
                <h2>Email:</h2>
                <p>info@attendancesystem.com</p>
              <h2>Social Media:</h2>
              <div id="social-media">
                <a href="facebook.com"><img src="img/facebook.svg" alt="Facebook"></a>
                <a href="twitter.com"><img src="img/twitter.svg" alt="Twitter"></a>
                <a href="instagram.com"><img src="img/instagram.svg" alt="Instagram"></a>
              </div>
        </div>

        <div id="terms" class="dashboard">
        <div id="terms-of-service">
          <h1>Terms of Service</h1>
          
          <p>Welcome to our website. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use:</p>
          <h2>1. General Information</h2>
          <p>The content of the pages of this website is for your general information and use only. It is subject to change without notice.</p>
          <h2>2. Disclaimer</h2>
          <p>The information contained in this website is for general information purposes only. The information is provided by us and while we endeavour to keep the information up to date and correct, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability or availability with respect to the website or the information, products, services, or related graphics contained on the website for any purpose. Any reliance you place on such information is therefore strictly at your own risk.</p>
          <h2>3. Intellectual Property</h2>
          <p>This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.</p>
          <h2>4. Governing Law</h2>
          <p>Your use of this website and any dispute arising out of such use of the website is subject to the laws of Philippines .</p>
        </div>
        </div>

        <div id="policy" class="dashboard">
        <div id="privacy-policy">
          <h1>Privacy Policy</h1>
          <p></p>
          <p>We respect your privacy and are committed to protecting your personal information. This privacy policy outlines how we collect, use, and disclose your personal information.</p>
          
          <h2>1. Collection of Personal Information</h2>
          <p>We collect personal information such as your name, email address, and phone number when you fill out a form or make a purchase on our website. We also collect information about your use of our website through cookies and other tracking technologies.</p>
          
          <h2>2. Use of Personal Information</h2>
          <p>We use your personal information to provide you with the products and services you have requested, to communicate with you, and to improve our website and services. We may also use your information for marketing purposes, such as sending you promotional emails or newsletters.</p>
          
          <h2>3. Disclosure of Personal Information</h2>
          <p>We may disclose your personal information to third-party service providers who assist us with our business operations. We may also disclose your information to comply with legal or regulatory requirements, or to protect our rights and property.</p>
          
          <h2>4. Security of Personal Information</h2>
          <p>We take reasonable steps to protect your personal information from unauthorized access, use, or disclosure. We use secure servers and encrypt data transmissions to protect your information.</p>
          
          <h2>5. Changes to Privacy Policy</h2>
          <p>We may update this privacy policy from time to time. We will notify you of any changes by posting the new policy on our website.</p>
          
          <h2>6. Contact Us</h2>
          <p>If you have any questions or concerns about this privacy policy, please contact us at privacy @attendancesystem.com</p>
        </div>
      </div>

</main>
<footer>
<div class="footer-content">
  <p>&copy; 2023 Attendance System</p>
  <ul class="footer-links">
    <li><a href="#FAQs">FAQs</a></li>
    <li><a href="#contactus">Contact us</a></li>
            <li><a href="#terms">Terms of Service</a></li>
            <li><a href="#policy">Privacy Policy</a></li>
          </ul>
          <label class="switch">
            <input type="checkbox" onclick="toggleDarkMode()">
            <span class="slider round"></span>
            <span class="mode-text">Light Mode</span>
          </label>
        </div>
      </footer>
      
  </body>
</html>
