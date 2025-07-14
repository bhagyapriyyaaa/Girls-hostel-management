<?php
$servername = "localhost:3308";
$username = "root";
$password = "";
$database = "girls";
$conn = mysqli_connect($servername, $username, $password, $database);  

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "<br>Connected successfully<br>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userID = $_POST['userID']; 
    $dates = $_POST['dates']; 
    $mid = $_POST['mid'];
    $quantity = $_POST['quantity'];

    $insert_sql_med = "INSERT INTO possess (userID, dates, mid, quantity) 
                     VALUES ('$userID', '$dates', '$mid', '$quantity')";

    if ($conn->query($insert_sql_med) === TRUE) {
        echo "Medical Record added successfully";
    } else {
        echo "Error adding medical record: " . $conn->error;
    }
}

$conn->close();
?>

