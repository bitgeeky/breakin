<!DOCTYPE html>
<head>
<title>Break In | Threads</title>
<link rel="stylesheet" href="styles/bootstrap.min.css">
<link rel="stylesheet" href="styles/bootstrap-responsive.min.css">
<?php include_once 'includer.php';?>
<style>
label {
    line-height: 2em;
}
.span-content{
    padding: 5em;
}
</style>
</head>
<div class="content-wrapper">
<?php include_once 'masthead.php'; ?>
<div class="container">
<?php
	$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");

	if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
        
	$exists = 0;
        $result = mysqli_query($con,"SELECT * FROM userteam");
        while($iter = mysqli_fetch_array($result))
                {
                        if(!strcmp($iter['username'],$user)){

                                $exists = 1;
                                break;
                        }

                }
	if($exists){
		
		//************ hard coded location , check on Deployment !!!
	
		header('Location: '."http://felicity.iiit.ac.in/threads/breakin/main.php");
		return;		
	}
	
	if(isset($_GET['jerr'])){
		echo "<div class='error' style = 'color:red;'><h4>Error :</h4>";
		echo "PassPhrase Doesn't exists <br/> OR <br/>Empty Strings inserted.</div>";
	}
	echo<<<_END
<div class="row">
<div class="span6">
<div class="span-content">
<h2>Join an Existing Team</h2>
<form method='post' action='JoinTeam.php'>
<label for='jteam'>Enter passphrase for the Team:</label>
<input type='hidden' name='name' value='$user'/>
<input type='hidden' name='purl' value='$_SERVER[REQUEST_URI]'/>
<input type='text' id='jteam' name='jteam' placeholder='Passphrase for Team'/>
<br>
<input class='btn' type='submit' value='Join Team'>
</form></div></div>
_END;
	if(isset($_GET['cerr'])){
		echo "<h4>Error : </h4>";
		echo "Try putting a different Pass Phrase or Team name";
	}

echo<<<_END
<div class="span6">
<div class="span-content">
<h2>Create your own team</h2>
<form method='post' action='CreateTeam.php'>
<label for="cteam">Team Name:</label>
<input class="span" type='text' name='cteam' id='cteam' placeholder='Team name'/>
<br>
<label for="pphrase">Team Passphrase:</label>
<input class="span" type='text' name='pphrase' id='pphrase' placeholder='Passphrase for Team'/>
<input type='hidden' name='purl' value='$_SERVER[REQUEST_URI]'/>
<br>
<input class='btn' type='submit' value='Create Team'>
</form>
</div>
</div>
<h3>Instructions on forming teams:</h3><br />
<h4>
<ol>
<li>You are given an option to either join an existing team or to create a new team.</li>
<li>At this point, exactly one member of your desired team creates a new team. He/She will need to enter a team name and a passphrase. Both of these fields need to be unique. He/She will automatically be the part of the newly created team and will be designated as team-leader.</li>
<li>Now the team leader needs to share this passphrase only to his team mates. Once they click on join team as this passphrase, they will be the part of the team.</li>
<li>Forming teams is not a reversible process. So please take care while entering team names, passphrases and while sharing it too.</li>
<li>There is no limit for team size.</li>
<li>For any doubts/queries you can join IRC channel for this event: breakin-iiith. Its hosted at freenode.net.</li>
</ol>
</h4>
</div>
_END;
?>
</div>
</div>
<?php include_once 'footer.php'; ?>
</body>
</html>
