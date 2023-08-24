<?php
session_start();

if(!isset($_SESSION['userId']))
{
  header('location:login.php');
}
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<script src="https://kit.fontawesome.com/24db1592a4.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://kit.fontawesome.com/24db1592a4.css" crossorigin="anonymous">
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
 <?php 
 $notice="";
if (isset($_POST['saveSetting'])) {
if ($con->query("update site SET title='$_POST[title]',name='$_POST[name]'")) {
  $notice ="<div class='alert alert-success'>تم الحفظ بنجاح</div>";
}
else{
  $notice ="<div class='alert alert-danger'>خطا:".$con->error."</div>";
}
}

 ?>
</head>
<body >
<div class="dashboard">
  <div class="header">
    <a href="index.php"><?php echo strtoupper(siteName()); ?> </a>
  </div>
  <div class="info-doc">
    <div><img src="photo/<?php echo $user['pic'] ?>" ></div>
    <div class="name-doc"><?php echo ucfirst($user['name']); ?></div>
  </div>
  <div class="main-menu">القائمة</div>
  <div>
    <div class="main-side">
      <ul>
      <a href="dashbord.php"><li ><i class="fa-solid fa-house"></i> <p> الرئيسية</p> </li></a>
      <a href="index.php"><li ><i class="fa-solid fa-table"></i> <p> التصنيفات</p> </li></a>        <a href="inventeries.php"><li><i class="fa-solid fa-kit-medical"></i> <p> الادوية</p>  </li></a>
        <a href="addnew.php"><li><i class="fa-solid fa-notes-medical"></i><p>  اضافة دواء جديد</p> </li></a>      
        <a href="billing.php"><li><i class="fa-solid fa-receipt"></i><p> فاتورة</p></li></a>
        <a href="accountSetting.php"><li><i class="fa-solid fa-user-gear"></i> <p>   ادارة الحساب</p> </li></a>
        <a href="sitesetting.php"><li><i class="fa-solid fa-screwdriver-wrench"></i> <p>الاعدادات </p></li></a>
        <a href="logout.php"><li class="logout"><i class="fa-solid fa-right-to-bracket"></i><p>   تسجيل الخروج</p></li></a>
      </ul>
    </div>
  </div>
</div>
<div class="left-side" >
  <div class="navbar">
      <div><img class="pic" src="photo/<?php echo $user['pic'] ?>" ></div>
      <div ></div><?php echo ucfirst($user['name']) ?></div>
    <div class="clear"></div>
  </div>
  <div class="content-category">
  	<ol class="header-contnet-path ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> الرئيسية/</a></li>
        <li class="active">اعدادات النظام</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 55%;margin: auto;padding: 22px;" class="well well-sm center">

      <h4>اعدادات النظام</h4><hr>
      <form method="POST">
         <div class="form-group">
            <label for="some" class="col-form-label">عنوان النظام</label>
            <input type="text" name="title" class="form-control" value="<?php echo siteTitle() ?>" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label"> اسم الصيدلية</label>
            <input type="text" name="name" value="<?php echo siteName() ?>" class="form-control" id="some"  required>
          </div> 
          <div class="center">
            <button class="btn btn-primary btn-sm btn-block" name="saveSetting">حفظ</button>
          </div>   
        </form>
    </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

