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

$sql = "SELECT * FROM fish_primer WHERE ID='$ID'";
$result = $conn->query($sql);
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3" id="primer">
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3">
    <h3>Primer</h3>
</div>
<table class="table table-striped table-sm">
	<thead>
		<tr>
			<th>Family ID</th>
			<th>NCBI ID</th>
			<th>Fish Name</th>
			<th>Left Primer</th>
			<th>Right Primer</th>
			<th>Uniq</th>
		</tr>
	</thead>
	<tbody>
	<?PHP
	while($row = $result->fetch_assoc())
	{
	  	echo "<tr>
	  			<td>".$row['Family']."</td>
	  			<td>".$row['ID']."</td>
	  			<td>".$row['Name']."</td>
	  			<td>".$row['L']."</td>
	  			<td>".$row['R']."</td>";
	  	if($row['Uniq']==1)
	  		echo "<td>Yes</td>
	  		</tr>";
	  	else
	  		echo "<td style='color:red;'>No</td>
	  		</tr>";
	}

	$conn->close()	;
	?>
	</tbody>
</table>