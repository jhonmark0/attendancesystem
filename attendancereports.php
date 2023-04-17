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
        <h2>Attendance Report for January 2023</h2>
        <div class="summary">
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "mydb";
          $conn = mysqli_connect($servername, $username, $password, $dbname);
          if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
          }
          $total_employees_query = "SELECT COUNT(*) FROM user";
          $total_employees_result = mysqli_query($conn, $total_employees_query);
          $total_employees = mysqli_fetch_array($total_employees_result)[0];

          $employees_present_query = "SELECT COUNT(*) FROM attendances";
          $employees_present_result = mysqli_query($conn, $employees_present_query);
          $employees_present = mysqli_fetch_array($employees_present_result)[0];

          $employees_absent_query = "SELECT COUNT(*) FROM user WHERE name NOT IN (SELECT name FROM attendances)";
          $employees_absent_result = mysqli_query($conn, $employees_absent_query);
          $employees_absent = mysqli_fetch_array($employees_absent_result)[0];

          echo '<div class="card">';
          echo '<h3>Total Number of Employees</h3>';
          echo '<div class="count">' . $total_employees . '</div>';
          echo '</div>';
          echo '<div class="card">';
          echo '<h3>Number of Employees Present</h3>';
          echo '<div class="count">' . $employees_present . '</div>';
          echo '</div>';
          echo '<div class="card">';
          echo '<h3>Number of Employees Absent</h3>';
          echo '<div class="count">' . $employees_absent . '</div>';
          echo '</div>';
          mysqli_close($conn);
          ?>
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