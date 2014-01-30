<?php
include_once('cleaner.php');
include("header.php");

$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");
// Check connection

if (mysqli_connect_errno())
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$jteam = sanitize($con,$_POST['jteam']);
$tourl = $_POST['purl'];

$pphrase = (string)trim($jteam);


//Empty Condition
if(strlen($pphrase)==0){
		//return with error code
		if((strpos($tourl,'jerr') !== false)){
			header('Location: '.$tourl);
		}
		else{
			header('Location: '.$tourl."?jerr=1");
		}
		return;
}

	$unique = 1;
	$result = mysqli_query($con,"SELECT * FROM teaminfo");
	while($iter = mysqli_fetch_array($result))
                {
                	if(!strcmp($iter['phrase'],$pphrase)){
				
				$unique = 0;
				$teamname = $iter['name'];
				break;
			}
		
		}
	if(!$unique){
		
		//insert new team
		mysqli_query($con,"INSERT INTO userteam (username, teamname) VALUES ('". $user ."', '". $teamname ."')");	
		header('Location: '."http://felicity.iiit.ac.in/threads/breakin/main.php");
		return;		
	}
	else{
		
		//return with error code
		if((strpos($tourl,'jerr') !== false)){
			header('Location: '.$tourl);
		}
		else{
			header('Location: '.$tourl."?jerr=1");
		}	
	}

?>
