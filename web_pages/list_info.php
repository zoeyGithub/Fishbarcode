<?php
require("database.php");

$ID=$_POST["ID"];

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

$sql1 = " SELECT DISTINCT info.NCBI_ID,info.Tax_ID,info.Family_ID,info.S_Name,seq.L,seq.R,info.Uniq FROM info INNER JOIN seq ON info.NCBI_ID=seq.NCBI_ID WHERE info.NCBI_ID=\"$ID\" ";
$result1 = $conn->query($sql1);
 
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom">
    <h1 name="result">Species Info</h1>
</div>


<table class="table table-striped table-sm">
	<thead>
		<tr>
			<th>NCBI ID</th>
			<th>Taxonomy ID</th>
			<th>Family ID</th>
			<th>Scientific Name</th>
			<th>Common Name</th>
			<th>Left Primer</th>
			<th>Right Primer</th>
			<th>Stage</th>
		</tr>
	</thead>
	<tbody>
	<?PHP
	while($row1 = $result1->fetch_assoc())
	{
	  	echo "<tr>
	  			<td>".$row1['NCBI_ID']."</td>
	  			<td>".$row1['Tax_ID']."</td>
	  			<td>".$row1['Family_ID']."</td>
	  			<td>".$row1['S_Name']."</td>";

				$sql2 = "SELECT C_Name From info WHERE `NCBI_ID`=\"".$row1['NCBI_ID']."\"";
	  			$result2 = $conn->query($sql2);
	  			$arr=array();
	  			while($C_Name = $result2->fetch_assoc()){
	  				$arr[]=$C_Name['C_Name'];
	  			}
	  			$ans = implode(",<br>",$arr);
	  			echo "<td>".$ans."</td>";

	   	echo	"<td>".$row1['L']."</td>
	  			<td>".$row1['R']."</td>";
	  	if($row1['Uniq']==1)
        	echo "<th style='color:#475D7D;'>First</th>
        </tr>";
      	else
        	echo "<th style='color:#C25954;'>Second</th>
        </tr>";
	}

	$conn->close()	;
	?>
	</tbody>
</table>