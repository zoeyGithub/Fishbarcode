<?php
require("database.php");

$Fish=$_POST["Search"];

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//echo "Connected successfully";

//$sql = "SELECT DISTINCT NCBI_ID FROM `info` WHERE S_Name LIKE '%".$Fish."%' OR C_Name LIKE '%".$Fish."%'";
$sql = " SELECT info.NCBI_ID,info.Tax_ID,info.Family_ID,info.S_Name,info.C_Name,seq.L,seq.R,info.Uniq FROM info INNER JOIN seq ON info.NCBI_ID=seq.NCBI_ID WHERE NCBI_ID=\"$ID\" ";
$result = $conn->query($sql);
?>



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom">
    <h1 name="result">Result</h1>
    <div class="btn-toolbar mb-2 mb-6 md-0">
        <button type="button" class="btn btn-sm btn-outline-secondary" >Download</button>
    </div>
</div>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h3>Search Name:
    <?php 
    	echo $Fish;
    ?>
    </h3>

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
			<th>Uniq</th>
		</tr>
	</thead>
	<tbody>
	<?PHP
	while($row = $result->fetch_assoc())
	{

		
	  	echo "<tr>
	  			<td><a href=\"list_seq_index.php?new=".$row['NCBI_ID']."\">".$row['NCBI_ID']."</a></td>
	  			<td>".$row['Tax_ID']."</td>
	  			<td>".$row['Family_ID']."</td>
	  			<td>".$row['S_Name']."</td>
	  			<td>".$row['C_Name']."</td>
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