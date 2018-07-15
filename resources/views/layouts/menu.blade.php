<?php
if (empty($menu)){
?>
<a class="btn btn-app pull-right ">
  <i class="fa fa-print"></i> พิมพ์
</a>     
<a class="btn btn-app pull-right ">              
  <i class="fa fa-search"></i> ค้นหา
</a>              
<a class="btn btn-app pull-right disabled  " >
  <i class="fa fa-check-square"></i> อนุมัติ
</a>     
<a class="btn btn-app pull-right ">
  <i class="fa fa-send-o"></i> ส่งอนุมัติ
</a>  
<a class="btn btn-app pull-right ">
  <i class="fa fa-save"></i> บันทึก
</a>  
<a class="btn btn-app pull-right ">
  <i class="fa fa-file-o"></i> เพิ่ม
</a> 
<?php
}else if  ($menu ==1){
?>

<a class="btn btn-app pull-right ">              
  <i class="fa fa-search"></i> ค้นหา
</a>      
<a class="btn btn-app pull-right ">
  <i class="fa fa-minus"></i> ลบ
</a>  
<a class="btn btn-app pull-right ">
  <i class="fa fa-save"></i> บันทึก
</a>  
<a class="btn btn-app pull-right ">
  <i class="fa fa-file-o"></i> เพิ่ม
</a> 
<?php
}else if  ($menu ==2){
?>

<a class="btn btn-app pull-right ">
  <i class="fa fa-save"></i> บันทึก
</a>  

<?php
}
?>


