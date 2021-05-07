<?php include "head.php" ?>
<script language=javascript>
// setTimeout("location.href='http://localhost/adidasnew/cell_11-20'", 10000);
setTimeout("location.href='http://10.10.10.98/adidas/a_1-10'", 10000);
</script>
<!-- Main content -->
<div class="content-header">
<p class="text-center" style="font-size: 20px">
      <b>GEDUNG H</b>
   </p>
   <p class="text-center" style="font-size: 20px">
      <b>CELL 1 - 10</b> (<?php echo date('Y-m-d');?>)
   </p>
</div>
<section class="content" style="padding-top: 0px">
   <div class="row">
     
      <?php
      $cell_awal = 1;
      $cell_akhir = 10;
      for($i = $cell_awal; $i<= $cell_akhir; $i++){
         //AMBIL DATA TERAKHIR DGN PASS MAX
		 // $sql = "SELECT dates, no_cell, pass, detect, error,total FROM dbo.[data_real_time] WHERE pass=(SELECT max(pass) FROM dbo.[data_real_time] WHERE no_cell='$i') ORDER BY dates DESC LIMIT 1";
		 $pengurangan =3;
		 IF($i<10){
		 $sql =  "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-0$i' order by dates desc";
			$d=sqlsrv_query($con, $sql);
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
      $r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH);
      ?>
      <div class="col-md-3" style="width: 20%">
         <table class="table" style="background-color: #e9e9e9;">
             <?php 
                if ($r["pass"] == 0 ){
                    ?>
                    <tr>
                        <th colspan="3" class="text-center" style="font-size: 20px"> CELL H-<?php echo $i; ?><font color= 'blue'>- MAINTENANCE</font></th>
                    </tr>
            <?php
                } else {
            ?>
            <tr>
               <th colspan="3" class="text-center" style="font-size: 20px"> CELL H-<?php echo $i; ?></th>
            </tr>
            <?php
                }
            ?>
			<?php
                }else{
					$sql = "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-$i' order by dates desc";
			$d=sqlsrv_query($con, $sql);
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
      $r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH);
      ?>
      <div class="col-md-3" style="width: 20%">
         <table class="table" style="background-color: #e9e9e9;">
             <?php 
                if ($r["pass"] == 0){
                    ?>
                    <tr>
                        <th colspan="3" class="text-center" style="font-size: 20px"> CELL H-<?php echo $i; ?><font color= 'blue'>- MAINTENANCE</font></th>
                    </tr>
            <?php
                } else {
            ?>
            <tr>
               <th colspan="3" class="text-center" style="font-size: 20px"> CELL H-<?php echo $i; ?></th>
            </tr>
            <?php
                }
            ?>
			<?php
                }
            ?>
            <tr>
               <td>07.00</td>
               <td>
                  <?php
                  //CALIBRASI JAM 7
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
				  if($i<10){
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-0$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=7 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan =$pengurangan+3;?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
				<?php }else {?>
						  <?php
                  //CALIBRASI JAM 7
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
				 
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=7 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan =$pengurangan+3;?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
						  <?php }?>
               </td>
               <td rowspan="2" style="background-color: #009ABF;color: #fff"><b>PASS</b><br><p class="pull-right" style="font-size: 30px"><b><?php 
			   if($i<10){
			   $sql = "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-0$i' order by dates desc";
               //UNTUK MENAMPILKAN NILAI 0 PADA PASS JIKA LP TIDAK KONEK 
               $d=sqlsrv_query($con, $sql);
				if ($d) {
					 $rows = sqlsrv_has_rows( $d );
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
				if ($rows === true){
						while($r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH))
						{echo $r['pass'];} 
				}			else {echo "0";} 
						?>
						</b></p></td>
            </tr>
			<?php }?>
			<?php }else{?>
			<?php 
			   $sql = "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-$i' order by dates desc";
               //UNTUK MENAMPILKAN NILAI 0 PADA PASS JIKA LP TIDAK KONEK 
               $d=sqlsrv_query($con, $sql);
				if ($d) {
					 $rows = sqlsrv_has_rows( $d );
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
				if ($rows === true){
						while($r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH))
						{echo $r['pass'];} 
				}			else {echo "0";} 
						?>
						</b></p></td>
            </tr>
			<?php }?>
			<?php }?>
			
            <tr>
               <td>09.00</td>
               <td>
                   <?php
                  //CALIBRASI JAM 9
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
				  if($i<10){
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-0$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=9 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan =$pengurangan+3;?>
					  
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
				<?php }else {?>
						  <?php
                  //CALIBRASI JAM 9
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=9 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						   $pengurangan =$pengurangan+3
						  ?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
						  <?php }?>
               </td>
               
            </tr>
            <tr>
               <td>11.00</td>
               <td>
                   <?php
                  //CALIBRASI JAM 11
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
				  if($i<10){
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-0$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=11 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan=$pengurangan+3;
						  ?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
				<?php }else {?>
						  <?php
                  //CALIBRASI JAM 11
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=11 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan=$pengurangan+3;?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
						  <?php }?>
               </td>
               <td rowspan="2" style="background-color: #da5550;color: #fff"><b>DETECT</b><br><p class="pull-right" style="font-size: 30px"><b><?php 
				if($i<10){
			   $sql = "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-0$i' order by dates desc";
               //UNTUK MENAMPILKAN NILAI 0 PADA PASS JIKA LP TIDAK KONEK 
               $d=sqlsrv_query($con, $sql);
				if ($d) {
					 $rows = sqlsrv_has_rows( $d );
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
				if ($rows === true){
						while($r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH))
						{echo $r['detect'];} 
				}			else {echo "0";} 
						?>
						</b></p></td>
            </tr>
			<?php }?>
			<?php }else{?>
			<?php 
			   $sql = "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-$i' order by dates desc";
               //UNTUK MENAMPILKAN NILAI 0 PADA PASS JIKA LP TIDAK KONEK 
               $d=sqlsrv_query($con, $sql);
				if ($d) {
					 $rows = sqlsrv_has_rows( $d );
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
				if ($rows === true){
						while($r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH))
						{echo $r['detect'];} 
				}			else {echo "0";} 
						?>
						</b></p></td>
            </tr>
			<?php }?>
			<?php }?>
            <tr>
               <td>13.00</td>
               <td>
                  <?php
                  //CALIBRASI JAM 13
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
				  if($i<10){
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-0$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=13 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan=$pengurangan+3;?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
				<?php }else {?>
						  <?php
                  //CALIBRASI JAM 7
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=13 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan=$pengurangan+3;?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
						  <?php }?>
               </td>
               
            </tr>
            <tr>
               <td>15.00</td>
               <td>
                   <?php
                  //CALIBRASI JAM 15
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
				  if($i<10){
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-0$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND DATEPART(HOUR, dates)=15 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan=$pengurangan+3;?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
				<?php }else {?>
						  <?php
                  //CALIBRASI JAM 15
				  // $sql='SELECT no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell=$i AND cal_f_c >= 3 AND DATE_FORMAT(dates,"%H")=7 AND date(dates)=CURRENT_DATE() LIMIT 1';
				  //$sql = "SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='$i' AND cal_f_c >= 3 AND DATEPART(HOUR, dates)=7 AND dates = CURRENT_TIMESTAMP";
                  $sql="SELECT TOP 1 no_cell, cal_f_c, dates FROM dbo.[data_real_time] WHERE no_cell='H-$i' AND cal_f_c >= $pengurangan AND cal_b_c >= $pengurangan AND  DATEPART(HOUR, dates)=15 AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
                  $a=sqlsrv_query($con,$sql);
                  $b=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH); ?>
                  <?php if ($a) {
					  $rows = sqlsrv_has_rows( $a );
					  if ($rows === true){
						  $pengurangan=$pengurangan+3;?>
						  <i class="btns btn-dangers btn-circle"></i>
						  <?php }
						  else {?>
						  <i class="btns btn-defaults btn-circle"></i>
						  <?php }?>
				<?php }?>
						  <?php }?>
               </td>
               <td rowspan="2" style="background-color: #f2aa56;color: #fff"><b>ERROR</b><br><p style="font-size: 30px" class="pull-right"><b><?php 
				if($i<10){
			   $sql = "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-0$i' order by dates desc";
               //UNTUK MENAMPILKAN NILAI 0 PADA PASS JIKA LP TIDAK KONEK 
               $d=sqlsrv_query($con, $sql);
				if ($d) {
					 $rows = sqlsrv_has_rows( $d );
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
				if ($rows === true){
						while($r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH))
						{echo $r['error'];}
				}			else {echo "0";} 
						?>
						</b></p></td>
            </tr>
			<?php }?>
			<?php }else{?>
			<?php 
			   $sql = "select top 1 no_cell, dates, pass, detect, error from data_real_time where no_cell='H-$i' order by dates desc";
               //UNTUK MENAMPILKAN NILAI 0 PADA PASS JIKA LP TIDAK KONEK 
               $d=sqlsrv_query($con, $sql);
				if ($d) {
					 $rows = sqlsrv_has_rows( $d );
         //AMBIL DATA TERAKHIR
      //$d=sqlsrv_query($con,"SELECT dates,pass,detect,error FROM data_real_time WHERE no_cell=$i ORDER BY dates DESC LIMIT 1");
				if ($rows === true){
						while($r=sqlsrv_fetch_array($d,SQLSRV_FETCH_BOTH))
						{echo $r['error'];}
				}			else {echo "0";} 
						?>
						</b></p></td>
            </tr>
			<?php }?>
			<?php }?>
			
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