<?php
	$course = $_GET['course'];
	$year = $_GET['year'];
	$semester = $_GET['semester'];
	$exam = $_GET['exam'];
	$subject_code = $_GET['subject_code'];
	
	//echo "before";
	require 'myConnection.php';
	
	$sql = "SELECT * FROM `questions` WHERE `department` = '".$course."' AND `year`= '".$year."' AND 
			`semester` = '".$semester."' AND `exam`= '".$exam."' AND `subject_code`= '".$subject_code."' ";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);
	
	//echo "Hello";
	echo $row['question_id'];
	//echo $row['department'];
	//echo $row['year'];
	//echo $row['semester'];
	//echo $row['exam'];
	//echo $row['subject_code'];

	//mysqli_close($con);
?> 