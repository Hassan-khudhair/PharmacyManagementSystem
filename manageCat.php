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
  if (isset($_POST['safeIn'])) 
  {
    $filename = $_FILES['inPic']['name'];
    move_uploaded_file($_FILES["inPic"]["tmp_name"], "photo/".$_FILES["inPic"]["name"]);
    if ($con->query("insert into categories (name,pic) value ('$_POST[inName]','$filename')")) {
      $notice ="<div class='alert alert-success'>تم الاضافة بنجاح</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>خطأ:".$con->error."</div>";
  }

   ?>
</head>
<body>
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
      <li class="active">ادارة التصنيفات</li>
    </ol>
    <?php echo $notice; ?>
    <!-- <div class="content-category2"> -->
    <div class="category-style">
    <!-- <span style="">التصنيفات </span>
      <a href="manageCat.php"><button data-toggle="modal" data-target="#addIn"><i class="fa fa-gear  fa-fw"> </i>اضافة تصنيف جديد</button></a> -->
      <span >التصنيفات </span>
      <button data-toggle="modal" data-target="#addIn"><i class="fa fa-plus fa-fw"> </i>اضافة تصنيف جديد</button> 
     

    </div>

  <?php 
  	$i=0;
    $array = $con->query("select * from categories");
    ?>
    <br>
    <table class="table table-hover table-striped " style="width: 55%;margin: auto;">
    	<tr>
    		<th style="text-align:right">التسلسل</th>
    		<th style="text-align:right">الاسم</th>
    		<th style="text-align:right">كمية الادوية</th>
    		<th style="text-align:right">تحرير</th>
    	</tr>
    <?php
    while ($row = $array->fetch_assoc()) 
    {
    	$i++;
      $array2 = $con->query("select count(*) as qty from inventeries where catId = '$row[id]'");
      $row2 = $array2->fetch_assoc();
  ?>
    <tr>
    	<td><?php echo $i ?></td>
    	<td><?php echo $row['name']; ?></td>
    	<td><?php echo $row2['qty']; ?></td>
    	<td><a href="delete.php?category=<?php echo $row['id'] ?>"><button class="btn btn-xs btn-danger">حذف</button></a></td>
    </tr>
    
  <?php
    }
    echo "</table>";
   ?>
   <!-- </div> -->
  </div>
</div>

<div id="addIn" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">اضافة تصنيف جديد</h4>
      </div>
      <div class="modal-body"> <form method="POST" enctype="multipart/form-data">
        <div style="width: 77%;margin: auto;">
         
          <div class="form-group">
            <label for="some" class="col-form-label">الاسم</label>
            <input type="text" name="inName" class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="2" class="col-form-label">الصورة</label>
            <input type="file" name="inPic" class="form-control" id="2" required>
          </div>
          
       
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
        <button type="submit" class="btn btn-primary" name="safeIn">اضافة </button>
      </div>
    </form>
    </div>

  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

