<?php
$tourl = $_POST['purl'];	
$qno = $_POST['qno'];	
$qcat = $_POST['qcat'];
$uans = $_POST['uans'];
$uname = $_POST['uname'];

$con=mysqli_connect("localhost","root","iiit123","breakin");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM ques WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");

$row = mysqli_fetch_array($result);
$trimmed = trim($row['ans']);
$origans = strtolower($trimmed);
$uans = trim($uans);
$uans = strtolower($uans);
if(!strcmp($uans,$origans)){
	//correct ans
mysqli_query($con,"INSERT INTO solved (username, qcat, qnum) VALUES ('". $uname ."', '". (int)$qcat ."', '". (int)$qno ."')");	
header('Location: '.$tourl."&qcode=1");
}
else{
header('Location: '.$tourl."&qcode=0");
}
echo $row['ans']; 
echo $trimmed;
?>
