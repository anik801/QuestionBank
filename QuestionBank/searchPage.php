<?php
	session_start();
	include 'mask.php';

function query(){
	require 'myConnection.php';
	$searchKey=$_GET['data'];
	$sql="SELECT DISTINCT * FROM questions WHERE department LIKE '%$searchKey%' OR year LIKE '%$searchKey%' OR semester LIKE '%$searchKey%' OR exam LIKE '%$searchKey%' OR subject_code LIKE '%$searchKey%' ";
	$result = mysql_query($sql);
	if (!$result) {
		   	die('Invalid query: ' . mysql_error());
		}	
	if(!mysql_num_rows($result)){
		echo "<br><br>No results found. Please try again with another key word.";
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
				<td><b>Question</b></td>
			</tr>";
		while($row = mysql_fetch_array($result)){
			$varID=$row['question_id'];
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
			echo "<td><a href='showPdf.php?file=".$link."&qID=".$varID."'><label class='btn btn-success'>Link</label></a></td></tr>";
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
  <title>Search</title>  
</head>

<body>
	<div id="bodyDiv">

		<div class="row" id="textBox">
			<p align="center">
				This is the question search result page. Feel free to search again if you did not find what you were looking for.
			</p>
		</div>

		<?php
			if(isset($_GET['data'])){
				$searchKey=$_GET['data'];
				echo "<h3>Search Tag: ".$searchKey."</h3>";
				query();
			}else{
				echo "An Error Occured.";
			}
		?>
	</div>	
</body>

</html>


