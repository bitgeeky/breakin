<?php
include("header.php");
include_once("cleaner.php");

$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");
// Check connection

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$jteam =    sanitize($con,$_POST['cteam']);
$pphrase =  sanitize($con,$_POST['pphrase']);
$tourl = $_POST['purl'];

$teamname = (string)trim($jteam);
$pphrase = (string)trim($pphrase);


//Empty Condition
if(strlen($teamname)==0 || strlen($pphrase)==0){
		//return with error code
		if((strpos($tourl,'err') !== false)){
			header('Location: '.$tourl);
		}
		else{
			header('Location: '.$tourl."?err=1");
		}
		return;
}

	$result = mysqli_query($con,"SELECT * FROM teaminfo");
	$exists = 0;
	$unique = 1;	
	while($row = mysqli_fetch_array($result))
                {
                	if(!strcmp($row['name'],$jteam)){
				
				$exists = 1;
				break;
			}
		
		}
	$result = mysqli_query($con,"SELECT * FROM teaminfo");
	while($iter = mysqli_fetch_array($result))
                {
                	if(!strcmp($iter['phrase'],$pphrase)){
				
				$unique = 0;
				break;
			}
		
		}
	if((!$exists)&&($unique)){
		
		//insert new team
		mysqli_query($con,"INSERT INTO teaminfo (name, phrase, admin) VALUES ('". $teamname ."', '". $pphrase ."','". $user ."')");	
		mysqli_query($con,"INSERT INTO userteam (username, teamname) VALUES ('". $user ."', '". $teamname ."')");	
		header('Location: '."http://felicity.iiit.ac.in/threads/breakin/main.php");
		return;
	}
	else{
		
		//return with error code
		if((strpos($tourl,'err') !== false)){
			header('Location: '.$tourl);
		}
		else{
			header('Location: '.$tourl."?err=1");
		}	
	}

?>
