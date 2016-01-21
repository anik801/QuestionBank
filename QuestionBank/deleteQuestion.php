<?php
	$q = intval($_GET['q']);
	
	require 'myConnection.php';
	$sql= "SELECT * FROM `questions` WHERE `question_id`= '".$q."'";
	$result = mysql_query($sql);
	$row = mysql_fetch_array($result);	
	$ob = "files/".$row['department'].$row['year'].$row['semester'].$row['exam'].$row['subject_code'].".pdf";
	unlink($ob);

	$sql = "DELETE FROM `questions` WHERE `question_id` = '".$q."'";
	$result = mysql_query($sql);

?> 
