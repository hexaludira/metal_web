<?php include "head.php" ?>
<!-- Main content -->
<section class="content" style="min-height:100px ">
   
   <section class="content-header">
      <form class="form-horizontal" method="POST" action="monthly_report.php">
         <div class="col-sm-5">
            <div class="form-group">
               <label class="col-sm-3 control-label">Select Date</label>
               <div class="col-sm-9">
                  <select name="bulan" class="form-control">
                     <option value="">Pilih Bulan</option>
                     <option value="1">January</option>
                     <option value="2">February</option>
                     <option value="3">March</option>
                     <option value="4">April</option>
                     <option value="5">May</option>
                     <option value="6">June</option>
                     <option value="7">July</option>
                     <option value="8">August</option>
                     <option value="9">September</option>
                     <option value="10">October</option>
                     <option value="11">November</option>
                     <option value="12">December</option>
                  </select>
               </div>
            </div>
         </div>
         <div class="col-sm-5">
            <div class="form-group">
               <label class="col-sm-3 control-label">Select Date</label>
               <div class="col-sm-9">
                  <select name="tahun" class="form-control">
                     <option value="">Pilih Tahun</option>
                     <?php
                     $mulai= date('Y') - 18;
                     for($a = $mulai;$a<$mulai +30;$a++){
                     $sel = $i == date('Y') ? ' selected="selected"' : '';
                     echo '<option value="'.$a.'"'.$sel.'>'.$a.'</option>';
                     }
                     ?>
                  </select>
               </div>
            </div>
         </div>
         
         <div class="col-sm-2">
            <input type="submit" class="btn btn-primary btn-block" name="search" value="Search">
         </div>
         
      </form>
   </section>
</section>
<section class="content">
   <div class="tes">
      <!-- <button type="submit" class="btn btn-info pull-right">Download <i class="fa fa-download"></i></button><br><br> -->
      <p align="right"> <a href="#" class="export btn btn-info">Download <i class="fa fa-download"></i></a></p>
      <div id="dvData">
         <table class="table table-bordered">
            <tr>
               <td style="border-right-color:white;"></td>
               <td></td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT date FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {  ?>
               <td><?php echo date_format($t['date'],'Y-m-d'); ?></td>
               <?php }} ?>
            </tr>
            <?php
            for($c=1; $c <= 18; $c++)
            {?>
		 <?php
            if ($c<10)
            {?>
            <tr>
               <td style="border-bottom-color:white;"><?php echo "CELL A-0".$c; ?></td>
               <td>PASS</td>
               
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			    $sql1="SELECT convert(varchar,date) as date FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' GROUP BY date";
				$q1= sqlsrv_query($con,$sql1);
				 while ($td1 = sqlsrv_fetch_array($q1,SQLSRV_FETCH_BOTH)) {
			   $sql="SELECT sum(pass) as pass,convert(varchar,date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
			  if (sqlsrv_has_rows($q) === true){
               $td = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH); 
               if($td1['date']==$td['date']) { ?>
               <td><?php echo $td['pass']; ?></td>
              
               <?php $td['date'] = date ("Y-m-d", strtotime("+1 day", strtotime($td['date']))); } elseif($td1['date']!=$td['date']) { ?>
               <td>0</td>
				 <?php }$td1['date'] = date ("Y-m-d", strtotime("+1 day", strtotime($td1['date'])));}} } ?>
            </tr>
            <tr>
               <td style="border-bottom-color:white;"></td>
               <td>DETECT</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(detect) as detect,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tds = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tds['detect']) { ?>
               
               <td><?php echo $tds['detect']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} }?>
            </tr>
            <tr>
               <td></td>
               <td>ERROR</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(error) as error,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tdso = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tdso['error']) { ?>
               
               <td><?php echo $tdso['error']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }}} ?>
            </tr>
			<tr>
            
               <td>CALIBRATION</td>
			      <td></td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT max(cal_f_c) as cal_f_c,max(date) as date ,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td_cal = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               $data_persen = $td_cal['cal_f_c']/12*100;
			   if($data_persen >= 100) { ?>
               
               <?php echo '<td style="background-color: #009900; color:black"><b>100%</b>'; ?></td>
               
               <?php } else { ?>
              <?php echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>'; ?></td>
               <?php }}} ?>
            </tr>
            <?php }ELSE{?>
			<tr>
               <td style="border-bottom-color:white;"><?php echo "CELL A-".$c; ?></td>
               <td>PASS</td>
               
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(pass) as pass,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($td['pass']) { ?>
               <td><?php echo $td['pass']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} } ?>
            </tr>
            <tr>
               <td style="border-bottom-color:white;"></td>
               <td>DETECT</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(detect) as detect,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tds = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tds['detect']) { ?>
               
               <td><?php echo $tds['detect']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} }?>
            </tr>
            <tr>
               <td></td>
               <td>ERROR</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(error) as error,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tdso = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tdso['error']) { ?>
               
               <td><?php echo $tdso['error']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }}} ?>
            </tr>
			<tr>
               
               <td>CALIBRATION</td> <td></td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT max(cal_f_c) as cal_f_c,max(date) as date ,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='A-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td_cal = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               $data_persen = $td_cal['cal_f_c']/12*100;
			   if($data_persen >= 100) { ?>
               
               <?php echo '<td style="background-color: #009900; color:black"><b>100%</b>'; ?></td>
               
               <?php } else { ?>
                <?php echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>'; ?></td>
               <?php }}} ?>
            </tr>
			<?php } ?>
			<?php } ?>
			 <?php
            for($c=1; $c <= 27; $c++)
            {?>
		 <?php
            if ($c<10)
            {?>
            <tr>
               <td style="border-bottom-color:white;"><?php echo "CELL C-0".$c; ?></td>
               <td>PASS</td>
               
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(pass) as pass,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($td['pass']) { ?>
               <td><?php echo $td['pass']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} } ?>
            </tr>
            <tr>
               <td style="border-bottom-color:white;"></td>
               <td>DETECT</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(detect) as detect,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tds = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tds['detect']) { ?>
               
               <td><?php echo $tds['detect']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} }?>
            </tr>
            <tr>
               <td></td>
               <td>ERROR</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(error) as error,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tdso = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tdso['error']) { ?>
               
               <td><?php echo $tdso['error']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }}} ?>
            </tr>
			<tr>
            
               <td>CALIBRATION</td><td></td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT max(cal_f_c) as cal_f_c,max(date) as date ,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td_cal = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               $data_persen = $td_cal['cal_f_c']/12*100;
			   if($data_persen >= 100) { ?>
               
               <?php echo '<td style="background-color: #009900; color:black"><b>100%</b>'; ?></td>
               
               <?php } else { ?>
               <?php echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>'; ?></td>
               <?php }}} ?>
            </tr>
            <?php }ELSE{?>
			<tr>
               <td style="border-bottom-color:white;"><?php echo "CELL C-".$c; ?></td>
               <td>PASS</td>
               
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(pass) as pass,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($td['pass']) { ?>
               <td><?php echo $td['pass']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} } ?>
            </tr>
            <tr>
               <td style="border-bottom-color:white;"></td>
               <td>DETECT</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(detect) as detect,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tds = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tds['detect']) { ?>
               
               <td><?php echo $tds['detect']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} }?>
            </tr>
            <tr>
               <td></td>
               <td>ERROR</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(error) as error,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tdso = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tdso['error']) { ?>
               
               <td><?php echo $tdso['error']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }}} ?>
            </tr>
			<tr>
              
               <td>CALIBRATION</td><td></td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT max(cal_f_c) as cal_f_c,max(date) as date ,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='C-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td_cal = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               $data_persen = $td_cal['cal_f_c']/12*100;
			   if($data_persen >= 100) { ?>
               
               <?php echo '<td style="background-color: #009900; color:black"><b>100%</b>'; ?></td>
               
               <?php } else { ?>
               <?php echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>'; ?></td>
               <?php }}} ?>
            </tr>
			<?php } ?>
			<?php } ?>
			 <?php
            for($c=1; $c <= 78; $c++)
            {?>
		 <?php
            if ($c<10)
            {?>
            <tr>
               <td style="border-bottom-color:white;"><?php echo "CELL D-0".$c; ?></td>
               <td>PASS</td>
               
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(pass) as pass,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($td['pass']) { ?>
               <td><?php echo $td['pass']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} } ?>
            </tr>
            <tr>
               <td style="border-bottom-color:white;"></td>
               <td>DETECT</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(detect) as detect,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tds = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tds['detect']) { ?>
               
               <td><?php echo $tds['detect']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} }?>
            </tr>
            <tr>
               <td></td>
               <td>ERROR</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(error) as error,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tdso = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tdso['error']) { ?>
               
               <td><?php echo $tdso['error']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }}} ?>
            </tr>
			<tr>
              
               <td>CALIBRATION</td><td></td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT max(cal_f_c) as cal_f_c,max(date) as date ,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-0$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td_cal = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               $data_persen = $td_cal['cal_f_c']/12*100;
			   if($data_persen >= 100) { ?>
               
               <?php echo '<td style="background-color: #009900; color:black"><b>100%</b>'; ?></td>
               
               <?php } else { ?>
               <?php echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>'; ?></td>
               <?php }}} ?>
            </tr>
            <?php }ELSE{?>
			<tr>
               <td style="border-bottom-color:white;"><?php echo "CELL D-".$c; ?></td>
               <td>PASS</td>
               
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(pass) as pass,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($td['pass']) { ?>
               <td><?php echo $td['pass']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} } ?>
            </tr>
            <tr>
               <td style="border-bottom-color:white;"></td>
               <td>DETECT</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(detect) as detect,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tds = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tds['detect']) { ?>
               
               <td><?php echo $tds['detect']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }} }?>
            </tr>
            <tr>
               <td></td>
               <td>ERROR</td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT sum(error) as error,max(date) as date,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($tdso = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               if($tdso['error']) { ?>
               
               <td><?php echo $tdso['error']; ?></td>
               
               <?php } else { ?>
               <td>0</td>
               <?php }}} ?>
            </tr>
			<tr>
               
               <td>CALIBRATION</td><td></td>
               <?php
               if (isset($_POST['search'])) {
               $bulan = $_POST['bulan'];
               $tahun = $_POST['tahun'];
			   $sql="SELECT max(cal_f_c) as cal_f_c,max(date) as date ,max(no_cell) as no_cell FROM data_daily WHERE month(date)='$bulan' and year(date)='$tahun' and no_cell='D-$c' GROUP BY date";
               $q = sqlsrv_query($con,$sql);
               while ($td_cal = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               $data_persen = $td_cal['cal_f_c']/12*100;
			   if($data_persen >= 100) { ?>
               
               <?php echo '<td style="background-color: #009900; color:black"><b>100%</b>'; ?></td>
               
               <?php } else { ?>
               <?php echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>'; ?></td>
               <?php }}} ?>
            </tr>
			<?php } ?>
			<?php } ?>
         </table>
      </div>
   </div>
</section>
<!-- /.content -->
<?php include "foot.php" ?>
<style>
.tes {
width: 100%;
height: 60%;
overflow-x: auto;
overflow-y: auto;
}
</style>