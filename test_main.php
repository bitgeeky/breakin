<?php 
include_once('cleaner.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>
Break In | Threads
</title>
<link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="styles/bootstrap-responsive.min.css">
<?php include_once 'includer2.php';?>
<style type="text/css">
#ques {
    text-align: center;
    padding: 1em; 
    background-color: #ddd;
    border-radius: 4px;
    color: #333;
}
#ques p {
   margin: 0.1em 0 1em 0;
   line-height: 1.4em; 
}
#ques a:hover {
    color: #024A6F;
}
.interface-form {
    padding: 1em;
}
.interface-form .btn{
    margin: 0.2em;
    width: 100%;
}
.row {
}
::-webkit-input-placeholder {
   color: black;
}

:-moz-placeholder { /* Firefox 18- */
   color: #000;  
}

::-moz-placeholder {  /* Firefox 19+ */
   color: #000;  
}

:-ms-input-placeholder {  
   color: #000;  
}
.container {
    margin-top: 2em;
}
#tbanswer {
    margin-top: 2em;
}
</style>
</head>
<body>
<div class="content-wrapper">
<?php include_once 'masthead.php'; ?>
<?php include_once 'navbar.php'; ?>
<?php include_once 'announcements.php'; ?>
<div class="container" id="container">
<?php

/******** Team Name ! ************/

$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");
$_GET   = sanitize($con, $_GET);
$_POST  = sanitize($con, $_POST);
if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
     }
$result = mysqli_query($con,"SELECT * FROM userteam");
$exists = 0;
while($row = mysqli_fetch_array($result))
      {
               if(!strcmp($row['username'],$user)){
			echo "<div class='row'><div class='span5'><p class='lead'>Teamname: " . $row['teamname']. "</p></div>\n";
			$exists = 1;
			$teamname = $row['teamname'];
			break;
               }
      }
	if(!$exists){

	/****** hard coded URL , to be changed on Deployment ************/
	header('Location: '."http://felicity.iiit.ac.in/threads/breakin/");
  exit();
  //return;

	}
	
/********** Admin Passphrase ! **********/
$result = mysqli_query($con,"SELECT * FROM teaminfo");
$tmpflag=0;
while($iter = mysqli_fetch_array($result))
      {
               if(!strcmp($iter['admin'],$user)){
			          echo "<div class='span7'><p class='lead pull-right'>Passphrase: ".$iter['phrase']. "</p></div></div>\n";
                $tmpflag=1;
                break;
               }
      }
if(!$tmpflag) echo '</div>';

/************** Show admin *****/
$ares = mysqli_query($con,"SELECT * FROM teaminfo");
while($aiter = mysqli_fetch_array($ares))
      {
               if(!strcmp($aiter['name'],$teamname)){
                        echo "<div class='text-center'><p class='lead'>Admin: ".$aiter['admin']. "</p></div>\n";
                        break;
               }
      }



/************ Show Score ************/
$sres = mysqli_query($con,"SELECT * FROM solved");

$teamscore = 0;
while($iters = mysqli_fetch_array($sres))
      {
               if(!strcmp($iters['username'],$teamname)){
                        
			$qno = $iters['qnum'];
			$qcat = $iters['qcat'];
			$qques = mysqli_query($con,"SELECT * FROM ques WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");
        		$qrow= mysqli_fetch_array($qques);

        		$score = $qrow['score'];
			$teamscore += $score;
							
               }
      }
	echo "&nbsp;&nbsp;Score:  ".$teamscore;
?>


<div class="row">
<div id="menu" class="span2">
<?php
echo "<form id='form1' name='form1' class='interface-form' method='get' action=''>";
/*for ($i = 1; $i <= 6; $i++){
	echo 
		"<button class='btn' type='submit' value=$i name='qcat' >Category $i </button><br>";
}*/
echo "<button class='btn' type='submit' value=1 name='qcat' >Trivia </button><br>";
echo "<button class='btn' type='submit' value=2 name='qcat' >Reconnaissance </button><br>";
echo "<button class='btn' type='submit' value=3 name='qcat' >Web Security </button><br>";
echo "<button class='btn' type='submit' value=4 name='qcat' >Miscellaneous </button><br>";
echo "<button class='btn' type='submit' value=5 name='qcat' >Reverse Enginnering </button><br>";
echo "<button class='btn' type='submit' value=6 name='qcat' >Cryptanalysis </button><br>";

echo"</form>";
?>
</div>

<div id="content" class="span10" >
<div id="ques">
<?php
require 'class.Ans.php';

if(!isset($_GET['qcat']))
echo<<<_END
<p>Now Please select a Category !</p>
_END;

else if (((int)$_GET['qcat']>6)||((int)$_GET['qcat']<1)) {
echo<<<_END
<p>Invalid category selected.</p>
_END;
}
else {
	echo "<form id='form2' name='form2' method='get' action=''>".
		"<input class='btn' type='hidden' name='qcat' value='".$_GET['qcat']."'/>";
	$qlen = array(6,5,3,9,7,4);
	$levels=$qlen[$_GET['qcat']-1];
	for ($i = 1; $i <= $levels; $i++){
		$ans = new Ans();
		if($ans->check_done($i,$_GET['qcat'],$teamname,true)){
		echo  "
			<button class='btn btn-success' type='submit' value=$i name='qno' >Question $i </button>";
		}
		else{		
		echo  "
			<button class='btn btn-primary' type='submit' value=$i name='qno' >Question $i </button>";
		}
	}
	echo "</form>";
  echo "<br/><br/>";
  $category_list = array("Trivia <br/>(Solutions before taking md5 will be in lower case for Trivia)", "Reconnaissance", "Web Security",  "Miscellaneous", "Reverse Enginnering", "Cryptanalysis");
  if(!isset($_GET['qno']))
  {
    $qcat = (int)$_GET['qcat']-1;
echo<<<_END
<p>Welcome to category $_GET[qcat] - $category_list[$qcat]!</p>
<p>Category description.</p>
<p>Please select a question.</p>
_END;
  }

else if (((int)$_GET['qno']>$levels)||((int)$_GET['qno']<1)) {
echo<<<_END
<p>Invalid question number.</p>
_END;
//		echo "Welcome to Category ".$_GET['qcat'].".<br/>";
//		echo "The Description about the category goes here <br/>";
//		echo "Please select a Question !";
	}
else{
  if($_GET['qcat'] == '4' && $_GET['qno']=='8')
  {
    echo "We're sorry for inconvenience, but as we detected some plagiarism at our end, we've removed this problem. Suitable changes have been made to the scoring.
</div>
</div>
</div>
</div>
</div>";
include_once 'footer.php';
    die();
  }
		require 'class.ShowQues.php';
		echo "<p><strong>Question No : ".$_GET['qno']."</strong></p>";
		$temp = new ShowQues();
		$temp->show($_GET['qno'],$_GET['qcat']);
		$answer = new Ans();
    if($answer->check_done($_GET['qno'],$_GET['qcat'],(string)$teamname,true)){
			echo "<p><b>Team has already solved this question.</b></p>"; 
    }
		if($answer->check_done($_GET['qno'],$_GET['qcat'],(string)$teamname)){

        if(isset($_GET['qcode'])){
				if((int)$_GET['qcode']==1){
					echo "<p style='color:green'><strong>Congratulations! Correct answer.</strong></p>";	
				}
			}

		}
		else{
			if(isset($_GET['qcode'])){
				if((int)$_GET['qcode']==0){
					echo "<p style='color:red'><strong>Wrong Answer.</strong></p>";	
				}
			}
			echo "<br><b>Ques to be Done</b><br>";
			echo "<form id='form3' name='form3' method='post' action='CheckAns.php'>".
				"<input class='btn' type='hidden' name='uname' value='".$teamname."'/>".  
				"<input class='btn' type='hidden' name='qno' value='".$_GET['qno']."'/>".
				"<input class='btn' type='hidden' name='qcat' value='".$_GET['qcat']."'/>".
				"<input class='btn' type='hidden' name='purl' value='".$_SERVER['REQUEST_URI']."'/>".
				"<input type='text' id='tbanswer' name='uans' style='color: #333' placeholder='Answer'/>".
				"<br><input class='btn' type='submit' value='Submit'>".
				"</form>";

		}
	/**	$comm = new ShowComments();
		$comm->show($_GET['qno'],$_GET['qcat']);
			echo "<form id='form4' name='form4' method='post' action='AddComment.php'>".
				"<input class='btn' type='hidden' name='uname' value='".$user."'/>".  
				"<input class='btn' type='hidden' name='qno' value='".$_GET['qno']."'/>".
				"<input class='btn' type='hidden' name='qcat' value='".$_GET['qcat']."'/>".
				"<input class='btn' type='hidden' name='purl' value='".$_SERVER['REQUEST_URI']."'/>".
				"<textarea name='cval' placeholder='Add a Comment Here' rows='4' cols='50'></textarea>".
				"<br><input type='submit' value='Comment'>".
				"</form>";
			echo "**All the Comments would be Moderated <br/> So please wait till your comment shows up!";**/
	}	
}
?>        
</div>
</div>
</div>
</div>
</div>
<?php include_once 'footer.php' ?>
</body>
</html>
