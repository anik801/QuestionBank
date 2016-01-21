<?php
	ob_start();
	require 'myConnection.php';
	 //This function separates the extension from the rest of the file name and returns it 
	 function findexts ($filename) 
	 { 
		 $filename = strtolower($filename) ; 
		 $exts = split("[/\\.]", $filename) ; 
		 $n = count($exts)-1; 
		 $exts = $exts[$n]; 
		 return $exts; 
	 } 	 

	$fcourse = $fyear = $fsemester = $fexam = $fsubject_code = $ffile = "";
	$errorMain=$errorIn=0;
	$courseErr = $yearErr = $subject_codeErr = $fileErr = "";
	if(isset($_POST['submit'])){
		
		$fcourse=$_POST['course'];
		$fyear=$_POST['year'];
		$fsemester=$_POST['semester'];
		$fexam=$_POST['exam'];
		$fsubject_code=$_POST['subject_code'];
		if (empty($fsubject_code)){			 
			$subject_codeErr = "*Subject Code required";
		 	$errorMain=1;
			$errorIn=1;			
		}
		if (empty($fyear)){			 
			$yearErr = "*Year required";
		 	$errorMain=1;
			$errorIn=1;			
		}
		if($_FILES["file"]["error"] == 4){			 
			$fileErr = "*Invalid input file.";
		 	$errorMain=1;
			$errorIn=1;
		}
		if($errorMain==0){
/////////////// File Entry
			//This is the directory where images will be saved 
			 $target = "files/"; 
			 //$target = $target . basename( $_FILES['file']['name']); 
			 
			 //This applies the function to our file  
 			 $ext = findexts ($_FILES['file']['name']) ;
			 //Create new name
			 $newName="$fcourse"."$fyear"."$fsemester"."$fexam"."$fsubject_code";
			 $target = $target . $newName.".".$ext;
 
			 //This gets all the other information from the form 
			 $pdf=($_FILES['file']['name']); 
			 		 
			 //Writes the photo to the server 
			 if(move_uploaded_file($_FILES['file']['tmp_name'], $target)) 
			 { 			 
				 //Tells you if its all ok 
				 //echo "The file ". basename( $_FILES['file']['name']). " has been uploaded as " . $newName.".".$ext. ", and your information has been added to the directory."; 

				 //Writes the information to the database 
				 mysql_query("INSERT INTO `questions`(`department`, `year`, `semester`, `exam`, `subject_code`) 
									VALUES ('$fcourse','$fyear','$fsemester','$fexam','$fsubject_code')");

				//$sqlMail="SELECT `question_id` FROM `question` WHERE (`department`='$fcourse' AND `year`='$fyear' AND `semester`='$fsemester' AND `exam`='$fexam' AND `subject_code`='$fsubject_code')";
				//$resultMail=mysql_query($sqlMail);
				//$rowMail=mysql_fetch_array($resultMail);
				//$qID=$rowMail['question_id'];
				//header("Location: sendMail.php?id=$qID");			
				echo "
				 	<script>
					 	bootbox.alert('Upload Succesful', function() {
							document.location.href='questionUpload.php';
						});			 		
				 	</script>
				 "; 	
				//header("Location: questionUpload.php");				
				
			 } 
			 else { 				 
				 //Gives and error if its not 
				 echo "
				 	<script>
				 		bootbox.alert('Sorry, an upload error occured. Please try again later.', function() {
							document.location.href='questionUpload.php';
						});				 		
				 	</script>
				 "; 
			 } 
			 
		}
 //////////////File Entry End
	}
	//mysql_close($con);
?>