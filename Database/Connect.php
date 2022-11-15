<?php
$con = new mysqli("localhost", "root", "", "webtruyen_anime");
$on_event = mysqli_query($con, 'SET GLOBAL event_scheduler = ON;');
// Check connection
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
