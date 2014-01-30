<?php
$tourl = $_POST['purl'];	
$qno = $_POST['qno'];	
$qcat = $_POST['qcat'];
$cval = $_POST['cval'];
$uname = $_POST['uname'];

$trimval = trim($cval);
if(strlen($trimval)>0){
$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");
// Check connection
if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

mysqli_query($con,"INSERT INTO comments (username, qcat, qnum, cdes) VALUES ('". $uname ."', '". (int)$qcat ."', '". (int)$qno ."', '". $cval ."')");	
}
header('Location: '.$tourl);
?>
