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
<html lang="ar" dir="rtl" >
<head>
  <meta charset="UTF-8">
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
      $notice ="<div class='alert alert-success'>Successfully Saved</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>Not saved Error:".$con->error."</div>";
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
        <a href="index.php"><li ><i class="fa-solid fa-table"></i> <p> التصنيفات</p> </li></a>
        <a href="inventeries.php"><li><i class="fa-solid fa-kit-medical"></i> <p> الادوية</p>  </li></a>
        <a href="addnew.php"><li><i class="fa-solid fa-notes-medical"></i><p>  اضافة دواء جديد</p> </li></a>      
        <a href="billing.php"><li><i class="fa-solid fa-receipt"></i><p> فاتورة</p></li></a>
        <a href="accountSetting.php"><li><i class="fa-solid fa-user-gear"></i> <p>   ادارة الحساب</p> </li></a>
        <a href="sitesetting.php"><li><i class="fa-solid fa-screwdriver-wrench"></i> <p>الاعدادات </p></li></a>
        <a href="logout.php"><li class="logout"><i class="fa-solid fa-right-to-bracket "></i><p>   تسجيل الخروج</p></li></a>
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
            <li><a href="index.php"><i class="fa fa-dashboard"></i> الداشبورد</a></li>
        </ol>
        <?php echo $notice ?>



     
        <?php
          
          $sql = "SELECT * from inventeries";
          if ($result = mysqli_query($con, $sql)) {
          
              // Return the number of rows in result set
              $countInvestries = mysqli_num_rows( $result );
          }
            
        ?>

        <?php
          $sql = "SELECT * from sold";
          if ($result = mysqli_query($con, $sql)) {
          
              // Return the number of rows in result set
              $countReprots = mysqli_num_rows( $result );
          }
        ?>
        <?php
          $sql = "SELECT * from categories";
          if ($result = mysqli_query($con, $sql)) {
          
              // Return the number of rows in result set
              $countcategory = mysqli_num_rows( $result );
          }
        ?>
        <?php
          $sql = "SELECT * from inventeries WHERE expdate < CURRENT_TIMESTAMP";
          if ($result = mysqli_query($con, $sql)) {
          
              // Return the number of rows in result set
              $expired = mysqli_num_rows( $result );
          }
        ?>

          <div class="rebort-box">
            <div class="count-reborts">
              <a href="inventeries.php">
                <div class="count">
                  <h3><i class="fa-solid fa-sort-up"></i> <span><?php echo $countInvestries ?></span> </h3>
                  <p> الادوية </p>
                </div>
              </a>
              <a href="expdate.php">
                <div class="count">
                  <h3><i class="fa-solid fa-sort-up"></i> <span><?php echo $expired ?></span> </h3>
                  <p>منتهي الصلاحية</p>
                </div>
              </a>
              <a href="reports.php">
                <div class="count">
                  <h3><i class="fa-solid fa-sort-up"></i> <span><?php echo $countReprots ?></span> </h3>
                  <p>الفواتير</p>
                </div>
              </a>
              <a href="index.php">
                <div class="count">
                  <h3><i class="fa-solid fa-sort-up"></i> <span><?php echo $countcategory ?></span> </h3>
                  <p>التصنيفات</p>
                </div>
              </a>
            </div>
            <hr style="border-top: 2px solid #ff5252;">
            <div class="pages-move">
              <a href="billing.php">
                <div class="pages">
                  <i class="fa-solid fa-receipt"></i>
                  <p> انشاء فاتورة </p>
                </div>
              </a>
              <a href="addnew.php">
                <div class="pages">
                  <i class="fa-solid fa-notes-medical"></i>
                  <p> اضافة دواء جديد </p>
                </div>
              </a>
              <a href="index.php">
                <div class="pages">
                  <i class="fa-solid fa-table"></i>
                  <p> التصنيفات </p>
                </div>
              </a>
              <a href="inventeries.php">
                <div class="pages">
                  <i class="fa-solid fa-kit-medical"></i>
                  <p> الادوية </p>
                </div>
              </a>
              <a href="reports.php">
                <div class="pages">
                  <i class="fa-solid fa-receipt"></i>
                  <p>  الفواتير </p>
                </div>
              </a>
              <a href="accountSetting.php">
                <div class="pages">
                  <i class="fa-solid fa-user-gear"></i>
                  <p> ادارة الحساب </p>
                </div>
              </a>
              
            </div>

          </div>
      </div>
    </div> 
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
</script>

