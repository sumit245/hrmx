<?php
$mysqli = new mysqli("127.0.0.1", "root", "", "hrmx");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}

echo "Attempting to insert a new designation...\n";
$sql = "INSERT INTO xin_designations (department_id, sub_department_id, company_id, designation_name, added_by, created_at) VALUES (1, 1, 1, 'Test Designation " . time() . "', 1, '18-02-2026')";

if ($mysqli->query($sql) === TRUE) {
    echo "New record created successfully. ID: " . $mysqli->insert_id . "\n";
} else {
    echo "Error: " . $sql . "\n" . $mysqli->error . "\n";
}

$mysqli->close();
?>