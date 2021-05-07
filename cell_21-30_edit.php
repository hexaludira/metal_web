<?php include "head.php" ?>
<script language=javascript>
setTimeout("location.href='http://10.10.10.137/adidas/cell_31-40'", 10000);
</script>
<!-- Main content -->
<div class="content-header">
   <p class="text-center" style="font-size: 20px">
      <b>CELL 21 - 30</b> (<?php echo date('Y-m-d');?>)
   </p>
</div>
<section class="content" style="padding-top: 0px">
   <div class="row">
      
      <?php
      $cell_awal = 21;
      $cell_akhir = 25;
      for($i = $cell_awal; $i<= $cell_akhir; $i++){
      $d=mysqli_query($con,"SELECT dates, no_cell, pass, detect, error,total FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      // $d=mysqli_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
      $r=mysqli_fetch_array($d);
      ?>
      <div class="col-md-3" style="width: 20%">
         <table class="table" style="background-color: #e9e9e9;">
            <tr>
               <th colspan="3" class="text-center" style="font-size: 20px"> CELL <?php echo $i; ?></th>
            </tr>
            <tr>
               <td>07.00</td>
               <td>
                  <?php
                  //CALIBRASI JAM 7
                  $a=mysqli_query($con,"SELECT no_cell, cal_ok, dates FROM data_real_time WHERE no_cell=$i AND cal_ok = 1 AND DATE_FORMAT(dates,'%H')=7 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $b=mysqli_fetch_array($a); ?>
                  
                  <i class="btns btn-dangers btn-circle"></i>
               </td>
               <td rowspan="2" style="background-color: #009ABF;color: #fff"><b>PASS</b><br><p class="pull-right" style="font-size: 30px"><b><?php if ($r['pass']) {echo $r['pass'];} else {echo "0";} ?></b></p></td>
            </tr>
            <tr>
               <td>09.00</td>
               <td>
                  <?php
                  //CALIBRASI JAM 9
                  $a=mysqli_query($con,"SELECT no_cell, cal_ok, dates FROM data_real_time WHERE no_cell=$i AND cal_ok = 1 AND DATE_FORMAT(dates,'%H')=9 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $b=mysqli_fetch_array($a); ?>
                  
                  <i class="btns btn-dangers btn-circle"></i>
               </td>
               
            </tr>
            <tr>
               <td>11.00</td>
               <td>
                  <?php
                  //CALIBRASI JAM 11
                  $a=mysqli_query($con,"SELECT no_cell, cal_ok, dates FROM data_real_time WHERE no_cell=$i AND cal_ok = 1 AND DATE_FORMAT(dates,'%H')=11 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $b=mysqli_fetch_array($a); ?>
                  
                  <i class="btns btn-dangers btn-circle"></i>
               </td>
               <td rowspan="2" style="background-color: #da5550;color: #fff"><b>DETECT</b><br><p class="pull-right" style="font-size: 30px"><b><?php if ($r['detect']) {echo $r['detect'];} else {echo "0";} ?></b></p></td>
            </tr>
            <tr>
               <td>13.00</td>
               <td>
                  <?php
                  //CALIBRASI JAM 13
                  $a=mysqli_query($con,"SELECT no_cell, cal_ok, dates FROM data_real_time WHERE no_cell=$i AND cal_ok = 1 AND DATE_FORMAT(dates,'%H')=13 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $b=mysqli_fetch_array($a); ?>
                  
                  <i class="btns btn-dangers btn-circle"></i>
               </td>
               
            </tr>
            <tr>
               <td>15.00</td>
               <td>
                  <?php
                  //CALIBRASI JAM 15
                  $a=mysqli_query($con,"SELECT no_cell, cal_ok, dates FROM data_real_time WHERE no_cell=$i AND cal_ok = 1 AND DATE_FORMAT(dates,'%H')=15 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $b=mysqli_fetch_array($a); ?>
                  <?php if ($b) { ?>
                  <i class="btns btn-dangers btn-circle"></i>
                  <?php } else {?>
                  <i class="btns btn-defaults btn-circle"></i>
                  <?php }?>
               </td>
               <td rowspan="2" style="background-color: #f2aa56;color: #fff"><b>ERROR</b><br><p style="font-size: 30px" class="pull-right"><b><?php echo "0"; //if ($r['error']) {echo $r['error'];} else {echo "0";} ?></b></p></td>
            </tr>
            <tr>
               <td colspan="2" style="font-size:14px" class="text-center"><b>CALIBRATION</b></td>
            </tr>
         </table>
      </div>
      <?php } ?>
      
   </div>
</section>
<!-- /.content -->
<?php include "foot.php" ?>