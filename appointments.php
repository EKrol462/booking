<?php 
ob_start();
?>

<html>
<head>
<title>Siskin Booking</title>

</head>
<body>
    
<?php    
//DB connection
$servername = "localhost";
$dbusername = "studeage_admin";
$dbpassword = "admin";
$databasename = "studeage_booking"; 
    
$conn = new mysqli($servername, $dbusername, $dbpassword,$databasename);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    } else {
        echo "Connected!";
}

//Select table
$sql = "SELECT bookingId, fname, lname, date, phone, type, message FROM bookings ORDER BY date";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    
    echo "<table border='1'>

<tr>

<th>Id</th>
<th>First Name</th>
<th>Last Name</th>
<th>Date</th>
<th>Phone Number</th>
<th>Treatment</th>
<th>Message</th>

</tr>";
    
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
     
     echo "<tr>";
     echo "<td>" . $row['bookingId'] . "</td>";
     echo "<td>" . $row['fname'] . "</td>";
     echo "<td>" . $row['lname'] . "</td>";
     echo "<td>" . $row['date'] . "</td>";
     echo "<td>" . $row['phone'] . "</td>";
     echo "<td>" . $row['type'] . "</td>";
     echo "<td>" . $row['message'] . "</td>";
  }
  echo "</table>";
  
} else {
  echo "0 results";
}

mysqli_close($conn);
?>




</body>
</html>

<?php
ob_end_flush();
?>    