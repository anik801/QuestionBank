<?php
	session_start();
	include 'mask.php';
	require 'myConnection.php';
	if(isset($_GET['qID'])){
		$questionID=$_GET['qID'];
		$link=$_GET['file'];
	}
	if(isset($_POST['submit'])){		
		$questionID=$_POST['questionID'];	
		$name=$_POST['name'];
		$data=$_POST['data'];
		$email=$_POST['email'];
		$link=$_POST['link'];	

		$sql="INSERT INTO comments (email,name,data,time,question_id) VALUES ('$email','$name','$data',now(),'$questionID');";
		$result = mysql_query($sql);
		if (!$result){
			die('Invalid query: ' . mysql_error());
		}else{
			echo'
			<script>
				bootbox.alert("Comment Posted Succesfully", function() {
					link=$("#link").val();
					id=$("#questionID").val();
					str="showPdf.php?file="+link+"&qID="+id;
					document.location.href=str;
				});		
			</script>
			';
		}

	}
	if(isset($_GET['cID'])){
		$link=$_GET['file'];
		$questionID=$_GET['qID'];
		$commentID=$_GET['cID'];

		$sql="DELETE FROM comments WHERE comment_id='$commentID'";
		$result = mysql_query($sql);
		if (!$result){
			die('Invalid query: ' . mysql_error());
		}else{
			echo'
			<script>
				bootbox.alert("Comment Deleted Succesfully", function() {
					link=$("#link").val();
					id=$("#questionID").val();
					str="showPdf.php?file="+link+"&qID="+id;
					document.location.href=str;
				});		
			</script>
			';
		}
	}

	function showPreviousComments(){	
		if(isset($_GET['qID'])){
			$questionID=$_GET['qID'];	
			$sql="SELECT * FROM comments WHERE question_id=$questionID;";
			$result = mysql_query($sql);
			if (!$result){
				die('Invalid query: ' . mysql_error());
			}
			if(mysql_num_rows($result)>0){
				while($row=mysql_fetch_array($result)){
					$name=$row['name'];
					$data=$row['data'];
					$time=$row['time'];
					$email=$row['email'];
					$id=$row['comment_id'];
					if(isset($_SESSION['id'])){
						echo "
							<div>
								<label class='label label-primary'>$name</label> &nbsp&nbsp&nbsp&nbsp <label id=timeBar>Posted on: $time</label><br>
								<label class='label label-default'>$data</label><br>
								<label class='label label-xs label-warning'>Email: $email</label> 
								<button class='btn btn-xs btn-danger' onclick='deleteCommentCheck($id);'>Delete Comment</button>
							</div>
							<br>
						";
					}else{
						echo "
							<div>
								<label class='label label-primary'>$name</label> &nbsp&nbsp&nbsp&nbsp <label id=timeBar>Posted on: $time</label><br>
								<label class='label label-default'>$data</label>
							</div>
							<br>
						";
					}
					
				}
				if(isset($_SESSION['id'])){
					$sql="UPDATE comments SET status='1' WHERE question_id=$questionID;";
					$result = mysql_query($sql);
					if (!$result){
						die('Invalid query: ' . mysql_error());
					}
				}
				
			}else{
				echo "<h4>No comments posted yet. Feel free to post the first comment.</h4>";
			}
		}
	}

	
?>

<!DOCTYPE html>
<html>

<head>
  <title>Questions</title>  
</head>

<body>
	<div id="bodyDiv">

		<div class="row" id="textBox">
			<p align="center">
				If this is not the question you are looking for, please search again. You can also share your comments below.
			</p>
		</div>

		<div id="pdfBox">
		<?php
		  if(isset($_GET['file'])){
		  	$temp=$_GET['file'];
			  echo'
			  	<div class="modal-body">
				    <iframe frameborder="0" src="questionDisplay.php?file='.$temp.'" id="headerDiv" height="400em" width="100%"></iframe>
				</div>
			  ';
		  }
		?>
		</div>

		<div id="commentsDiv">
			<h3>Comment Box</h3>
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" name="myForm" id="myForm">
				<input class="form-control" placeholder="Enter your email address." type="text" name="email" id="email">
				<input class="form-control" placeholder="Enter your name." type="text" name="name" id="name">
				<textarea class="form-control" placeholder="Enter your comment here." rows="4" cols="50" name="data" id="data"></textarea>
				
				<p align="right">
				<input class="btn btn-primary" type="button" name="submitFake" id="submitFake" value="Submit" onclick="checkCommentInput();">
				<input class="btn btn-danger" type="reset">
				</p>
				<div id="hiddenDiv">
					<input type="submit" name="submit" id="submit">
					<input type="text" name="questionID" id="questionID" value='<?php echo $questionID?>'>
					<input type="text" name="link" id="link" value='<?php echo $link; ?>'>
				</div>
			</form>
		</div>
		<div id="previousCommentsDiv">
			<h3>Previous Comments</h3>
			<?php
			  showPreviousComments();
			?>
		</div>
	</div>	
</body>

</html>