<?php
	session_start();
	include 'mask.php';	

	function showCommentList(){
		require 'myConnection.php';
		$sql="SELECT * FROM comments ORDER BY time DESC";
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}else{
			if(mysql_num_rows($result)){
				echo "
					<table class='table table-striped'>
					<thead>
						<tr>
							<th>Date & Time</th>
							<th>Name</th>
							<th>Comment</th>
							<th>Subject</th>
							<th>Page</th>
						</tr>
					</thead>
					<tbody>
				";
				while($row=mysql_fetch_array($result)){
					$qID=$row['question_id'];
					$sql2="SELECT * FROM questions WHERE question_id='$qID'";
					$result2=mysql_query($sql2);
					$row2=mysql_fetch_array($result2);
					$subject=$row2['subject_code'];
					$link=$row2['department']."".$row2['year']."".$row2['semester']."".$row2['exam']."".$row2['subject_code'].".pdf";
					echo "
						<tr>
							<td>".$row['time']."</td>
							<td>".$row['name']."</td>
							<td>".$row['data']."</td>
							<td>$subject</td>
						";
						if($row['status']==='0'){
							echo"
							<td><a href='showPdf.php?file=".$link."&qID=".$qID."'><label class='btn btn-success'>Link</label></a></td>
							</tr>
							";
						}else{
							echo"
							<td><a href='showPdf.php?file=".$link."&qID=".$qID."'><label class='btn btn-default'>Link</label></a></td>
							</tr>
							";
						}
						
				}
				echo "
					</tbody>
				";
			}else{
				echo "No current notifications";
			}
		}
	}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Notifications</title>  
</head>

<body>
<div class="container">			
	<div id="notificationDiv">	
		<div class="row" id="textBoxCenter">
			<p align="center">
				<h2>Recently posted comments</h2>
			</p>	
		</div>
		<div>
			<?php
				showCommentList();
			?>	
		</div>		
	</div>
</div>	


</body>

</html>