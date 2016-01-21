<?php
	session_start();
	include 'mask.php';

	if(isset($_GET['qID'])){
		$q = intval($_GET['qID']);
		$department=$_GET['dept'];
		require 'myConnection.php';
		$sql= "SELECT * FROM `questions` WHERE `question_id`= '".$q."'";
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}	
		$row = mysql_fetch_array($result);		
		$ob = "files/".$row['department'].$row['year'].$row['semester'].$row['exam'].$row['subject_code'].".pdf";
		unlink($ob);

		$sql = "DELETE FROM `questions` WHERE `question_id` = '".$q."'";
		$result = mysql_query($sql);
		$department=$_GET['dept'];
		Header("location:questionView.php?dept=$department");
	}

	function query(){
		require 'myConnection.php';
		$department=$_GET['dept'];
		$sql="SELECT * FROM questions WHERE department='$department'";
		$result = mysql_query($sql);
		if (!$result) {
			die('Invalid query: ' . mysql_error());
		}	
		if(!mysql_num_rows($result)){
			echo "<br><br>No questions uploaded yet. Please try again later.";
		}else{

			echo "<div>";
			//Creating output table
			echo"<br><br><table class='table table-striped'>";
								
			echo "
			<thead>
				<th colspan=\"6\">Output</th>
			</thead>
			<tbody>
				<tr>
					<td><b>Course</td>
					<td><b>Year</b></td>
					<td><b>Semester</b></td>
					<td><b>Exam</b></td>
					<td><b>Subject Code</b></td>
					<td><b>Question</b></td>";
					if(isset($_SESSION['id'])){
						echo "<td><b>Delete</b></td>";
					}
					echo"
				</tr>";
			while($row = mysql_fetch_array($result)){
				$varID=$row['question_id'];		
				$varDept=json_encode($row['department']);
				$varName=$row['department'].$row['year'].$row['semester'].$row['exam'].$row['subject_code']."Note";
				echo "<tr>";
				echo "<td>" . $row['department'] . "</td>";
				echo "<td>" . $row['year'] . "</td>";
				echo "<td>" . $row['semester'] . "</td>";
				echo "<td>" . $row['exam'] . "</td>";
				echo "<td>" . $row['subject_code'] . "</td>";
				//Question
				$link=$row['department']."".$row['year']."".$row['semester']."".$row['exam']."".$row['subject_code'].".pdf";
				//echo "<td><a target='_blank' href='files/".$link."'><img src='images/downloadButton.png' width='40'>" ."</a></td></tr>";
				//echo "<td><a href='showPdf.php?file=".$link."&qID=".$varID."'><img src='images/downloadButton.png' width='40'>" ."</a></td></tr>";
				//echo "<td><a href='showPdf.php?file=".$link."&qID=".$varID."'><label class='btn btn-success'>Link</label></a></td></tr>";
				if(isset($_SESSION['id'])){
					echo "<td><a href='showPdf.php?file=".$link."&qID=".$varID."'><label class='btn btn-success'>Link</label></a></td>
					<td><button class='btn btn-danger' onClick='deleteQuestionCheck($varID,$varDept);'>Delete Question</button></td>
					</tr>";
				}else{
					echo "<td><a href='showPdf.php?file=".$link."&qID=".$varID."'><label class='btn btn-success'>Link</label></a></td></tr>";
				}
			}
			echo "
			</tbody>
			</table>
			</div>";
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
				This is the question archive page. Here you can view previous questions department wise.
			</p>
		</div>

		<?php
			if(isset($_GET['dept'])){
				$department=$_GET['dept'];
				//echo $department;
				query();
			}else{
				echo "An Error Occured.";
			}
		?>
	</div>	
</body>

</html>


