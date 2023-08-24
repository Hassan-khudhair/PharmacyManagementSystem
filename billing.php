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
  <script src="./js/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/24db1592a4.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://kit.fontawesome.com/24db1592a4.css" crossorigin="anonymous">
  <title><?php echo siteTitle(); ?></title>
  <?php require "assets/autoloader.php" ?>
  <style type="text/css">
  <?php include 'css/customStyle.css'; ?>

  </style>
  <?php 
  require_once "cart.php";
  $notice="";
  if (isset($_POST['safeIn'])) 
  {
    $filename = $_FILES['inPic']['name'];
    move_uploaded_file($_FILES["inPic"]["tmp_name"], "photo/".$_FILES["inPic"]["name"]);
    if ($con->query("insert into categories (name,pic) value ('$_POST[inName]','$filename')")) {
      $notice ="<div class='alert alert-success'>تم الحفظ</div>";
    }
    else
      $notice ="<div class='alert alert-danger'>خطا:".$con->error."</div>";
  }

  if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = [
      'products' => [],
      'total' => 0,
      'count' => 0
  ];
  }
  if(isset($_POST['clear'])){
    resetCart($_SESSION['cart']);
  }
if(!empty($_GET['p_id']) && !empty($_GET['qty'])){
  add($_SESSION['cart'],$_GET['p_id'],$_GET['qty'],$con);
  unset($_GET['p_id']);
  unset($_GET['qty']);
  
}
if(!empty($_GET['removedFromCart'])){
  removeFromCart($_SESSION['cart'],$_GET['removedFromCart']);
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
        <li class="active">الفاتورة</li>
    </ol>
    <?php echo $notice; ?>
    

  <?php 
  if (isset($_POST['updateBill'])) 
  {
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    foreach ($_SESSION['bill'] as $key => $value) 
    {
      if($_SESSION['bill'][$key]['id'] == $id) $_SESSION['bill'][$key]['qty'] = $qty ; 
    }
  }
  	$i=0;$total = 0;
    ?>

    
    <form class="inputBarcode">
      <label for="">ادخل الباركود</label>
      <input type="number" id="search" autofocus>
    </form>

    <div id="output"></div>

    <script>
      $(document).ready(function(){
        $('#search').keypress(function (event){
          let input = $(this).val();
          let key = event.keyCode;
           if(key != 13){
             return;
           }
           $.ajax({
            url:"barcode.php",
            method:"POST",
            data:{input:input},
            
          });
        });
      });
        // $('#search').keyup(function(){
        //   let input = $(this).val();
        //   if(input != ""){
        //   $.ajax({
        //     url:"barcode.php",
        //     method:"POST",
        //     data:{input:input},

        //     success:function(data){
        //       $("#output").html(data);
        //       $("#output").css("display","block");
        //     }
        //   });
        // }
      //   else{
      //     $("#output").css("display","none");
      //   }
      //   })
      // });
    </script>




    <br>
    <table class="table table-hover table-striped table-bordered" style="width: 55%;margin:  auto; ">
    	<tr>
    		<th>التسلسل</th>
    		<th>اسم الدواء</th>
    		<th>سعر القطعة الوحدة</th>
    		<th>الكمية</th>
    	</tr>
    	
    <?php
    foreach ($_SESSION['cart']['products'] as $row) 
    {
      $i++;
      echo "<tr>";
      echo "<td>$i</td>";
      echo "<td>$row[medicine_name]</td>";
      echo "<td>IQD. $row[price]</td>";
      echo "<td> 
            <form method='POST'>
            <input type='hidden'  value='{$row['id']}' name='id'>
            <input type='number' onkeydown='updateQuantity({$row['id']},event)' id='qty-{$row['id']}' min='1' class='form-control input-sm pull-left' value ='$row[qty]' style='width:88px;' name='qty'>  
            </form>
            </td>";
      echo "</tr>";
      $total = $_SESSION['cart']['total'];
    
  }
  ?>
  <tr>
    <td colspan="1">اجمالي الفاتورة</td>
    <td colspan="1"><strong>IQD.<?php echo $total ?></strong></td>
    <td colspan="2" class="from-two-bottom">
      <a href="billout.php"><button class="btn btn-sm btn-primary btn-block"> طباعة الفاتورة</button></a>
      <form  method="post">
        <button name='clear' type='submit' class="btn btn-sm btn-danger btn-block " > حذف محتويات السلة </button>
        </form>
    </td>
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
            <input  type="text" name="name" class="form-control" id="some" required>
          </div>
          <div class="form-group">
            <label for="some" class="col-form-label">رقم الهاتف</label>
            <input type="text" name="contact" class="form-control" id="some" required>
          </div>
           <div class="form-group">
            <label for="some" class="col-form-label">الخصم</label>
            <input type="text" name="discount" value="0" min="1" class="form-control" id="some" required>
          </div>
       
        </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">الغاء </button>
        <button type="submit" class="btn btn-primary" name="billInfo">اكمال الفاتورة</button>
      </div>
    </form>
    </div>

  </div>
</div>

</body>
</html>

<script type="text/javascript">
  $(document).ready(function(){$(".rightAccount").click(function(){$(".account").fadeToggle();});});
  function updateQuantity(pid,event){
    if(event.key != 'Enter'){
      return;
    }   
    let Qty = $('#qty-' + pid).val();
    console.log(Qty);
    $.ajax({
            url:"barcode.php",
            method:"POST",
            data:{Qty:Qty,p_id:pid},


          });
  }
</script>


