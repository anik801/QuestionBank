<?php
	$q = intval($_GET['q']);
	
	$con = mysqli_connect('localhost','root','','mytest');
	if (!$con)
	  {
	  die('Could not connect: ' . mysqli_error($con));
	  }
	
	mysqli_select_db($con,"mytest");
	$sql= "SELECT * FROM `question` WHERE `question_id`= '".$q."'";
	$result = mysqli_query($con,$sql);
	$row = mysqli_fetch_array($result);	
	$ob = "files/".$row['department'].$row['year'].$row['semester'].$row['exam'].$row['subject_code'].".pdf";
	unlink($ob);
mysqli_close($con);
?> 
