<?php
require("database.php");

$ID=$_POST["fishName"];

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$sql = "SELECT info.Family_ID,info.Tax_ID,info.NCBI_ID,info.S_Name,info.C_Name,seq.L,seq.R,info.Uniq FROM info INNER JOIN seq ON info.NCBI_ID=seq.NCBI_ID WHERE Family_ID=(SELECT Family_ID FROM info WHERE ID='$ID')";

$result = $conn->query($sql);
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3" id="family">
</div>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 mb-3">
	<h3>Family</h3>
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