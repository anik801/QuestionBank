function logInCheck(){
	if($("#username").val()!== "" || $("#password").val()!==""){
		//alert($("#username").val());
		$("#submitButton").trigger('click');
	}else{
		alert("Enter a valid username/password");
	}
}

function logOut(){
	//$("#logOutButton").trigger('click');
	bootbox.confirm("Are you sure?", function(result) {
		if(result){
			$("#logOutButton").trigger('click');
		}
	}); 
}

function questionInputCheck(){
	//bootbox.alert("Hello world!");
	courseVar = document.myForm.course.value;
	yearVar = document.myForm.year.value;
	semesterVar = document.myForm.semester.value;
	examVar = document.myForm.exam.value;
	subject_codeVar = document.myForm.subject_code.value;
	fileVar = document.myForm.file.value;
	
	if(yearVar==""){
		bootbox.alert("Year required.");
		$("#year").focus();
		return;
	}else if(yearVar.length !==4 || !isInt(yearVar)){
		bootbox.alert("Enter a valid year.");
		$("#year").focus();
		return;
	}else if(subject_codeVar==""){
		bootbox.alert("Subject Code required.");
		$("#subject_code").focus();
		return;
	}else if(fileVar==""){
		bootbox.alert("Input file required.");
		$("#file").focus();
		return;

	}else{
		show();
	}
}

function isInt(n) {
   return n % 1 === 0;
}

function show()
{
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
	
courseVar = document.myForm.course.value;
yearVar = document.myForm.year.value;
semesterVar = document.myForm.semester.value;
examVar = document.myForm.exam.value;
subject_codeVar = document.myForm.subject_code.value;
	  
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState===4 && xmlhttp.status===200)
    {
		document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
		id=$.trim($("#txtHint").text());
		if(id!==""){
			if(confirm("Question already exists.\nDo you want to replace the existing file?")===true){
				//delete previous entry
				if(removeQuestion(id)===true){
					//alert for delay
					alert("Operation Complete");	
					//upload new file
					newUpload();
				}
			//else do nothing
			}else{
				//alert("noting");
			}
			
		}else{						
			//No previous version found, upload new
			newUpload();
		}
    }
  }
xmlhttp.open("GET","findDuplicateQuestion.php?course="+courseVar+"&year="+yearVar+"&semester="+semesterVar+
				"&exam="+examVar+"&subject_code="+subject_codeVar,true);
xmlhttp.send();
}


function removeQuestion(str){
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	  
	//alert(str);
    xmlhttp.open("post", "deleteQuestion.php?q="+str, true);
	xmlhttp.send();
	return true;
}
function newUpload(){
	$("#submit").trigger('click');
}



function checkCommentInput(){
	if($("#name").val()==""){
		bootbox.alert("Please enter your name.", function() {		
		});	
	}else if($("#data").val()===""){
		bootbox.alert("Plase enter you comment.", function() {		
		});
	}else if($("#email").val()===""){
		bootbox.alert("Plase enter you email address.", function() {		
		});
	}else if(emailCheck($("#email").val())){
		$("#submit").trigger('click');
	}	
}

function emailCheck(x) {
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        bootbox.alert("Plase enter a valid email address.", function() {		
		});
        return false;
    }else{
    	return true;
    }
}

function deleteCommentCheck(commentID){
	bootbox.confirm("Are you sure you want to delete this comment?", function(result) {
		if(result){
			link=$("#link").val();
			id=$("#questionID").val();
			str="showPdf.php?file="+link+"&qID="+id+"&cID="+commentID;
			document.location.href=str;
		}
	}); 
}

function deleteQuestionCheck(questionID,departmentName){
	bootbox.confirm("Are you sure you want to delete this question?", function(result) {
		if(result){
			str="questionView.php?dept="+departmentName+"&qID="+questionID;
			document.location.href=str;
		}
	}); 
}

function checkAccountUpdateInput(){
    bootbox.confirm("Are you sure you want to update your account information?", function(result) {
		if(result){
			if($("#newPassword").val()!==$("#newPasswordRetype").val()){
	    		bootbox.alert("passwords do not match!", function() {		
					});
	    	}else if($("#newPassword").val()==="" && $("#newPasswordRetype").val()===""){
	    		$("#submit").trigger('click');
	    	}else{
	    		var value = document.getElementById('newPassword').value;
	    		var len=value.length;
	    		//alert(len);
	    		if(len<8){
	    			bootbox.alert("Please enter a password of atleast 8 digits/letters", function() {		
					});
	    		}else{
	    			$("#submit").trigger('click');
	    		}
	    	}
		}
	}); 
}