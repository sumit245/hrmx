<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "hrmx";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the table exists
$sql = "DESCRIBE xin_hrsale_module_attributes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "Field: " . $row["Field"] . " - Type: " . $row["Type"] . " - Extra: " . $row["Extra"] . "\n";
    }
} else {
    echo "0 results";
}
$conn->close();
?>