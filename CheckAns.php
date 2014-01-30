<?php
include_once('cleaner.php');
include_once('header.php');

$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");

if (mysqli_connect_errno())
{
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$tourl = $_POST['purl'];	
$qno    = sanitize($con,$_POST['qno']);	
$qcat   = sanitize($con,$_POST['qcat']);
$uans   = sanitize($con,$_POST['uans']);
$uname  = sanitize($con,$_POST['uname']);

$result = mysqli_query($con,"SELECT * FROM ques WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");
$newres = mysqli_query($con,"SELECT * FROM solved");
$exists = 0;
while($srow = mysqli_fetch_array($newres))
                {
                        if(((int)$srow['qcat']==(int)$qcat)&&((int)$srow['qnum']==(int)$qno)&&(!strcmp($uname,$srow['username']))){
            			$exists = 1;            	
			}
                }


$row = mysqli_fetch_array($result);
$trimmed = trim($row['ans']);
$origans = $trimmed;
$uans = trim($uans);

if(!strcmp($uans,$origans)&&(strlen($uans)>0)&&(!$exists)){
	//correct ans
mysqli_query($con,"INSERT INTO solved (username, qcat, qnum) VALUES ('". $uname ."', '". (int)$qcat ."', '". (int)$qno ."')");	
header('Location: '.$tourl."&qcode=1");
}
else{
if((strpos($tourl,'qcode') !== false)||(strlen($uans)==0)){
header('Location: '.$tourl);
}
else{
header('Location: '.$tourl."&qcode=0");
}
}
?>
