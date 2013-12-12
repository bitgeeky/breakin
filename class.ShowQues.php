<?php
class ShowQues{

	function show($qno,$qcat){

		echo "<br/>hey the class works fine".$qno.$qcat."<br/>";
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
		}		
	}		
}
?>

