<?php
class ShowQues{

	function show($qno,$qcat){

		echo "<p>Category ".$qcat.", Question ".$qno."</p>";
		$con=mysqli_connect("localhost","breakinbeta","breakin_beta!@#","breakin");
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to database: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,"SELECT * FROM ques WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");
//		$result = mysqli_query($con,"SELECT * FROM ques");

		while($row = mysqli_fetch_array($result))
		{
			echo "<h3 style='color:black;'>"."Problem Points : ".$row['score']."</h3>";
			echo $row['qdes'];
			echo "<br>";
			echo "<p><strong>Hint For This Problem</strong></p>";
			if((int)$row['hintflag']==1){
				echo $row['qhint'];
			}
			else
				echo "Sorry No Hint Available for this Problem at the Moment<br/><br/><br/>";
		}
		mysqli_close($con);		
	}		
}
?>

