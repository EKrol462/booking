<?php 
ob_start();
?>

<html>
<head>
<title>Siskin Booking</title>


</head>
<body>
    

    
<!-- TODO ADD VALIDATION -->
<!-- TODO ADD SIZE -->
<!-- TODO Add address -->
<!-- TODO add send email --> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
 <label for ="fname">First Name:</label><br>
 <input type="text" id="fname" name="fname" size="50"><br>
 <label for="lname">Last name:</label><br>
 <input type="text" id="lname" name="lname"><br>
 <label for="date">Date:</label><br>
 <input type="date" min="2050-01-01" id="id" name="date" onfocus="this.min=new Date().toISOString().split('T')[0]" /><br>
 <label for="phone">Phone Number:</label><br>
 <input type="tel" id="phone" name="phone"><br>
 <label for="treatment">Choose Treatment Type:</label><br>
 <select name="treatment" id="treatment">
     <option value="1">Botox 1</option>
     <option value="2">Botox 2</option>
     <option value="3">Botox 3</option>
 </select><br>
 <label for="message">Message:</label><br>
 <input type="text" id="message" name="message"><br>
 <input type="submit" name="submit" value="Submit">
</form>

<?php
//Set variables
$fname = $lname = $date = $phone = $treatment = $message ="";

// function to clear userinputs
function clearUserInputs($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
} 


//POST method
if(isset($_POST["submit"])){ //allows for sending of information if the Server request method is POST

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
//Add data
$fname = clearUserInputs($_POST["fname"]); //Asign values from forms to php variables
$lname = clearUserInputs($_POST["lname"]);
$date = clearUserInputs($_POST["date"]);
$phone = clearUserInputs($_POST["phone"]);
$treatment = clearUserInputs($_POST["treatment"]);
$message = clearUserInputs($_POST["message"]);

try {
        $conn = new PDO("mysql:host=$servername;dbname=$databasename",
                          $dbusername, $dbpassword);
  //set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    // prepare sql and bind parameters
    $stmt = $conn->prepare("INSERT INTO bookings (fname, lname, date, phone, type, message)
    VALUES (:fname, :lname, :date, :phone, :type, :message)");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':type', $treatment);
    $stmt->bindParam(':message', $message);
    $stmt->execute();
    
    echo "booking added!";
    
    // Send
    $message = "Hello World!";
    mail('eryklkrol@gmail.com', 'My Subject', $message);
    
    }  
    catch(PDOException $e)
    {
        echo $e;
    }
  $conn = null;  


}//end post if
?>



</body>



</html>

<?php
ob_end_flush();
?>