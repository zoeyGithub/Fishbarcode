<?php
require("database.php");

$ID=$_POST["ID"];

// Create connection
$conn = new mysqli($servername, $username, $password,$db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = " SELECT * FROM `seq` WHERE NCBI_ID=\"$ID\" ";
$result = $conn->query($sql);

?>

<head><link rel="stylesheet" href="css/tooltips.css"></head>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 border-bottom">
    <h1 name="result">Sequence Info</h1>
</div>


<?php
function reverse($str){
    $rev=str_split(strrev($str));
    $result="";
    foreach ($rev as $key) {
        if($key=="A"){
            $result.="T";
        }
        if($key=="T"){
            $result.="A";
        }
        if($key=="G"){
            $result.="C";
        }
        if($key=="C"){
            $result.="G";
        }
    }
    return $result;

}

function hilight($text, $L, $R, $COI){
   $R = reverse($R);
   $text = str_ireplace($L,'<b class="l_primer">'.$L.'</b>',$text);
   $text = str_ireplace($R,'<b class="r_primer">'.$R.'</b>',$text);
   $text = str_ireplace($COI,'<b class="coi">'.$COI.'</b>',$text);
  return $text;
}


while($row = $result->fetch_assoc())
{
	$output=hilight($row['Seq'], $row['L'], $row['R'], $row['COI']);
	echo "<div style=\"width:100%;height:50%;word-break:break-word\">".$output."</;div>";
}

$conn->close();
?>
<br>