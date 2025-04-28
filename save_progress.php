<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "fitquest2";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect POST data
$date = $_POST['date'];
$weight = $_POST['weight'];
$workout_time = $_POST['workout_time'];
$calories = $_POST['calories'];
$mood = $_POST['mood'];
$notes = $_POST['notes'];

// Prepare SQL with placeholders
$sql = "INSERT INTO progress (date, weight, workout_time, calories, mood, notes) 
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

// Bind parameters: 
// s = string, d = double (or float), i = integer
$stmt->bind_param("sddiss", $date, $weight, $workout_time, $calories, $mood, $notes);

// Execute statement
$stmt->execute();

// Clean up
$stmt->close();
$conn->close();

// Redirect
header("Location: progress_tracker.php");
exit();
?>
