<?php
class ShowQues{

	function show($qno,$qcat){

		echo "<br/>hey the class works fine "."Ques No : ".$qno."   Category No : ".$qcat."<br/>";
		$con=mysqli_connect("localhost","root","iiit123","breakin");
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,"SELECT * FROM ques WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");
//		$result = mysqli_query($con,"SELECT * FROM ques");

		while($row = mysqli_fetch_array($result))
		{
			echo $row['qdes'];
			echo "<br>";
			echo "<br><b>Hint(if is there goes here)</b><br>";
			if((int)$row['hintflag']==1){
				echo "<br/>Hint for the question (flag set by 1 by admin to show the hint)<br/>";
				echo $row['qhint'];
			}
			else
				echo "Hint flag 0 therefore don't display hint<br/>";
		}
		mysqli_close($con);		
	}		
}
?>

