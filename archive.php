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
<?php $base_url = 'http://felicity.iiit.ac.in/threads/'; ?>
  <!--
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-46377629-1']);
   _gaq.push(['_setCookiePath', '/threads']);  
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

    </script>
-->
      <div class="masthead dark">
        <span class="logo"><a href="<?php echo $base_url; ?>"><img src="<?php echo $base_url; ?>images/logo.png" alt="Threads Logo"></a></span>
        <span class="links">
          <a href="<?php echo $base_url; ?>events">Events</a>
          <a href="<?php echo $base_url; ?>sponsors">Sponsors</a>
          <a href="<?php echo $base_url; ?>contact">Contact Us</a>
        </span>
</div>

<?php include_once 'navbar.php'; ?>
<?php include_once 'announcements.php'; ?>
<div class="container" id="container">
<?php

$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");
$_GET   = sanitize($con, $_GET);
$_POST  = sanitize($con, $_POST);
if (mysqli_connect_errno()){
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
if (isset($_POST)) {
	$qno    = sanitize($con,$_POST['qno']);
	$qcat   = sanitize($con,$_POST['qcat']);
	$uans   = sanitize($con,$_POST['uans']);
	$uname  = sanitize($con,$_POST['uname']);

	$result = mysqli_query($con,"SELECT * FROM ques WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");

	$row = mysqli_fetch_array($result);
	$trimmed = trim($row['ans']);
	$origans = $trimmed;
	$uans = trim($uans);
	if(!strcmp($uans,$origans)&&(strlen($uans)>0)){
		//correct ans
		header("Location: http://felicity.iiit.ac.in/threads/breakin/archive.php?qcat=".$qcat."&qno=".$qno."&qcode=1");
	}
	else {
		header("Location: http://felicity.iiit.ac.in/threads/breakin/archive.php?qcat=".$qcat."&qno=".$qno."&qcode=0");
	}
}
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
			if(isset($_GET['qcode'])){
				if((int)$_GET['qcode']==0){
					echo "<p style='color:red'><strong>Wrong Answer.</strong></p>";	
				}
				if((int)$_GET['qcode']==1){
					echo "<p style='color:green'><strong>Congratulations! Correct answer.</strong></p>";	
				}
			}
			echo "<form id='form3' name='form3' method='post' action='archive.php'>".
				"<input class='btn' type='hidden' name='uname' value='".$teamname."'/>".  
				"<input class='btn' type='hidden' name='qno' value='".$_GET['qno']."'/>".
				"<input class='btn' type='hidden' name='qcat' value='".$_GET['qcat']."'/>".
				"<input class='btn' type='hidden' name='purl' value='".$_SERVER['REQUEST_URI']."'/>".
				"<input type='text' id='tbanswer' name='uans' style='color: #333' placeholder='Answer'/>".
				"<br><input class='btn' type='submit' value='Submit'>".
				"</form>";

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
