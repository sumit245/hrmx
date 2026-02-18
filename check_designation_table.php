<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "hrmx");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "Checking designation_id column:\n";
$result = $mysqli->query("DESCRIBE xin_designations");
while ($row = $result->fetch_assoc()) {
    if ($row['Field'] == 'designation_id') {
        print_r($row);
    }
}

echo "\nChecking recent entries:\n";
$result = $mysqli->query("SELECT designation_id, designation_name FROM xin_designations ORDER BY designation_id DESC LIMIT 5");
while ($row = $result->fetch_assoc()) {
    print_r($row);
}

$mysqli->close();
?>