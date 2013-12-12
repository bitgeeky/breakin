<?php
class Ans{

	function check_done($qno,$qcat,$usrname){
		$con=mysqli_connect("localhost","root","iiit123","breakin");
		// Check connection
		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySQL: " . mysqli_connect_error();
		}

		$result = mysqli_query($con,"SELECT * FROM solved WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'  AND  username= '". $usrname ."'");

		//		$result = mysqli_query($con,"SELECT * FROM solved WHERE qnum= '". (int)$qno ."' AND qcat= '". (int)$qcat ."'");
		$i=0;
		while($row = mysqli_fetch_array($result))
		{
			echo "<br> Solved On : ".$row['sdate'];
			echo "<br>";
			$i+=1;
		}
		if ($i > 0){ 
			return true; 
		}else{ 
			return false; 
		} 

	}
}
?>
