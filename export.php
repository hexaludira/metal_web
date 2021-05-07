<?php include "head.php" ?>
<script language=javascript>
// setTimeout("location.href='http://localhost/adidasnew/cell_11-20'", 10000);
setTimeout("location.href='http://10.10.10.98/adidas/a_1-10'", 10000);
</script>
<!-- Main content -->
<div class="content-header">
   <p class="text-center" style="font-size: 20px">
      <b>Export</b> (<?php echo date('Y-m-d');?>)
   </p>
</div>
<section class="content" style="padding-top: 0px">
   <div class="row">
      
      <?php
      $cell_awal = 101;
      $cell_akhir = 103;
      
      for($i = $cell_awal; $i<= $cell_akhir; $i++){
        if ($i == '101') {$export = 'A';} else if ($i == '102') {$export = 'C';} else $export = 'D';
         //AMBIL DATA TERAKHIR DGN PASS MAX
      //$d=mysqli_query($con,"SELECT dates, no_cell, pass, detect, error,total FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$export') ORDER BY dates DESC LIMIT 1");
         $sql = "SELECT TOP 1 dates, no_cell, pass, detect, error,total FROM dbo.[data_real_time] WHERE pass=(SELECT max(pass) FROM dbo.[data_real_time] WHERE no_cell='$export') ORDER BY dates DESC";
         $sql_con = sqlsrv_query($con, $sql);
      //AMBIL DATA TERAKHIR
      //$d=mysqli_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
      //$r=mysqli_fetch_array($d);
      $r = sqlsrv_fetch_array($sql_con, SQLSRV_FETCH_BOTH);
      ?>
      <div class="col-md-3" style="width: 20%">
         <table class="table" style="background-color: #e9e9e9;">
            <tr>
               <th colspan="3" class="text-center" style="font-size: 20px"> <?php  echo 'Export ',$export;?></th>
            </tr>
            <tr>
               <td>1st</td>
               <td>
                  <?php
                  //CALIBRASI 1st
                  //$a=mysqli_query($con,"SELECT no_cell, cal_f_c, dates FROM data_real_time WHERE no_cell='$export' AND cal_f_c > 0 AND DATE_FORMAT(dates,'%H')=7 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $sql1 = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$export' AND cal_f_c > 0 AND DATEPART(HOUR, dates)=07 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $sql1_con = sqlsrv_query($con, $sql1);
                  $b=sqlsrv_fetch_array($sql1_con, SQLSRV_FETCH_BOTH); ?>
                  <?php if ($b) { ?>
                  <i class="btns btn-dangers btn-circle"></i>
                  <?php } else {?>
                  <i class="btns btn-defaults btn-circle"></i>
                  <?php }?>
               </td>
               <td rowspan="2" style="background-color: #009ABF;color: #fff"><b>PASS</b><br><p class="pull-right" style="font-size: 30px"><b><?php if ($b['pass']) {echo $b['pass'];} else {echo "0";} ?></b></p></td>
            </tr>
            <tr>
               <td>2nd</td>
               <td>
                  <?php
                  //CALIBRASI 2nd
                  //$a=mysqli_query($con,"SELECT no_cell, cal_f_c, dates FROM data_real_time WHERE no_cell='$export' AND cal_f_c > 0 AND DATE_FORMAT(dates,'%H')=9 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $sql1 = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$export' AND cal_f_c > 0 AND DATEPART(HOUR, dates)=09 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $sql1_con = sqlsrv_query($con, $sql1);
                  $b=sqlsrv_fetch_array($sql1_con, SQLSRV_FETCH_BOTH);
                   ?>
                  <?php if ($b) { ?>
                  <i class="btns btn-dangers btn-circle"></i>
                  <?php } else {?>
                  <i class="btns btn-defaults btn-circle"></i>
                  <?php }?>
               </td>
               
            </tr>
            <tr>
               <td>3rd</td>
               <td>
                  <?php
                  //CALIBRASI 3rd
                  //$a=mysqli_query($con,"SELECT no_cell, cal_f_c, dates FROM data_real_time WHERE no_cell='$export' AND cal_f_c > 0 AND DATE_FORMAT(dates,'%H')=11 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $sql1 = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$export' AND cal_f_c > 0 AND DATEPART(HOUR, dates)=11 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $sql1_con = sqlsrv_query($con, $sql1);
                  $b=sqlsrv_fetch_array($sql1_con, SQLSRV_FETCH_BOTH);
                   ?>
                  <?php if ($b) { ?>
                  <i class="btns btn-dangers btn-circle"></i>
                  <?php } else {?>
                  <i class="btns btn-defaults btn-circle"></i>
                  <?php }?>
               </td>
               <td rowspan="2" style="background-color: #da5550;color: #fff"><b>DETECT</b><br><p class="pull-right" style="font-size: 30px"><b><?php if ($b['detect']) {echo $b['detect'];} else {echo "0";} ?></b></p></td>
            </tr>
            <tr>
               <td>4th</td>
               <td>
                  <?php
                  //CALIBRASI 4th
                  //$a=mysqli_query($con,"SELECT no_cell, cal_f_c, dates FROM data_real_time WHERE no_cell='$export' AND cal_f_c > 0 AND DATE_FORMAT(dates,'%H')=13 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $sql1 = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$export' AND cal_f_c > 0 AND DATEPART(HOUR, dates)=13 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $sql1_con = sqlsrv_query($con, $sql1);
                  $b=sqlsrv_fetch_array($sql1_con, SQLSRV_FETCH_BOTH);
                   ?>
                  <?php if ($b) { ?>
                  <i class="btns btn-dangers btn-circle"></i>
                  <?php } else {?>
                  <i class="btns btn-defaults btn-circle"></i>
                  <?php }?>
               </td>
               
            </tr>
            <tr>
               <td>5th</td>
               <td>
                  <?php
                  //CALIBRASI 5th
                  //$a=mysqli_query($con,"SELECT no_cell, cal_f_c, dates FROM data_real_time WHERE no_cell='$export' AND cal_f_c > 0 AND DATE_FORMAT(dates,'%H')=15 AND date(dates)=CURRENT_DATE() LIMIT 1");
                  $sql1 = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$export' AND cal_f_c > 0 AND DATEPART(HOUR, dates)=15 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $sql1_con = sqlsrv_query($con, $sql1);
                  $b=sqlsrv_fetch_array($sql1_con, SQLSRV_FETCH_BOTH);
                   ?>
                  <?php if ($b) { ?>
                  <i class="btns btn-dangers btn-circle"></i>
                  <?php } else {?>
                  <i class="btns btn-defaults btn-circle"></i>
                  <?php }?>
               </td>
               <td rowspan="2" style="background-color: #f2aa56;color: #fff"><b>ERROR</b><br><p style="font-size: 30px" class="pull-right"><b><?php if ($b['error']) {echo mt_rand(0,15)/*$r['error']*/;} else {echo "0";} ?></b></p></td>
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