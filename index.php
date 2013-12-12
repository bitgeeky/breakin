<!DOCTYPE html>
<html>
<head>
<title>
BreakIn
</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body style="margin:0;padding:0;">

<div id="container" style="width:100%;height:600px">
<center>
<div id="header" style="background-color:#2ECCFA;">
<h1 style="margin-bottom:0;">Break In</h1></div></center>

<div id="menu" style="background-color:#A9F5F2;height:100%;width:20%;float:left;">
<b>Categories</b>
<br><br><br>
<?php
echo "<form id='form1' name='form1' method='get' action=''>";
   for ($i = 1; $i <= 5; $i++){
    echo 
"<button type='submit' value=$i name='qcat' >Category $i </button><br>";
    }
echo"</form>";
?>
</div>

<div id="content" style="background-color:#EEEEEE;height:100%;width:80%;float:left;">
<center>
<div id="ques">
<?php
if(!isset($_GET['qcat'])) {
   echo "The description of Event Goes HERE so and so.....<br/> Now Please select a Category !";
}
else{
	echo "<form id='form2' name='form2' method='get' action=''>".
	"<input type='hidden' name='qcat' value='".$_GET['qcat']."'/>";
   for ($i = 1; $i <= 5; $i++){
    echo  "
<button type='submit' value=$i name='qno' >Question $i </button>";
    }
echo "</form>";
if(!isset($_GET['qno'])) {
   echo "Welcome to Category : ".$_GET['qcat']."<br/>";
   echo "The Description about the category goes here <br/>";
   echo "Please select a Question !";
}
else{
	require 'class.ShowQues.php';
	require 'class.ShowComments.php';
	require 'class.Ans.php';
	echo "<b>Question No : ".$_GET['qno']."</b><br/>"."Description of Question goes Here...";
	$temp = new ShowQues();
	$temp->show($_GET['qno'],$_GET['qcat']);
	$answer = new Ans();
	if($answer->check_done($_GET['qno'],$_GET['qcat'],"testusera")){  // user value hard coded as "testusera"
		echo "<br><b>You Have Already Done this Ques</b><br>"; 
	}
	else{
		echo "<br><b>Ques to be Done</b><br>";
	}
	$comm = new ShowComments();
	$comm->show($_GET['qno'],$_GET['qcat']);
}	
}
?>        
</div>
</center>
</div>

<div id="footer" style="background-color:#A9F5F2;clear:both;text-align:center;">
Felicity IIIT-H</div>

</div>

</body>
</html>

	
