<?php
  ob_start();
  if(isset($_POST['searchSubmit'])){
    $searchKey=$_POST['searchData'];    
    header("Location: searchPage.php?data=$searchKey");
  }
  if(isset($_POST['submitButton'])){
    require 'myConnection.php';
    $username=$_POST['username'];
    $pass=$_POST['password'];    
      $sql2="SELECT * FROM `admin_accounts` WHERE `username`='$username' AND password='$pass'";
      $result2=mysql_query($sql2);
      if(mysql_num_rows($result2)>0){
        $row2=mysql_fetch_array($result2);
        echo $row2['admin_id'];
        $_SESSION['id']=$row2['admin_id'];  
        echo '<script>document.location="index.php";</script>';       
      }else{
        echo "<script>alert('Username or password does not match ');</script>";
      }    
  }else if(isset($_POST['logOutButton'])){
      session_destroy();            
      header("Location:index.php"); 
  }
?>

<!DOCTYPE html>
<html>

<head>  
  <link rel="stylesheet" type="text/css" href="apiFiles/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="apiFiles/bootstrap-theme.css">
  <script type="text/javascript" src="apiFiles/jquery-1.10.2.min.js"></script>
  <script type="text/javascript" src="apiFiles/bootstrap.js"></script>
  <script type="text/javascript" src="apiFiles/bootbox.js"></script>
  <link rel="stylesheet" type="text/css" href="apiFiles/simple-sidebar.css">
  <link rel="stylesheet" type="text/css" href="apiFiles/dashboard.css">

  <link rel="icon" href="images/logo.ico">
  <link rel="stylesheet" type="text/css" href="css/maskStyle.css">
  <script type="text/javascript" src="scripts/myscripts.js"></script>
  <link rel="stylesheet" type="text/css" href="css/pageStyle.css">

  <script type="text/javascript">
  $(document).ready(function(){
      $(".tooltip-examples a").tooltip({
          placement : 'buttom'
      });
  });
  </script>
  <style type="text/css">
    .bs-example{
        margin: 100px 50px;
      }
  </style>

</head>



<body>
    <div class="navbar navbar-inverse navbar-fixed-top"role="navigation">
      
      <div class="container-fluid">
<?php
  if(isset($_SESSION['id'])){
    require 'myConnection.php';
    echo'
        <div class="navbar-header" id="topBar">        
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="images/austLogo.png" height="100px" /> <label id="titleLabel">AUST Question Bank</label></a>

        </div>
        
        <div class="navbar-collapse collapse" >

          <ul class="nav navbar-nav navbar-right" >
            <li style="margin-top:0.5%;margin-right:2%">  
            ';
            ?> 
            <form class="navbar-form navbar-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
              <input type="text" name="searchData" id="searchData" class="form-control" size="40" placeholder="Search here.">
              <input class="btn btn-primary" type="submit" id="searchSubmit" name ="searchSubmit" value="Search"/>     
            </form>

            <?php
            echo'
            </li>

            <li id="listedItem" ><a href="questionUpload.php"><button class="btn btn-sm btn-warning">New Upload</button></a></li>
            ';
            $sql="SELECT comment_id FROM comments WHERE status='0'";
            $result=mysql_query($sql);
            if(mysql_num_rows($result)>0){
              $num = mysql_num_rows($result);
              echo'
            <li id="listedItem" ><a href="notificationPage.php"><button class="btn btn-sm btn-success" title="'.$num.' new comment(s)" data-toggle="tooltip">Notifications</button></a></li>';
            }else{
              echo'
            <li id="listedItem" ><a href="notificationPage.php"><button class="btn btn-sm btn-default" title="No new notifications." data-toggle="tooltip">Notifications</button></a></li>';            
            }
          echo '
          <li id="listedItem" ><a href="accountInfo.php"><button class="btn btn-sm btn-default">Account</button></a></li>
          </ul>
        </div>
    ';
  }else{
    echo '
        <div class="navbar-header" id="topBar">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="images/austLogo.png" height="100px" /> <label id="titleLabel">AUST Question Bank</label></a>
        </div>
        
        <div class="navbar-collapse collapse">';
        ?>

          <form class="navbar-form navbar-right" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="text" name="searchData" id="searchData" class="form-control" size="40" placeholder="Search here.">
            <input class="btn btn-primary" type="submit" id="searchSubmit" name ="searchSubmit" value="Search"/>     
          </form>
        <?php
        echo '
        </div>
    ';
       
  }
?>
      </div>

    </div>

    

	<div class="" id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li class="sidebar-brand"><a href="#">Departments</a></li>
                <li><a href="questionView.php?dept=Architecture">Architecture</a></li>
                <li><a href="questionView.php?dept=Textile Technology">Textile</a></li>
                <li><a href="questionView.php?dept=Civil Engineering">Civil</a></li>
                <li><a href="questionView.php?dept=Business Administration">BBA</a></li>
                <li><a href="questionView.php?dept=Computer Science and Engineering">CSE</a></li>
                <li><a href="questionView.php?dept=Electrical and Electronic Engineering">Electrical</a></li>
                <li><a href="questionView.php?dept=Industrial and Production Engineering">IPE</a></li>
                <li><a href="questionView.php?dept=Mechanical Engineering">MPE</a></li>
            </ul>
        </div>

    </div>

    <div id="foot">
    <div id="footer">
      <div class="container">
        <p class="text-muted" align="right">A product by team Haunted.
        <?php
          if(!isset($_SESSION['id'])){
            echo '<a class="btn btn-xs btn-default" href="#signinForm" role="button" data-toggle="modal" id="signInButton">Admin</a>';
          }else{
            echo '<input type="button" class="btn btn-xs btn-danger" role="button" id="signOutButton" value="Log Out" onClick="logOut();" /></p>';
          }
        ?> 
        </p>         
      </div>
    </div>
    </div>

    <!-- Custom JavaScript for the Menu Toggle -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });
    </script>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <input type="submit" id="logOutButton" name="logOutButton" style="display:none">
    </form>

<div class="modal fade" id="signinForm">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <div class="modal-dialog" id="signinDialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
          <h4 class="modal-title">Sign In</h4>
        </div>
        <div class="modal-body">
          <input class="form-control" id="username" name="username" placeholder="User Name" required type="text">
          <input class="form-control" id="password" name="password" placeholder="Password" required type="password">
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn btn-default">Close</a>      
          <input type="button" value="Log In" class="btn btn-primary" id="inputButton" onClick="logInCheck();"/>
          <input type="submit" id="submitButton" name ="submitButton" value="signIn" style="display:none"/>     
        </div>
      </div>
    </div>
  </form> 
</div>


</body>
</html>
