<!DOCTYPE html>
<head></head>
<body>
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

$str="ATGCCCCC";
echo $str."<br>";
$str=reverse($str);
echo $str;
?>
</body>