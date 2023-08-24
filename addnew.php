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
    if ($con->query("insert into categories (name,pic) value ('$_POST[name]','$filename')")) {
      $notice ="<div class='alert alert-success'>تم اضافة الدواء بنجاح</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>خطا :".$con->error."</div>";
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

<?php 
if (isset($_POST['saveProduct'])) {
if ($con->query("insert into inventeries (catId,generic_name,medicine_name,barcode,expdate,supplier,unit,price,quantity,description,company) values ('$_POST[catId]','$_POST[generic_name]','$_POST[medicine_name]','$_POST[barcode]','$_POST[expdate]','$_POST[supplier]','$_POST[unit]','$_POST[price]','$_POST[quantity]','$_POST[discription]','$_POST[company]')")) {
  $notice ="<div class='alert alert-success'>تم اضافة الدواء بنجاح</div>";
}
else{
  $notice ="<div class='alert alert-danger'>خطا:".$con->error."</div>";
}
}

 ?>
  
  <div class="content-category">
  	<ol class="header-contnet-path ">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> الرئيسية/</a></li>
        <li class="active">اضافة دواء جديد</li>
    </ol>
    <?php echo $notice ?>
    <div style="width: 100%;margin: auto;padding: 22px;" class="well well-sm center ">

      <h4>اضافة دواء جديد</h4><hr>
      <form method="POST" class="form-adding">
         <div class="form-group-addnew">
            <label for="some" class="col-form-label">باركود</label>
            <input type="number" name="barcode" class="form-control" id="some" required>
          </div>
         <div class="form-group-addnew">
            <label for="some" class="col-form-label">الاسم العام</label>
            <input type="text" name="generic_name" class="form-control" id="some" required>
          </div>
         <div class="form-group-addnew">
            <label for="some" class="col-form-label">الاسم الطبي</label>
            <input type="text" name="medicine_name" class="form-control" id="some" required>
          </div>
         <div class="form-group-addnew">
            <label for="some" class="col-form-label">تاريخ انتهاء الصلاحية</label>
            <input type="text" name="expdate" placeholder="2024-1-1" class="form-control" id="some" required>
          </div>
         <!-- <div class="form-group-addnew">
            <label for="some" class="col-form-label">MRP</label>
            <input type="text" name="MRP" class="form-control" id="some" required>
          </div> -->
          <div class="form-group-addnew">
            <label for="some" class="col-form-label">القوة</label>
            <input type="text" name="unit" placeholder="50mg" class="form-control" id="some" required>
          </div>
          <div class="form-group-addnew">
            <label for="some" class="col-form-label">سعر المنتج الواحد</label>
            <input type="number" name="price"  class="form-control" id="some" required>
          </div>
          <div class="form-group-addnew">
            <label for="some" class="col-form-label">الكميه</label>
            <input type="number" name="quantity"  class="form-control" id="some" required>
          </div>
          <div class="form-group-addnew">
            <label for="some" class="col-form-label">اسم المستورد</label>
            <input type="text" name="supplier"  class="form-control" id="some" required>
          </div>
          <div class="form-group-addnew">
            <label for="some" class="col-form-label">الشركة المصنعه للدواء</label>
            <input type="text" name="company"  class="form-control" id="some" required>
          </div>
          <div class="form-group-addnew">
            <label for="some" class="col-form-label">اختار تصنيف الدواء
            </label>
            <select class="form-control" required name="catId">
              <option selected disabled value="">الرجاء قم باختيار تصنيف الدواء</option>
            <?php getAllCat(); ?>
              
            </select>
          </div>
           <div class="form-group-addnew">
            <label for="some" class="col-form-label">وصف العلاج</label>
          <textarea class="form-control" name="discription" required placeholder="قم بكتابة وصف حول الدواء"></textarea> 
          </div>
          <div class="center">
            <button type="submit" name="saveProduct" class="btn btn-primary">حفظ</button>
            <button type="reset" class="btn btn-success">الغاء</button>
          </div>
        </form>
    </div>
</div>






</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

