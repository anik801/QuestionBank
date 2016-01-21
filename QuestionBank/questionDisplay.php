<?php
  if(isset($_GET['file'])){  	
	  $file = "files/".$_GET['file'];
	  $filename = "files/".$_GET['file'];
	  header('Content-type: application/pdf');
	  header('Content-Disposition: inline; filename="' . $filename . '"');
	  header('Content-Transfer-Encoding: binary');
	  header('Accept-Ranges: bytes');
	  @readfile($file);
	
  }
?>