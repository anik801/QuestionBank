<?php	
	session_start();
	if(isset($_SESSION['id'])){
		require_once 'myConnection.php';
		$thisID=$_SESSION['id'];
		if($_SESSION['profile']=='student'){
			$sql="SELECT name FROM `student_account` WHERE `student_id`='$thisID'";
		}else {
			$sql="SELECT name FROM `admin_account` WHERE `admin_id`='$thisID'";	
			echo '<div style="float:left"><a class="btn btn-info" href="adminPanel.php">Admin Panel</a></div>';						
		}
		$result=mysql_query($sql);
		$row=mysql_fetch_array($result);
		
		echo '<p align="right" style="color:white">logged in as: '.$row['name'];
		//echo '<p align="right">logged in as: '.$_SESSION['id'];
		echo '<input type="button" class="btn btn-info" role="button" id="signOutButton" value="Sign Out" onClick="logOut();" /></p>';
		//echo '<a href="signOut.php" style="text-decoration:none"><input type="button" class="btn btn-info" role="button" id="signOutButton" value="Sign Out" onClick="logOut();" /></a></p>';
	}else{
		echo"
		<script>
		alert('Sorry, you are not logged in. Please login to continue.');			
		window.location.href='signin.php';
		</script>";				
	}
?>
<?php
	if(isset($_POST['logOutButton'])){
			session_destroy();						
			//header("Locaiton:index.php");
			echo '<script>document.location="index.php";</script>';			
	}
?>
<html>
<head>
<link href="apiFiles/bootstrap.css" rel="stylesheet"/>
<script src="apiFiles/jquery-1.10.2.min.js"></script>
<script src="apiFiles/bootstrap.js"></script>
<script>
function logOut(){
	if(confirm("Are you sure you want to sign out?")){
		$("#logOutButton").trigger('click');
	}
	//alert('hello');
}
</script>

</head>

<body>	
<div style="display:none">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	<input type="submit" id="logOutButton" name ="logOutButton" value="logOut" style="display:compact"/>
	</form>
</div>

</body>

</html>
