<?php
require("database.php");

$ID=$_POST["fishID"];

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$sql = "SELECT * FROM coi_seq WHERE ID='$ID'";
$result = $conn->query($sql);
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom">
    <h1 name="result">Result</h1>
    <div class="btn-toolbar mb-2 mb-6 md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary" >Download</button>
    </div>
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3" id="coi">
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>COI Secquence</h3>
</div>

<?php
while($row = $result->fetch_assoc())
{
  	echo "<h6 style='word-break:break-all;word-wrap:break-word;'>".$row['COI']."</h6>";
}

$conn->close()	;
?>