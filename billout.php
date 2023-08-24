<?php
session_start();
require_once "cart.php";
require_once "assets/db.php";
if(!isset($_SESSION['userId']))
{
  header('location:login.php');
  die();
}
if(!isset($_SESSION['cart'])){
  header('location:billing.php');
  die();
}
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  checkout($_SESSION['cart'],$con);
}
 ?>
<?php require "assets/function.php" ?>
<?php require 'assets/db.php';?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
  <?php 
  $notice="";

   ?>
</head>
<body style="background: #ECF0F5;padding:0;margin:0">

  <div class="content2">
  	<div class="well well-sm" style="width: 77%;margin:auto;margin-top: 33px;">
      <div class="well well-sm center">
        <h1><?php echo siteName(); ?></h1>
      </div> 
    </div>
    <br>
    <div class="well well-sm" style="width: 77%;margin: auto;">
      <table class="table table-bordered table-striped">
        
        <tr>
          <th>تاريخ انشاء الفاتورة:</th>
          <td><?php echo date("Y-m-d h:i:sa"); ?></td>
          <th>تم انشاء الفاتورة بواسطة</th>
          <td><?php echo adminName(); ?></td>
        </tr>
        <tr>
          <th colspan="4" class="center"><h3>تفاصيل الطلب</h3></th>
        </tr>
          <tr>
        <th>التسلسل</th>
        <th>اسم الطلب</th>
        <th>سعر القطعة</th>
        <th>الكمية</th>
      </tr>
        <?php



        $i=$total=0;

        
    foreach($_SESSION['cart']['products'] as $row) 
    {
      $i++;
      echo "<tr>";
      echo "<td>$i</td>";
      echo "<td>{$row['medicine_name']}</td>";
      echo "<td>IQD. {$row['price']}</td>";
      echo "<td>{$row['qty']}</td>";
      echo "</tr>";
    }
  ?>
  <tr>
    <td colspan="3" style="text-align: right;">المجموع الكلي	</td><th> IQD. <?php echo $_SESSION['cart']['total']; ?></th>
  </tr>
  <tr>
    <td class="center" colspan="4"><button type='button' class="btn btn-primary" id="print" >طباعة</button><button class="btn btn-success">العودة</button></a></td>
  </tr>
      </table>
    </div>
  </div>

  

<div id="billOut" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">معلومات المشتري</h4>
      </div>
      <div class="modal-body"> <form method="POST" action="billout.php">
        <div style="width: 77%;margin: auto;">
         
          <div class="form-group">
            <label for="some" class="col-form-label">الاسم</label>
            <input type="text" name="name" class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">رقم الهاتف</label>
            <input type="text" name="contact" class="form-control" id="some" required>
          </div>
       
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
        <button type="submit" class="btn btn-primary" name="safeIn">اكمال الفاتورة</button>
      </div>
    </form>
    </div>

  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
  $(document).ready(function(){
        $('#print').click(function(){
          
          $.ajax({
            url:"billout.php",
            method:"POST",

            success:function(data){
              console.log(data);
              window.print();
            }
          });
      
        })
      });
</script>