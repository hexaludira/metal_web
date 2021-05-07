<?php include"head.php"; ?>
<meta http-equiv="refresh" content="5">
<!-- Main content -->
<section class="content-header">
   <p class="text-center" style="font-size: 20px">
      <?php 
	  date_default_timezone_set("asia/jakarta");
	  echo date('l, Y-m-d');?>
   </p><br>
</section>
 <section class="contents">
   <div class="row">
      <?php
      // FACTORY A C D
	   
	  $wkt_reset = date('H');
	  if ($wkt_reset == 05){
		   $sql_a = "TRUNCATE TABLE dbo.[gedung_a]";
			$sql_c = "TRUNCATE TABLE dbo.[gedung_c]";
			$sql_b = "TRUNCATE TABLE dbo.[gedung_b]";
         $sql_d = "TRUNCATE TABLE dbo.[gedung_d]";
         $sql_e = "TRUNCATE TABLE dbo.[gedung_e]";
			$reset_a = sqlsrv_query($con, $sql_a);
		  $reset_c = sqlsrv_query($con, $sql_c);
		  $reset_b = sqlsrv_query($con, $sql_b);
        $reset_d = sqlsrv_query($con, $sql_d);
        $reset_e = sqlsrv_query($con, $sql_e);	  
	  }
	   $wkt_reset = date('H');
	  if ($wkt_reset == 07){
		   $sqls = "DELETE FROM data_real_time WHERE PASS>300;";
		  $resets = sqlsrv_query($con, $sqls);
	  }
	 		
					$sql_insert = "MERGE INTO GEDUNG_A
									USING 
									(select NO_CELL,MAX(PASS) AS PASS, MAX(DETECT) AS DETECT, MAX(ERROR) AS ERROR from data_real_time WHERE CONVERT(DATE,DATES)=CONVERT(DATE,CURRENT_TIMESTAMP) AND NO_CELL LIKE 'A-%' /* A-%/C-%/D-% */
															   GROUP BY  NO_CELL
															   ) AS A
									ON GEDUNG_A.NO_CELL = A.NO_CELL
									WHEN MATCHED THEN
									UPDATE SET PASS = A.PASS, DETECT=A.DETECT, ERROR=A.ERROR
									WHEN NOT MATCHED THEN
									INSERT (NO_CELL,PASS,DETECT,ERROR) VALUES (A.NO_CELL,A.PASS,A.DETECT,A.ERROR);";
					$q_insert = sqlsrv_query($con,$sql_insert);
					$sql_insert = "MERGE INTO GEDUNG_B
									USING 
									(select NO_CELL,MAX(PASS) AS PASS, MAX(DETECT) AS DETECT, MAX(ERROR) AS ERROR from data_real_time WHERE CONVERT(DATE,DATES)=CONVERT(DATE,CURRENT_TIMESTAMP) AND NO_CELL LIKE 'B%' /* A-%/C-%/D-% */
															   GROUP BY  NO_CELL
															   ) AS A
									ON GEDUNG_B.NO_CELL = A.NO_CELL
									WHEN MATCHED THEN
									UPDATE SET PASS = A.PASS, DETECT=A.DETECT, ERROR=A.ERROR
									WHEN NOT MATCHED THEN
									INSERT (NO_CELL,PASS,DETECT,ERROR) VALUES (A.NO_CELL,A.PASS,A.DETECT,A.ERROR);";
					$q_insert = sqlsrv_query($con,$sql_insert);
					
					$sql_insert = "MERGE INTO GEDUNG_C
									USING 
									(select NO_CELL,MAX(PASS) AS PASS, MAX(DETECT) AS DETECT, MAX(ERROR) AS ERROR from data_real_time WHERE CONVERT(DATE,DATES)=CONVERT(DATE,CURRENT_TIMESTAMP) AND NO_CELL LIKE 'C-%' /* A-%/C-%/D-% */
															   GROUP BY  NO_CELL
															   ) AS A
									ON GEDUNG_C.NO_CELL = A.NO_CELL
									WHEN MATCHED THEN
									UPDATE SET PASS = A.PASS, DETECT=A.DETECT, ERROR=A.ERROR
									WHEN NOT MATCHED THEN
									INSERT (NO_CELL,PASS,DETECT,ERROR) VALUES (A.NO_CELL,A.PASS,A.DETECT,A.ERROR);";
					$q_insert = sqlsrv_query($con,$sql_insert);
					$sql_insert = "MERGE INTO GEDUNG_D
									USING 
									(select NO_CELL,MAX(PASS) AS PASS, MAX(DETECT) AS DETECT, MAX(ERROR) AS ERROR from data_real_time WHERE CONVERT(DATE,DATES)=CONVERT(DATE,CURRENT_TIMESTAMP) AND NO_CELL LIKE 'D-%' /* A-%/C-%/D-% */
															   GROUP BY  NO_CELL
															   ) AS A
									ON GEDUNG_D.NO_CELL = A.NO_CELL
									WHEN MATCHED THEN
									UPDATE SET PASS = A.PASS, DETECT=A.DETECT, ERROR=A.ERROR
									WHEN NOT MATCHED THEN
									INSERT (NO_CELL,PASS,DETECT,ERROR) VALUES (A.NO_CELL,A.PASS,A.DETECT,A.ERROR);";
					$q_insert = sqlsrv_query($con,$sql_insert);

      $sql_jumlah_a = "SELECT SUM(pass) AS jml_pass_a, SUM(detect) AS jml_detect_a FROM dbo.[gedung_a] ";
	  //$sql_jumlah_b = "SELECT SUM(pass) AS jml_pass_b, SUM(detect) AS jml_detect_b, SUM(error) AS jml_error_b FROM dbo.[gedung_b] ";
	  $sql_error_a = "SELECT count(error) AS jml_error_a FROM dbo.[gedung_a] where error>=20 ";
      $sql_jumlah_c = "SELECT SUM(pass) AS jml_pass_c, SUM(detect) AS jml_detect_c FROM dbo.[gedung_c]";
	  $sql_error_c = "SELECT count(error) AS jml_error_c FROM dbo.[gedung_c] where error>=20 ";
      $sql_jumlah_d = "SELECT SUM(pass) AS jml_pass_d, SUM(detect) AS jml_detect_d  FROM dbo.[gedung_d]";
	  $sql_error_d = "SELECT count(error) AS jml_error_d FROM dbo.[gedung_d] where error>=20 ";
      $q_a = sqlsrv_query($con, $sql_jumlah_a);
      $r_a = sqlsrv_query($con, $sql_error_a);
     // $q_b = sqlsrv_query($con, $sql_jumlah_b);
      $q_c = sqlsrv_query($con, $sql_jumlah_c);
	  $r_c = sqlsrv_query($con, $sql_error_c);
      $q_d = sqlsrv_query($con, $sql_jumlah_d);
	  $r_d = sqlsrv_query($con, $sql_error_d);
	  
	
      $array_a = sqlsrv_fetch_array($q_a, SQLSRV_FETCH_BOTH);
	  $er_a = sqlsrv_fetch_array($r_a, SQLSRV_FETCH_BOTH);
      //$array_b = sqlsrv_fetch_array($q_b, SQLSRV_FETCH_BOTH);
      $array_c = sqlsrv_fetch_array($q_c, SQLSRV_FETCH_BOTH);
	  $er_c = sqlsrv_fetch_array($r_c, SQLSRV_FETCH_BOTH);
      $array_d = sqlsrv_fetch_array($q_d, SQLSRV_FETCH_BOTH);
	  $er_d = sqlsrv_fetch_array($r_d, SQLSRV_FETCH_BOTH);

      $jml_pass_all = $array_a['jml_pass_a'] +  $array_c['jml_pass_c'] + $array_d['jml_pass_d'];
      $jml_detect_all = $array_a['jml_detect_a'] +  $array_c['jml_detect_c'] + $array_d['jml_detect_d'];
      $jml_error_all = $er_a['jml_error_a'] + $er_c['jml_error_c'] + $er_d['jml_error_d'];
	  ?>
    
      <div class="col-xs-4 col-lg-4">
         <div class="pass-o pull-right text-center"><br>
			<p style="padding-top: 0;font-size: 90px;"><b>PASS</b></p>
            <p style="padding-top:5px;font-size: 196px"><b><?php echo $jml_pass_all; ?></b></p>
            <!-- <p style="padding-top:5px;font-size: 45px">10000</p> -->
            
         </div>
      </div>
      <div class="col-xs-4 col-lg-4">
         <div class="detect-o text-center"><br>
			<p style="padding-top: 0;font-size: 90px"><b>DETECT</b></p>
            <p style="padding-top:5px; font-size: 196px"><b><?php echo $jml_detect_all; ?></b></p>
            <!-- <p style="padding-top:5px; font-size: 45px">10000</p> -->
            
         </div>
      </div>
      <div class="col-xs-4 col-lg-4">
         <div class="error-o pull-left text-center"><br>
			<p style="padding-top: 0;font-size: 90px"><b>ERROR</b></p>
            <p style="padding-top:5px; font-size: 196px"><b><?php echo $jml_error_all; ?></b></p>
            <!-- <p style="padding-top:5px; font-size: 45px"><b>00000</b></p> -->
            
         </div>
      </div>
   </div>
   
</section> 
<section class="contentss">
   <div class="row">
      <?php
	 $sql_cek = "SELECT no_cell FROM dbo.[gedung_a]";
        $q_cek = sqlsrv_query($con, $sql_cek);
		if (sqlsrv_has_rows($q_cek) === true){
	$sql_jumlah_pass = "SELECT SUM(pass) AS jml_pass, SUM(detect) AS jml_detect, SUM(error) AS jml_error FROM dbo.[gedung_a]";
    $q_jml_pass = sqlsrv_query($con, $sql_jumlah_pass);
    while ($jml_array = sqlsrv_fetch_array($q_jml_pass, SQLSRV_FETCH_BOTH)){
	  $sql_erra_a = "SELECT count(error) AS jml_error_a FROM dbo.[gedung_a] where error>=20 ";
      $err_a = sqlsrv_query($con, $sql_erra_a);
	
	  $erro_a = sqlsrv_fetch_array($err_a, SQLSRV_FETCH_BOTH);
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9;">
            <div class="box-header with-border">
               <h3 class="text-center" STYLE="font-size: 48px"><b>FACTORY A</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:200px;font-size: 48px"><b>PASS</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo $jml_array['jml_pass']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:200px;font-size: 48px"><b>DETECT</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo $jml_array['jml_detect']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:200px;font-size: 48px"><b>ERROR</b> <p class="numb text-center" ><b style="font-size: 48px"><?php echo $erro_a['jml_error_a']; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
    <?php }?>
	 <?php }else{?>
	  <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9;">
            <div class="box-header with-border">
               <h3 class="text-center" STYLE="font-size: 48px"><b>FACTORY A</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:200px;font-size: 48px"><b>PASS</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:200px;font-size: 48px"><b>DETECT</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:200px;font-size: 48px"><b>ERROR</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
	  <?php }?>
	  
	  
	  
      <?php
      // FACTORY C (PER GEDUNG)
        $sql_cek1 = "SELECT no_cell FROM dbo.[gedung_c]";
        $q_cek1 = sqlsrv_query($con, $sql_cek1);
		if (sqlsrv_has_rows($q_cek1) === true){
			 $sql_jumlah_pass = "SELECT SUM(pass) AS jml_pass, SUM(detect) AS jml_detect, SUM(error) AS jml_error FROM dbo.[gedung_c]";
        $q_jml_pass = sqlsrv_query($con, $sql_jumlah_pass);
        while ($jml_array = sqlsrv_fetch_array($q_jml_pass, SQLSRV_FETCH_BOTH)){
	  $sql_erra_c = "SELECT count(error) AS jml_error_c FROM dbo.[gedung_c] where error>=20 ";
	  $err_c = sqlsrv_query($con, $sql_erra_c);
	  $erro_c = sqlsrv_fetch_array($err_c, SQLSRV_FETCH_BOTH);
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9">
            <div class="box-header with-border">
               <h3 class="text-center" STYLE="font-size: 48px"><b>FACTORY C</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:200px;font-size: 48px"><b>PASS</b><p class="numb text-center"><b style="font-size: 48px"><?php echo $jml_array['jml_pass']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:200px;font-size: 48px"><b>DETECT</b><p class="numb text-center"><b style="font-size: 48px"><?php echo $jml_array['jml_detect']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:200px;font-size: 48px"><b>ERROR</b><p class="numb text-center"><b style="font-size: 48px"><?php echo $erro_c['jml_error_c']; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
        <?php }?>
		<?php }else{?>
	  <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9;">
            <div class="box-header with-border">
               <h3 class="text-center" STYLE="font-size: 48px"><b>FACTORY C</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:200px;font-size: 48px"><b>PASS</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:200px;font-size: 48px"><b>DETECT</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0;?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:200px;font-size: 48px"><b>ERROR</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
	  <?php }?>

      <?php
      //FACTORY D (PER GEDUNG)
  
        $sql_cek2 = "SELECT no_cell FROM dbo.[gedung_d]";
        $q_cek2 = sqlsrv_query($con, $sql_cek2);
		if (sqlsrv_has_rows($q_cek2) === true){
		$sql_jumlah_pass = "SELECT SUM(pass) AS jml_pass, SUM(detect) AS jml_detect, SUM(error) AS jml_error FROM dbo.[gedung_d]";
        $q_jml_pass = sqlsrv_query($con, $sql_jumlah_pass);
        while ($jml_array = sqlsrv_fetch_array($q_jml_pass, SQLSRV_FETCH_BOTH)){
	  $sql_erra_d = "SELECT count(error) AS jml_error_d FROM dbo.[gedung_d] where error>=20 ";
	  $err_d = sqlsrv_query($con, $sql_erra_d);
	  $erro_d = sqlsrv_fetch_array($err_d, SQLSRV_FETCH_BOTH);
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9">
            <div class="box-header with-border">
               <h3 class="text-center" STYLE="font-size: 48px"><b>FACTORY D</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:200px;font-size: 48px"><b>PASS</b><p class="numb text-center"><b style="font-size: 48px"><?php echo $jml_array['jml_pass']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:200px;font-size: 48px"><b>DETECT</b><p class="numb text-center"><b style="font-size: 48px"><?php echo $jml_array['jml_detect']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:200px;font-size: 48px"><b>ERROR</b><p class="numb text-center"><b style="font-size: 48px"><?php echo $erro_d['jml_error_d']; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
        <?php }?>
		 <?php }else{?>
	  <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9;">
            <div class="box-header with-border">
               <h3 class="text-center" STYLE="font-size: 48px"><b>FACTORY D</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:200px;font-size: 48px"><b>PASS</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:200px;font-size: 48px"><b>DETECT</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:200px;font-size: 48px"><b>ERROR</b> <p class="numb text-center"><b style="font-size: 48px"><?php echo 0; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
	  <?php }?>
   <div class="text-center">
      <?php
      // DEFAULT TANGGAL WAKTU INDONESIA/ASIA
      date_default_timezone_set("asia/jakarta");
      //MENAMPILKAN  Waktu: 20-01-20116 22:01:15
      $waktu = date('Y-m-d H:i:s');
      //MENAMPILKAN 20-01-20116
      $tgl = date('Y-m-d');
      // MENAMPILKAN 22:01:15
      $wkt = date('H:i:s');
      //KONEKSI DATABASE
      // include"../factory/config/koneksi.php";
      //MENAMPILKAN JAM
      $pecah = date('H');
      //MENAMPILKAN TGL HARI INI
      $skrg = date('d');
      //RESET JAM 6 PAGI
      if ($pecah==06) {
		$sql="TRUNCATE TABLE dbo.[data_real_time]";
    
      $reset=sqlsrv_query($con,$sql);
      
	   if ($reset) {
					  $rows = sqlsrv_has_rows( $reset );
					  if ($rows === true){
						 echo "<i class='fa fa-check-circle'></i>";
						   }
					else{
						 echo "N";
						  }
				}
      
      }
	  //$sql_cek = "select dates,no_cell,pass from data_real_time where pass>300 and datepart(hour,dates)<8 order by dates desc ";
        //$q_sql_cek = sqlsrv_query($con, $sql_cek);
		//if (sqlsrv_has_rows($q_sql_cek) === true){
		//$sql_delete = "delete from data_real_time where pass>300 and datepart(hour,dates)<8";
		//}
      // PINDAH KE TABLE data_daily
	  
	  //ECHO DATE('H');
	  //echo $tgl;
	  //echo $wkt;
	   date_default_timezone_set("asia/jakarta");
      //MENAMPILKAN  Waktu: 20-01-20116 22:01:15
      $waktu = date('Y-m-d H:i:s');
      //MENAMPILKAN 20-01-20116
      $tgl = date('Y-m-d');
      // MENAMPILKAN 22:01:15
      $wkt = date('H:i:s');
      //KONEKSI DATABASE
      // include"../factory/config/koneksi.php";
      //MENAMPILKAN JAM
      $pecah = date('H');
      if ($pecah==17) {
		  
		  //gedung_a
      $cell_awal=1;
      $cell_akhir=18;
      for ($i=$cell_awal; $i <= $cell_akhir; $i++) {
      //CEK DATA 
	  if($i<10) {
		  $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
      $cek1=sqlsrv_query($con,$sql);
      if ($cek1) {
					  $rows = sqlsrv_has_rows( $cek1 );
					  if ($rows === true){
						 
						   }
						  else{
						   $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell, pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
							$masuk=sqlsrv_query($con,$sql);
						  }
				}
      else {
		  //CELL 1+
		  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell, pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='A-0$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
		  $masuk=sqlsrv_query($con,$sql);
		 
	  }
		  
	  }
	  
	  
	  else {
		  $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
      $cek1=sqlsrv_query($con,$sql);
      if ($cek1) {
					  $rows = sqlsrv_has_rows( $cek1 );
					  if ($rows === true){
						 
						   }
						  else{
						  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
							$masuk=sqlsrv_query($con,$sql);
						  }
				}
      else {
      //CELL 1+
	  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='A-$i' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
      $masuk=sqlsrv_query($con,$sql);
	  
		  
	  }
	  
      }
	  }
	  //gedung c
	  $cell_awal2=1;
      $cell_akhir2=30;
      for ($j=$cell_awal2; $j <= $cell_akhir2 ; $j++) {
      //CEK DATA 
	  if($j<10) {
		  $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
      $cek1=sqlsrv_query($con,$sql);
      if ($cek1) {
					  $rows = sqlsrv_has_rows( $cek1 );
					  if ($rows === true){
						 
						   }
						  else{
						  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
							$masuk=sqlsrv_query($con,$sql);
						  }
				}
      else {
		  //CELL 1+
		  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='C-0$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
		  $masuk=sqlsrv_query($con,$sql);
		  
		  
	  }
		  
	  }
	  
	  else {
		  $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
      $cek1=sqlsrv_query($con,$sql);
      if ($cek1) {
					  $rows = sqlsrv_has_rows( $cek1 );
					  if ($rows === true){
						 
						   }
						  else{
						 $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
						$masuk=sqlsrv_query($con,$sql);
						  }
				}
      else {
      //CELL 1+
	  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='C-$j' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
      $masuk=sqlsrv_query($con,$sql);
	   
      }
		  
	  }
	  
      }
	  //gedung D
	  $cell_awal3=1;
      $cell_akhir3=78;
      for ($k=$cell_awal3; $k <= $cell_akhir3 ; $k++) {
      //CEK DATA 
	  if($k<10) {
		  $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
      $cek1=sqlsrv_query($con,$sql);
      if ($cek1) {
					  $rows = sqlsrv_has_rows( $cek1 );
					  if ($rows === true){
						 
						   }
						  else{
						  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
							$masuk=sqlsrv_query($con,$sql);
						  }
				}
      else {
		  //CELL 1+
		  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='D-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
		  $masuk=sqlsrv_query($con,$sql);
		   
		  
	  }
		  
	  }
	  
	  else {
		  $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
      $cek1=sqlsrv_query($con,$sql);
      if ($cek1) {
					  $rows = sqlsrv_has_rows($cek1);
					  if ($rows === true){
						 
						   }
						  else{
						  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
						$masuk=sqlsrv_query($con,$sql);
						  }
				}
      else {
      //CELL 1+
	  $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='D-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
      $masuk=sqlsrv_query($con,$sql);
	  
      }
		  
	  }
	  
      }

      //gedung E
	  $cell_awal4=1;
     $cell_akhir4=74;
     for ($k=$cell_awal4; $k <= $cell_akhir4 ; $k++) {
     //CEK DATA 
    if($k<10) {
       $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
     $cek1=sqlsrv_query($con,$sql);
     if ($cek1) {
                $rows = sqlsrv_has_rows( $cek1 );
                if ($rows === true){
                  
                    }
                   else{
                   $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
                    $masuk=sqlsrv_query($con,$sql);
                   }
           }
     else {
       //CELL 1+
       $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='E-0$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
       $masuk=sqlsrv_query($con,$sql);
        
       
    }
       
    }
    
    else {
       $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
     $cek1=sqlsrv_query($con,$sql);
     if ($cek1) {
                $rows = sqlsrv_has_rows($cek1);
                if ($rows === true){
                  
                    }
                   else{
                   $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
                 $masuk=sqlsrv_query($con,$sql);
                   }
           }
     else {
     //CELL 1+
    $sql="INSERT INTO dbo.[data_daily] (dates, date, hour, no_cell,pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other) VALUES ((SELECT TOP 1 dates FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC),'$tgl', '$wkt', (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 total FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_c FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_f_m FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_c FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 cal_b_m FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 c_a FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_s FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC), (SELECT TOP 1 test_other FROM dbo.[data_real_time] WHERE no_cell='E-$k' AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC))";
     $masuk=sqlsrv_query($con,$sql);
    
     }
       
    }
    
     }
      } 
	  
	   
	  //END PINDAH ?>
   </div> 
</section> 
<!-- /.content -->
<?php include "foot.php"; ?>
	  