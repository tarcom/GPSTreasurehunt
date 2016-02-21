<?php

//$servername = "mysql06.cliche.dk";
//$username = "aogj.com";
//$password = "hu69bypv";
//$dbname = "aogj_com";

$servername = "192.168.0.92";
$username = "root";
$password = "";
$dbname = "treasurehunt";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_GET['name'];
$hint = $_GET['hint'];
$lat = $_GET['lat'];
$lon = $_GET['lon'];
$accuracy = $_GET['accuracy'];
$imageUrl = $_GET['imageUrl'];

//echo "<br>example to use this service: <b>http://aogj.com/geo/savePosition.php?name=tester&hint=fester&lat=3.456&lon=4.567&accuracy=12&imageUrl=testerogfester</b><br>";
echo "<br>example to use this service: <b>http://192.168.0.92/geo/savePosition.php?name=tester&hint=fester&lat=3.456&lon=4.567&accuracy=12&imageUrl=testerogfester</b><br>";
echo "<br>you are submitting: name=$name, hint=$hint, lat=$lat, lon=$lon, accuracy=$accuracy, imageUrl=$imageUrl<br>";

$sql = "INSERT INTO treasures (name, hint, lat, lon, accuracy, imageUrl) VALUES ('$name', '$hint', $lat, $lon, $accuracy, '$imageUrl')";

echo "<br>sql=$sql<br>";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>