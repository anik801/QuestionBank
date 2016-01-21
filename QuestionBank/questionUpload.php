<?php
	session_start();
	ob_start();
	include 'mask.php';	
	include 'questionUploadFunctions.php';
?>



<!DOCTYPE html>
<html>

<head>
	<title>Entry</title>
</head>

<body>
<div id="bodyDiv">
	<div class="row" id="textBox">
	<p align="center">
		This is the question upload page. You must fill all the input fields correctly to insert a question into the system. If it conflicts with a previously uploaded question we will ask you for your decision of overwriting it.
	</p>
	</div>
	
	
	<div id="wrapper" style="text-align: center">  
	<div id="box">

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data" name="myForm" id="myForm">
    	<table id="tableBox" class='table table-striped'>
        	<thead>
            	<th colspan="2"><h3>Entry Form</h3></th>
            </thead>
            <tbody>
            	<tr>
                	<td>Course</td>
                    <td>
                    	<select class="form-control" name="course" id="course">
                        	<option>Architecture</option>
                            <option>Business Administration</option>
                            <option>Civil Engineering</option>
                            <option>Computer Science and Engineering</option>
                            <option>Electrical and Electronic Engineering</option>
                            <option>Textile Technology</option>
                            <option>Industrial and Production Engineering</option>
                            <option>Mechanical Engineering</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>Year</td>
                    <td>
                    	<input class="form-control" placeholder="eg: 2002" type="text" maxlength="4" name="year" id="year"/>
                    </td>
                </tr>
                <tr>
                	<td>Semester</td>
                    <td>
                    	<select class="form-control" name="semester" id="semester">
                        	<option>Fall</option>
                            <option>Spring</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>Exam</td>
                    <td>
                    	<select class="form-control" name="exam" id="exam">
                        	<option>Final</option>
                            <option>Carry_Clearance</option>
                        </select>
                    </td>
                </tr>
                <tr>
                	<td>Subject Code</td>
                    <td>
                    	<input  placeholder="eg: 2209" class="form-control" type="text" maxlength="10" name="subject_code" id="subject_code"/>
                    </td>
                </tr>
                <tr>
                	<td>File</td>
                    <td>
                    	<input type="file" name="file" id="file"/>
                    </td>
                </tr>
            </tbody>
        </table>        
		<input type="submit" value="Submit" name="submit" id="submit" style="display:none"/>
        <input type="button" id="bt2" value="Submit" onClick="questionInputCheck()"class="btn btn-primary"/>
        <button type="reset"class="btn btn-danger">Reset All</button>
        <a href="index.php">
			<button type="button"class="btn btn-primary">Back</button>
        </a>
        
    </form>   
	</div>
	</div>

	<input type="text" id="txtHint" style="display:none">
</div>
</body>


</html>