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
<link rel="stylesheet" href="js/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="https://kit.fontawesome.com/24db1592a4.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://kit.fontawesome.com/24db1592a4.css" crossorigin="anonymous">
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>

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
        <li class="active">الفواتير</li>
    </ol>
  <div class="tableBox" >
    <table id="dataTable" class="table table-bordered table-striped" style="z-index: -1">
      <thead>
        <th>التسلسل</th>
        <th>المبلغ المستحق</th>
        <th>تم انشاء الفاتورة عن طريق:</th>
        <th>تاريخ انشاء الفاتورة</th>
        
      </thead>
     <tbody>
      <?php $i=0;
          $array = $con->query("select * from sold ORDER BY date DESC");
        while ($row = $array->fetch_assoc()) 
        { 
          $i=$i+1;
          $id = $row['id'];
        ?>
          <tr>
            <td><?php echo $i; ?></td>
            <td> IQD. <?php echo $row['amount']; ?></td>
            <td><?php echo getAdminName($row['userId']); ?></td>
            <td><?php echo $row['date']; ?></td>

            
          </tr>
      <?php
        }
       ?>
     </tbody>
    </table>
  </div>                      

  </div>  <!-- ending tag for content -->

</div> <!-- ending tag for margin left -->



</body>
</html>

<script type="text/javascript">
  function addInBill(id,place)
  { 
    var value = $("#counter").val();
    value ++;
    var selection = 'selection'+place;
    $("#bill").fadeIn();
    $("#counter").val(value);
    $("#"+selection).html("selected");
    $.post('called.php?q=addtobill',
               {
                   id:id
               }
        );

  }
  $(document).ready(function()
  {
    $(".rightAccount").click(function(){$(".account").fadeToggle();});
    $("#dataTable").DataTable();
   
  });
</script>

  <script src="js/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="js/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>