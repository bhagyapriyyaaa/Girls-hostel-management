<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Girl's Hostel Management</title>
  <style>
    *{
      margin:0;
      padding:0;
      box-sizing: border-box;
      font-family: "Poppins",sans-serif;
    }
    body{
      display:flex;
      justify-content:center;
      align-items:center;
      min-height:100vh;
      background:url("girl'shostel.jpeg") no-repeat;
      background-size:cover;
      background-position:center;
    }
    .wrapper{
      width:420px;
      background:transparent;
      border: 10px solid rgba(7, 5, 5, 0.2);
      backdrop-filter:blur(20px);
      box-shadow: 0 0 10px rgba(19, 19, 19, 0.2);
      color:#090909;
      border-radius:10px;
      padding:30px 40px;
    }
    .wrapper h1{
      font-size:36px;
      text-align:center;
      border-bottom: 4px solid rgba(7, 1, 1, 0.5); /* Add border */
      padding-bottom: 20px; /* Adjust padding */
      margin-bottom: 20px; /* Adjust margin */
    }
    .wrapper .input-box{
      width:100%;
      height:50px;
      background: #9292b0;
      margin:30px 0;
    }
    .input-box input{
      width:100%;
      height: 100%;
      background:transparent;
      border:none;
      outline:none;
      border:2px solid rgba(255,255,255,.2);
      border-radius:40px;
      font-size:16px;
      color:#fff; /* Change text color to white */
      padding:20px 45px 20px 20px;
    }
    .input-box input::placeholder{
      color:#070707;
    }
    .input-box i{
      position:absolute;
      right:20px;
      top:50%;
      transform:translateY(-50%);
      font-size:20px;
    }
    .wrapper .remember-forgot{
      display:flex;
      justify-content:space-between;
      font-size:14.5px;
      margin: -15px 0 15px;
    }
    .remember-forgot label input{
      accent-color:#fff;
      margin-right:3px;
    }
    .remember-forgot a{
      color:#fff;
      text-decoration:none;
    }
    .remember-forgot a:hover{
      text-decoration:underline;
    }
    .wrapper .btn{
      width:100%;
      height:45px;
      background:#101010;
      border:none;
      outline:none;
      border-radius:40px;
      box-shadow: 0 10 10px rgba(0,0,0,.1);
      cursor:pointer;
      font-size:16px;
      color:#fff;
      font-weight:600;
    }
    
  </style>
</head>
<body>



<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $s_id = $_POST['s_id'];
    $s_name = $_POST['s_name'];
    $s_age= $_POST['s_age'];
    $s_address = $_POST['s_address'];
    $s_phoneno = $_POST['s_phoneno'];
    $s_dob = $_POST['s_dob'];
    $s_email = $_POST['s_email'];
    $joining_year = $_POST['joining_year'];
    $programme = $_POST['programme'];
    $aadhar_no = $_POST['aadhar_no'];
    $s_pass= $_POST[ 'password' ];


$servername ="localhost:3307";
$username = "root";
$password = "";

$Database = "girlshostel";
$conn = mysqli_connect($servername, $username, $password,$Database );  

 if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
else{
    echo "<br>Connected successfully<br>"; 

    $sql ="INSERT INTO hostellerprofile (sid, sname, sage, saddress, sphoneNo, sDOB, semail, joining_year, programme, aadhaar_no,s_password) VALUES ('$s_id', '$s_name', '$s_age', '$s_address', '$s_phoneno', '$s_dob', '$s_email', '$joining_year', '$programme', '$aadhar_no','$s_pass')";

    $result=mysqli_query($conn,$sql);
    
    if($result){
      echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>Success!</strong> You have been registered successfully!
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
      </button>
    </div>';
    }
        else {
          echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
           <strong>Error!</strong> We are facing some technical issues and Your entry has not been submitted successfully!
           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">×</span>
           </button>
        </div>';
       }

    }

  }

?> 



  
  <div class="wrapper">
    <form action="">
      <h1>Login</h1>
      <div class="input-box">
        <input type="text" placeholder="Username" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <button type="submit" class="btn"><a href="dashboard.php" class="btn"> Login</a></button>
      
    </form>
  </div>
  
</body>
</html>




DASHBOARD CONNECTION /////////////////////////////////////


<?php
// Database connection
$hostname = "localhost:3307";
$dbuser = "root";
$dbPass = "";
$dbName = "girlshostel";
$conn = mysqli_connect($hostname, $dbuser, $dbPass, $dbName);
if (!$conn) {
    die("Connection was not successful: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sid = $_POST['username'];
    $s_password = $_POST['password'];

    // Perform SQL injection prevention
    $username = mysqli_real_escape_string($conn, $sid);
    $password = mysqli_real_escape_string($conn, $s_password);

    // Query to check credentials
    $sql = "SELECT * FROM hostellerprofile WHERE sid LIKE '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $storedHash = $row['s_password'];

            if (password_verify($password, $storedHash)) {
                // Password is correct, retrieve hosteller details
                $sid = $row['sid'];
                $sname = $row['sname'];
                $sage = $row['sage'];
                $saddress = $row['saddress'];
                $sphoneNo = $row['sphoneNo'];
                $sDOB = $row['sDOB'];
                $semail = $row['semail'];
                $joining_year = $row['joining_year'];
                $programme = $row['programme'];
                $aadhar_no = $row['aadhar_no'];

                // Display hosteller details
                echo "<p><strong>Student ID:</strong> $sid</p>";
                echo "<p><strong>Student Name:</strong> $sname</p>";
                echo "<p><strong>Student Age:</strong> $sage</p>";
                echo "<p><strong>Student Address:</strong> $saddress</p>";
                echo "<p><strong>Phone No:</strong> $sphoneNo</p>";
                echo "<p><strong>DOB:</strong> $sDOB</p>";
                echo "<p><strong>Email:</strong> $semail</p>";
                echo "<p><strong>Joining Year:</strong> $joining_year</p>";
                echo "<p><strong>Programme:</strong> $programme</p>";
                echo "<p><strong>Aadhar No:</strong> $aadhar_no</p>";
            } else {
                // User not found, handle error
                $error_message = "Invalid username or password";
            }
        }
    } else {
        // User not found, handle error
        $error_message = "Invalid username or password";
    }
}

// Close database connection
mysqli_close($conn);
?>



LOGINN.PHP FILE *//////////////////////////////////////////////////////////////////



<?php
session_start();

// Check if user is already logged in
if (isset($_SESSION['userID'])) {
    // Redirect to dashboard if already logged in
    header("Location: dashh.php");
    exit();
}

// Database connection
$hostname = "localhost:3307";
$dbuser = "root";
$dbPass = "";
$dbName = "girls";
$conn = mysqli_connect($hostname, $dbuser, $dbPass, $dbName);
if (!$conn) {
    die("Connection was not successful");
}

// Login form submission handling
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform SQL injection prevention
    $userID = mysqli_real_escape_string($conn, $username);
    $s_password = mysqli_real_escape_string($conn, $password);

    // Query to check credentials
    $sql = "SELECT * FROM students WHERE userID = '$userID' AND s_password = '$s_password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        // Credentials matched, set session and redirect to dashboard
        $_SESSION['userID'] = $userID;
        header("Location: dashh.php");
        exit();
    } else {
        // Credentials didn't match, show error message
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Girl's Hostel Management</title>
  <style>
    /* Your CSS styles */
  </style>
</head>
<body>

<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <h1>Login</h1>
      <?php if(isset($error_message)) { ?>
          <p style="color: red;"><?php echo $error_message; ?></p>
      <?php } ?>
      <div class="input-box">
        <input type="text" name="username" placeholder="UserID" required>
        <i class='bx bxs-user'></i>
      </div>
      <div class="input-box">
        <input type="password" name="password" placeholder="Password" required>
        <i class='bx bxs-lock-alt'></i>
      </div>
      <button type="submit" class="btn">Login</button>
    </form>
</div>

</body>
</html>


DASHH.PHP FILE ///////////////////////////////////////////////////////////////



<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: loginn.php");
    exit();
}

// Database connection
$hostname = "localhost:3307";
$dbuser = "root";
$dbPass = "";
$dbName = "girls";
$conn = mysqli_connect($hostname, $dbuser, $dbPass, $dbName);
if (!$conn) {
    die("Connection was not successful");
}

// Fetch student details based on logged-in user
$userID = $_SESSION['userID'];
$sql = "SELECT * FROM students WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $userID = $row['userID'];
    $name = $row['name'];
    $age = $row['age'];
    $address = $row['address'];
    $phoneNo = $row[ 'phoneNo'];
    $DOB = $row['DOB'];
    $email = $row['email'];
    $joining_yr = $row['joining_yr'];
    $programme = $row['programme'];
    $aadhar_no = $row['aadhar_no'];
    $s_password = $row['s_password'];
    // Add other fields as needed
} else {
    // User not found, handle error
    $error_message = "Student details not found";
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Dashboard</title>
  <style>
    /* Your CSS styles */
  </style>
</head>
<body>


<div class="wrapper">
    <h1>Welcome, <?php echo $userID; ?></h1>
    <p>Student ID: <?php echo $userID; ?></p>
    <p>Name: <?php echo $name; ?></p>
    <p>Age: <?php echo $age; ?></p>
    <p>Address: <?php echo $address; ?></p>
    <p>Phone No.: <?php echo $phoneNo; ?></p>
    <p>Date of Birth: <?php echo $DOB; ?></p>
    <p>Email: <?php echo $email; ?></p>
    <p>Joining Year: <?php echo $joining_yr; ?></p>
    <p>Programme: <?php echo $programme; ?></p>
    <p>Aadhar No.: <?php echo $aadhar_no; ?></p>
    <!-- Display other student details here -->

  <!--  <a href="logout.php">Logout</a>  Assuming you have a logout page -->
</div>

</body>
</html>




MESS.PHP///////////////////////////////////////////////////////////////////////////


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mess Details</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('mess.jpeg');
      background-size: cover;
      background-position: center;
      border: 0px solid #1a0101; /* Added a border with a color */
      background-repeat: no-repeat;
       /* Prevents the background image from repeating */
    }

    .container {
      padding: 1vw; /* Padding as a percentage of viewport width */
    }

    .mess-allotment {
      margin: 2vw auto; /* Margin as a percentage of viewport width */
      padding: 2vw;
      background-color: rgba(108, 106, 106, 0.8); /* Adjust the background color opacity as needed */
      border-radius: 5px;
      border-color: #1a0101;
      max-width: 90%; /* Maximum width as a percentage of viewport width */
    }

    .mess-allotment h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2vw;
      border: 5px solid #070707;
    }

    table th,
    table td {
      border: 5px solid #070707;
      padding: 1vw; /* Padding as a percentage of viewport width */
      text-align: left;
      font-size: 30px; /* Adjust the font size as needed */
    }

    table th {
      background-color: #7a7474;
    }

    table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    @media screen and (max-width: 768px) {
      .container {
        padding: 5vw;
      }

      .mess-allotment {
        padding: 5vw;
        max-width: 100%; /* Take full width on smaller screens */
      }

      .mess-allotment h1 {
        font-size: 1.5em;
      }

      table {
        font-size: 0.8em;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="mess-allotment">
      <h1>Mess Details</h1>
      <table>
        <thead>
          <tr>
            <th>Mess ID</th>
            <th>Mess Fee</th>
            <th>Paid or Not</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>M001</td>
            <td>$100</td>
            <td>Yes</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>




and     /////////////////////////



<?php
session_start();

if (!isset($_SESSION['userID'])) {
    // Redirect to login page if not logged in
    header("Location: loginn.php");
    exit();
}

// Database connection
$hostname = "localhost"; // Change to your database hostname
$dbuser = "root"; // Change to your database username
$dbPass = ""; // Change to your database password
$dbName = "girls"; // Change to your database name

$conn = mysqli_connect($hostname, $dbuser, $dbPass, $dbName);
if (!$conn) {
    die("Connection was not successful");
}

// Fetch mess details for the logged-in student
$sql_mess = "SELECT * FROM mess WHERE userID = '$userID'";
$result_mess = mysqli_query($conn, $sql_mess);

if (mysqli_num_rows($result_mess) == 1) {
    $row_mess = mysqli_fetch_assoc($result_mess);
    // Retrieve mess details
    $messID = $row_mess['messID'];
    $messFee = $row_mess['messFee'];
    $paidStatus = $row_mess['paidStatus'];
} else {
    // Mess details not found for the student
    $error_message = "Mess details not found";
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mess Details</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('mess.jpeg');
      background-size: cover;
      background-position: center;
      border: 0px solid #1a0101; /* Added a border with a color */
      background-repeat: no-repeat;
       /* Prevents the background image from repeating */
    }

    .container {
      padding: 1vw; /* Padding as a percentage of viewport width */
    }

    .mess-allotment {
      margin: 2vw auto; /* Margin as a percentage of viewport width */
      padding: 2vw;
      background-color: rgba(108, 106, 106, 0.8); /* Adjust the background color opacity as needed */
      border-radius: 5px;
      border-color: #1a0101;
      max-width: 90%; /* Maximum width as a percentage of viewport width */
    }

    .mess-allotment h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 2vw;
      border: 5px solid #070707;
    }

    table th,
    table td {
      border: 5px solid #070707;
      padding: 1vw; /* Padding as a percentage of viewport width */
      text-align: left;
      font-size: 30px; /* Adjust the font size as needed */
    }

    table th {
      background-color: #7a7474;
    }

    table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    @media screen and (max-width: 768px) {
      .container {
        padding: 5vw;
      }

      .mess-allotment {
        padding: 5vw;
        max-width: 100%; /* Take full width on smaller screens */
      }

      .mess-allotment h1 {
        font-size: 1.5em;
      }

      table {
        font-size: 0.8em;
      }
    }

  </style>
</head>
<body>


<div class="container">
    <div class="mess-allotment">
            <h3>Mess Details</h3>
            <p>Mess ID: <?php echo $messID; ?></p>
            <p>Mess Fee: <?php echo $messFee; ?></p>
            <p>Paid Status: <?php echo $paidStatus; ?></p>
    </div>
</div>

</body>
</html>





laundary services ///////////////////////////////////////////////////////////



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laundry Services</title>
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-image: url('laundry.jpeg');
      background-size: 100% 350%; /* Ensure the background image covers the entire background */
    }

    .container {
      max-width: 1500px;
      margin: 10 auto;
      padding: 0 20px;
    }

    .laundry-services {
      margin-top: 20px;
      padding: 20px;
      background-color: #f9f9f9;
      border-radius: 5px;
    }

    .laundry-services h1 {
      text-align: center;
      margin-top: 0;
      color: #2b0606;
    }

    table {
      width: 100%;
      height: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      border: 5px solid #000; /* Adding border to the table */
    }

    table th,
    table td {
      border: 1px solid #ddd;
      padding: 12px; /* Increase padding for better spacing */
      text-align: left;
    }

    table th {
      background-color: #26a1da;
    }

    table tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    @media screen and (max-width: 768px) {
      .laundry-services {
        padding: 10px;
      }

      .laundry-services h1 {
        font-size: 1.5em;
      }

      table {
        font-size: 1.0em;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="laundry-services">
      <h1>Laundry Services Records</h1>
      <table>
        <thead>
          <tr>
            <th>S_ID</th>
            <th>EMP_ID</th>
            <th>Amount of Clothes</th>
            <th>Visiting Day</th>
            <th>Returning Day</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>S1234</td>
            <td>E001</td>
            <td>5</td>
            <td>Monday</td>
            <td>Thursday</td>
          </tr>
          <!-- Add more rows as needed -->
        </tbody>
      </table>
    </div>
  </div>
</body>
</html>




room/////////////////////////////////////////////////////////////////////


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Room Details</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('roomimage.jpeg'); /* Add your background image URL here */
            background-size: cover;
            background-position: center;
        }
        
        .room-details {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(196, 186, 186, 0.8); /* Adjust the background color and opacity */
            border-radius: 5px;
            border-color: black;
        }
        
        .room-details h1 {
            text-align: center;
            font-size: 35px; /* Adjust the font size as needed */
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        table th,
        table td {
            border: 5px solid #101010;
            padding: 8px;
            text-align: left;
            font-size: large;
        }
        
        table th {
            background-color: #efe8e8;
            font-size: large;
        }
        
        table tbody tr:nth-child(even) {
            background-color: #8a8080;
            font-size: large;
        }
    </style>
</head>
<body>
    <div class="room-details">
        <h1>Room Details</h1>
        <table>
            <thead>
                <tr>
                    <th>Room Number</th>
                    <th>Floor</th>
                    <th>Room Type</th>
                    <th>Room Service Day</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>101</td>
                    <td>1</td>
                    <td>Single</td>
                    <td>Monday</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>
    </div>
</body>
</html>  



laundaryupdate ///////////////////////////////////////////////////////////////////////////



<?php
$servername ="localhost:3307";
$username = "root";
$password = "";
$Database = "girls";
$conn = mysqli_connect($servername, $username, $password, $Database );  

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
else{
    echo "<br>Connected successfully<br>"; 
}

// Check if userID parameter is passed
if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Fetch student details from database
    $sql_l = "SELECT * FROM laundary_service WHERE userID = $userID";
    $result_l = $conn->query($sql_l);

    if ($result_l->num_rows > 0) {
        // Display update form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_POST['userID'];
            $cloth_no = $_POST['cloth_no'];
            
            

            // Update student details in the database
            $update_sql_l = "UPDATE laundary_service SET cloth_no='$cloth_no'  WHERE userID='$userID'";

            if ($conn->query($update_sql_l) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $row = $result_l->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update laundary Details</title>
</head>
<body>
    <h1>Update Student Details</h1>
    <form action="" method="post">
        <input type="hidden" name="userID" value="<?php echo $row['userID']; ?>">
        Cloth_no.: <input type="text" name="cloth_no" value="<?php echo $row['cloth_no']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
    } else {
        echo "$userID has not taken Laundry Service";
    }
} else {
    // If userID parameter is missing, redirect to a page where userID can be selected or inputted
    header("Location: select_user.php");
}
$conn->close();
?>


////////////////////////////////////////////laundaryinsert


<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Add form to insert laundry service details
    echo "<h1>Add Laundry Service for User ID: $userID</h1>";
    echo "<form action='' method='post'>
              <input type='hidden' name='userID' value='$userID'>
              Emp ID: <input type=text' name='eid' <br>
              Cloth_no.: <input type='text' name='cloth_no'><br>
              Visiting Day: <input type=text' name='visiting_day' <br>
              Returning Day: <input type='text' name='returning_day'><br>
          </form>";

    // Insert laundry service details into the database
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $database = "girls";
        $conn = mysqli_connect($servername, $username, $password, $database);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $userID = $_POST['userID'];
        $cloth_no = $_POST['cloth_no'];

        $insert_sql_l = "INSERT INTO laundary_service (userID, eid,cloth_no,visiting_day,returning_day) VALUES ('$userID', '$eid','$cloth_no','$visiting_day,'returning_day')";

        if ($conn->query($insert_sql_l) === TRUE) {
            echo "Laundry service added successfully";
        } else {
            echo "Error adding laundry service: " . $conn->error;
        }

        $conn->close();
    }
} else {
    echo "Invalid request";
}
?>



medicalupdate//////////////////////////////////////////////////////////////////////////////////////////////

<?php
$servername ="localhost:3307";
$username = "root";
$password = "";
$Database = "girls";
$conn = mysqli_connect($servername, $username, $password, $Database );  

if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
else{
    echo "<br>Connected successfully<br>"; 
}

// Check if userID parameter is passed
if(isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Fetch student details from database
    $sql_m = "SELECT p.pid, p.mid, m.m_name, p.dates, p.quantity
              FROM medical_kit m
              JOIN possess p ON p.mid = m.mid
              WHERE p.userID = $userID";
    $result_m = $conn->query($sql_m);

    if ($result_m->num_rows > 0) {
        // Display update form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_POST['userID'];
            $pid = $_POST['pid'];
            $mid = $_POST['mid'];
            $dates = $_POST['dates'];
            $quantity = $_POST['quantity'];
            
            // Update student details in the database
            $update_sql_m = "INSERT INTO possess(userID, dates, mid, quantity) VALUES ('$userID','$dates','$mid','$quantity')";
            $conn->query($update_sql_m);

            // Reduce stock quantity
            $reduce_sql = "UPDATE medical_kit SET stock_quantity = stock_quantity - $quantity WHERE mid = $mid";
            $conn->query($reduce_sql);

            echo "Record updated successfully";
        }

        $row = $result_m->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Medical Details</title>
</head>
<body>
    <h1>Update Student Details</h1>
    <form action="" method="post">
        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
        Medicine ID: <input type="text" name="mid" value="<?php echo $row['mid']; ?>"><br>
        Quantity: <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"><br>
        Medicine taken on Date: <input type="date" name="dates" value="<?php echo $row['dates']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
    } else {
        echo "No student found with ID: $userID";
    }
} else {
    // If userID parameter is missing, redirect to a page where userID can be selected or inputted
    header("Location: select_user.php");
}
$conn->close();
?>




medicalupdate////////////////////////////////////////////////////////////////////////////////////////////




<?php
$servername = "localhost:3307";
$username = "root";
$password = "";
$database = "girls";
$conn = mysqli_connect($servername, $username, $password, $database);  

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "<br>Connected successfully<br>"; 
}

// Check if userID parameter is passed
if (isset($_GET['userID'])) {
    $userID = $_GET['userID'];

    // Check if the user ID exists in the laundary_service table
    $check_sql = "SELECT * FROM possess WHERE userID = $userID";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // Display update form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $userID = $_POST['userID'];
            $cloth_no = $_POST['cloth_no'];

            $insert_sql_med = "INSERT INTO possess ( userID,dates, mid, quantity) 
                     VALUES ('$userID', '$dates','$mid', '$quantity',)";






            if ($conn->query($update_sql) === TRUE) {
                echo "Record updated successfully";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        }

        $row = $check_result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Medical Details</title>
</head>
<body>
    <h1>Update Medical Details for User ID: <?php echo $userID; ?></h1>
    <form action="" method="post">
        <input type="hidden" name="userID" value="<?php echo $row['userID']; ?>">
        Medicalkit ID: <input type="text" name="mid" value="<?php echo $row['mid']; ?>"><br>
        Issued on date: <input type="text" name="dates" value="<?php echo $row['dates']; ?>"><br>
        Quantity: <input type="text" name="quantity" value="<?php echo $row['quantity']; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
<?php
    } else {
        echo "User ID $userID has not taken Laundry Service";
    }
}

// If the user ID doesn't exist in the laundary_service table, display insert form
if ($check_result->num_rows == 0) {
?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert Medical Record</title>
</head>
<body>
    <h1>Insert Medical Record for User ID: <?php echo $userID; ?></h1>
    <form action="medicalinsert.php" method="post">
        <input type="hidden" name="userID" value="<?php echo $userID; ?>">
       Medicalkit ID: <input type="text" name="mid"><br>
        Issued on date: <input type="text" name="dates"><br>
        Quantity: <input type="text" name="quantity"><br>
        <input type="submit" value="Insert">
    </form>
</body>
</html>
<?php
}

$conn->close();
?>





register//////////////////////////////////////////////////////////////////////////////






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('rimage.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center; /* Center the background image */
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 100px auto;
            background-color: rgba(235, 221, 221, 0.8);
            padding: 20px;
            border-radius: 10px;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="email"],
        input[type="tel"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #514e4e;
            border-radius: 5px;
        }
        input[type="date"] {
            width: calc(100% - 22px); /* Adjust for date input arrow */
            padding: 10px;
            border: 1px solid #554848;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #0d1f32;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            margin-bottom: 10px; /* Add some space between buttons */
        }
        button:hover {
            background-color: #b6c9de;
        }
        .warning {
            color: red;
            font-size: 0.8em;
        }
    </style>
</head>
<body>
<div class="navbar">
    <!-- Move the logout button to the right -->
    <h3>
        <button onclick="update()" style="position: absolute; top: 20px; right: 20px; width:100px; padding:10px; background-color: #CBC3E3; color:black; ">Update</button>
        <button onclick="viewAllData()" style="position: absolute; top: 20px; right: 140px; width:100px; padding:10px; background-color: #CBC3E3; color:black; ">View All Data</button>
    </h3>
</div>
<div class="container">
    <h2>Registration Form</h2>
    <form action="#" method="POST" id="registrationForm" onsubmit="return validateForm()">
        <div class="form-group">
            <label for="userID">Student ID:</label>
            <input type="text" id="userID" name="userID" required />
        </div>
        <div class="form-group">
            <label for="name">Student Name:</label>
            <input type="text" id="name" name="name" required />
        </div>
        <div class="form-group">
            <label for="age">Student Age:</label>
            <input type="number" id="age" name="age" required />
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required />
        </div>
        <div class="form-group">
            <label for="phoneNo">Phone Number:</label>
            <input type="tel" id="phoneNo" name="phoneNo" required />
            <span id="phoneWarning" class="warning"></span>
        </div>
        <div class="form-group">
            <label for="DOB">Date of Birth:</label>
            <input type="date" id="DOB" name="DOB" required />
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required />
        </div>
        <div class="form-group">
            <label for="joining_yr">Joining Year:</label>
            <input type="text" id="joining_yr" name="joining_yr" required />
        </div>
        <div class="form-group">
            <label for="programme">Programme:</label>
            <select id="programme" name="programme" required>
                <option value="">Select Programme</option>
                <option value="B.Tech">B.Tech</option>
                <option value="M.Tech">M.Tech</option>
                <option value="Ph.D">Ph.D</option>
            </select>
        </div>
        <div class="form-group">
            <label for="aadhar_no">Aadhar Number:</label>
            <input type="text" id="aadhar_no" name="aadhar_no" required />
            <span id="aadharWarning" class="warning"></span>
        </div>
        <div class="form-group">
            <label for="s_password">Create Password:</label>
            <input type="password" id="s_password" name="s_password" required />
        </div>
        <button type="submit" class="btn">Submit</button>
    </form>
</div>
<script>
function update() {
    // Redirect to login.php
    window.location.href = "profileupdate.php";
}

function viewAllData() {
    // Redirect to alldata.php
    window.location.href = "alldata.php";
}

function validateForm() {
    var phoneNo = document.getElementById("phoneNo").value;
    var aadharNo = document.getElementById("aadhar_no").value;

    // Validate Phone Number
    if (phoneNo.length !== 10) {
        document.getElementById("phoneWarning").innerText = "Phone number should be 10 digits.";
        return false;
    } else {
        document.getElementById("phoneWarning").innerText = "";
    }

    // Validate Aadhar Number
    if (aadharNo.length !== 12) {
        document.getElementById("aadharWarning").innerText = "Aadhar number should be 12 digits.";
        return false;
    } else {
        document.getElementById("aadharWarning").innerText = "";
    }

    return true;
}
</script>
</body>
</html>