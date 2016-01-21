<?php
	session_start();
	include 'mask.php';

	if(isset($_POST['submit'])){
		$un=$_POST['username'];
		$pw=$_POST['password'];

		
		$aID=$_SESSION['id'];

		$sql="SELECT * FROM `admin_accounts` WHERE admin_id='$aID' AND `password`='$pw'";
		$result=mysql_query($sql);
		if (!$result) {
		   	die('Invalid query: ' . mysql_error());
		}
		if(mysql_num_rows($result)>0){
			if($_POST['newPassword']!==""){
				$npw=$_POST['newPassword'];	
				$sql2="UPDATE `admin_accounts` SET `username`='$un',`password`='$npw' WHERE `admin_id`='$aID'";
			}else{
				$sql2="UPDATE `admin_accounts` SET `username`='$un',`password`='$pw' WHERE `admin_id`='$aID'";
			}
			$result2=mysql_query($sql2);				
			if (!$result2) {
				die('Invalid query: ' . mysql_error());
			}
			//header('Location: adminPanel.php');
		}else{
			echo "
			<script>
				bootbox.alert('Username or password does not match.', function() {		
				});
			</script>";				
		}
	}

?>

<!DOCTYPE html>
<html>

<head>
  <title>Account Info</title>
    <script type="text/javascript">
    	
    </script> 
</head>

<body>
<div class="container">
	<div id="indexBodyDiv">
		<div id="titleBox">
			<p align="center">Account Information</p>
		</div>		

		
		<div id="accountTableBox">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" name="myForm">
				<table class="table table-striped">
				<tbody>
				<div>
					<?php
						$aID=$_SESSION['id'];
						//echo $aID;
						$sql="SELECT * FROM admin_accounts WHERE admin_id=$aID";
						$result=mysql_query($sql);
						$row=mysql_fetch_array($result);
						echo"
							<tr>
								<td>Username: </td>
								<td><input class='form-control' name='username' id='newUserName' type='text' required size=40 value=".$row['username']."></td>
							</tr>
							<tr>
								<td>Old Password: </td>
								<td><input class='form-control' name='password' id='password' type='password' required value=''></td>
							</tr>
							<tr>
								<td>New Password: </td>
								<td><input class='form-control' name='newPassword' id='newPassword' type='password' placeholder='Enter if you want to change password'></td>
							</tr>
							<tr>
								<td>Re-Type New Password: </td>
								<td><input class='form-control' name='newPasswordRetype' id='newPasswordRetype' type='password' placeholder='Enter if you want to change password' ></td>
							</tr>
							<input type='password' style='display:none'  value='".$row['password']."'>
						";
					?>

				</div>
				
				</tbody>
				</table>

				<div id="submitDiv">
					<input style="display:none"type="submit" name="submit" id="submit">
					<input class="btn btn-lg btn-primary"  type="button" value="Change Info" name="submitFake" id="submitFake" onclick="checkAccountUpdateInput()">
				</div>
			</form>
		</div>
	</div>
</div>
	

</body>
</html>