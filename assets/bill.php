<?php 
if (sizeOf($_SESSION['bill']) == '0') 
{
	$display = 'display:none';
}else
$display ='';
 ?>


<div class="well well-lg" id="bill" style="position: absolute;
    right: 300px;
    top: 0;
    width: 355px;
    margin-top: 100px;<?php echo $display ?>">
	
	<span class="badge"><input type="text" id="counter" value="<?php echo sizeOf($_SESSION['bill']); ?>" readonly style='width: 33px;color: black;padding:2px;border-radius: 5px;'></span> selected <a href="billing.php"><button class="btn btn-primary btn-xs">View Bill</button></a>
<a href='clear.php?url=<?php echo $_SERVER['PHP_SELF']; ?>'><button class="btn btn-danger btn-xs">Clear</button></a>
</div>