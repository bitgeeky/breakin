<?php
class ShowComments{

	function show($qno,$qcat){

		echo "<br/>hey the class works fine".$qno.$qcat."<br/>";
		echo "<br><b>Comments if there go here :</b><br>";
		$con=mysqli_connect("localhost","root","iiit123","breakin");
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}
		$result = mysqli_query($con,"SELECT * FROM comments WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");

		while($row = mysqli_fetch_array($result))
		{
			echo $row['username']." [";
			echo $row['cdate']."] : &nbsp;";
			echo $row['cdes'];
			echo "<br>";
		}		
	}		
}
?>

