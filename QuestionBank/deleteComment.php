<?php
	session_start();
	require 'myConnection.php';
	if(isset($_GET['file'])){
		$link=$_GET['file'];
		$questionID=$_GET['qID'];
		$commentID=$_GET['cID'];
		//echo $link;
		//echo $questionID;
		//echo $commentID;

		$sql="DELETE FROM comments WHERE comment_id='$commentID'";
		$result = mysql_query($sql);
		if (!$result){
			die('Invalid query: ' . mysql_error());
		}else{
			echo"
			<script>
				bootbox.alert('Comment Deleted Succesfully', function() {					
					str='showPdf.php?file='+$link+'&qID='+$questionID;
					document.location.href=str;
				});		
			</script>
			";
		}
	}
?>