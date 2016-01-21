<?php
	$con=mysql_connect('localhost','root','','question_bank');
	if(!$con){
		die("can not connect:".mysql_error());
	}
	mysql_select_db("question_bank",$con);	
?>