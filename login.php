<?php
ob_start(); 
?>
<?php require "assets/function.php" ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<?php require "assets/autoloader.php" ?>
	<style type="text/css">
	<?php include 'css/customStyle.css'; ?>
	
	</style>
</head>
<body style="background-color:#3b86e3">
	<div class="login-page">
  <div class="head-login">
  	<h3>Pharmacy Management System</h3>
  </div>
  <!-- /.login-logo -->
  <div class="form-login">
    <form action="" method="post" >
      <div class="input">
        <input type="email" name="email" placeholder="البريد الالكتروني" required  class="firstInp">
      </div>
      <div  class="input">
        <input type="password" name="password"  placeholder="كلمة المرور" required class="secondInp">
      </div>
    
      <button type="submit" name="login" >تسجيل الدخول</button>
    </form>
  </div>
  <br>
  <div class="alert alert-danger" id="error"  style="width: 25%;margin: auto;display: none;"></div>
  <div style="position: fixed;;top:0;background: rgba(0,0,0,0.7); width: 100%;height: 100%;z-index: -1"></div>

  <!-- /.login-box-body -->
</div>
</body>
</html>
<?php 
if (isset($_POST['login'])) 
{
	$user = $_POST['email'];
    $pass = $_POST['password'];
    $con = new mysqli('localhost','root','','store');
    $result = $con->query("select * from users where email='$user' AND password='$pass'");
    if($result->num_rows>0){	
    	session_start();
    	$data = $result->fetch_assoc();
    	$_SESSION['userId']=$data['id'];
      $_SESSION['bill'] = array();
    	header('location:dashbord.php');
      ob_enf_fluch();

    }else{
     	echo 
     	"<script>
     		\$(document).ready(function(){\$('#error').slideDown().html('Login Error! Try again.').delay(3000).fadeOut();});
     	</script>
     	";
    }
}
?>