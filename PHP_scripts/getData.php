<?php 

	if($_SERVER['REQUEST_METHOD']=='GET'){
		
		 
		
		require_once('dbConnect.php');
		
		$sql = "SELECT * FROM temp ORDER BY id DESC LIMIT 1;";
		
		$r = mysqli_query($con,$sql);
		
		$res = mysqli_fetch_array($r);
		
		$result = array();
		
		array_push($result,array(
			"id"=>$res['id'],
			"time"=>$res['time'],
			"temp"=>$res['value']
			)
		);
		
		echo json_encode(array("result"=>$result));
		
		mysqli_close($con);
		
	}