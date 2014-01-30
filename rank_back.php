<?php
//include("header.php");
$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");

// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
$result = mysqli_query($con,"SELECT * FROM solved WHERE username != 'testadmin' AND username != 'Admin'");
while($row = mysqli_fetch_array($result)){
  $qno = $row['qnum'];
  $qcat = $row['qcat'];

  $qques = mysqli_query($con,"SELECT * FROM ques WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");
  $qrow = mysqli_fetch_array($qques);


  if(strlen(trim($qrow['score']))>0){

    $score = $qrow['score'];
  }
  else{
    $score = 0;
  }
  //echo $score;
  /**
  $qteam = mysqli_query($con,"SELECT * FROM userteam WHERE username= '". $user ."'");
  $trow = mysqli_fetch_array($qteam);
  $teamname = $trow['teamname'];
  **/
  $teamname = $row['username'];	
  $flag = 0;
  $value=0;
  foreach($ranklist as $key=>$value){
    if(!strcmp($key,$teamname)){	
      $value += $score;
      $ranklist[$key] = $value;
      $flag = 1;
    }		
  }
  if($flag==0){
    $ranklist[$teamname] = $score;
  }

}
arsort($ranklist);


$rank = 1;
$counter = 0;
echo '<table class="table table-striped table-hover">' . "\n" . '<tr><th>Rank</th><th>Team Name</th><th>Challenges Solved</th><th>Score</th>'; 
foreach($ranklist as $key=>$value){
  echo '<tr><td>'.strval($rank).'</td><td>' . $key."    ( "; 
  $rank += 1;
  $cqer = mysqli_query($con,"SELECT * FROM solved where username = '$key'");
  $counter = mysqli_num_rows($cqer);
  $uqer = mysqli_query($con,"SELECT * FROM userteam");
  $tmembers = "";
  while($nqer = mysqli_fetch_array($uqer)){
    if(!strcmp($nqer['teamname'],$key)){
      $tmembers.= $nqer['username'].", ";
    }
  } 
  echo substr($tmembers, 0, strlen($tmembers)-2);	
  echo " )".'</td><td>' . strval($counter) . '</td><td>' . $value. '</td></tr>';
}
echo '</table>';
?>
