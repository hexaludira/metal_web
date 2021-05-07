<?php include"head.php"; ?>
<meta http-equiv="refresh" content="10">
<!-- Main content -->
<section class="content-header">
   <p class="text-center" style="font-size: 20px">
      <?php echo date('l, Y-m-d');?>
   </p><br>
</section>
<section class="content">
   <div class="row">
      <?php
      // FACTORY A C D
	  
	  $wkt_reset = date('H');
	  if ($wkt_reset == 06){
		   $sql_a = "TRUNCATE TABLE dbo.[gedung_a]";
			$sql_c = "TRUNCATE TABLE dbo.[gedung_c]";
			$sql_d = "TRUNCATE TABLE dbo.[gedung_d]";
			$reset_a = sqlsrv_query($con, $sql_a);
		  $reset_c = sqlsrv_query($con, $sql_c);
		  $reset_d = sqlsrv_query($con, $sql_d);
		  
	  }
	 
      $sql_jumlah_a = "SELECT SUM(pass) AS jml_pass_a, SUM(detect) AS jml_detect_a, SUM(error) AS jml_error_a FROM dbo.[gedung_a]";

      $sql_jumlah_c = "SELECT SUM(pass) AS jml_pass_c, SUM(detect) AS jml_detect_c, SUM(error) AS jml_error_c FROM dbo.[gedung_c]";

      $sql_jumlah_d = "SELECT SUM(pass) AS jml_pass_d, SUM(detect) AS jml_detect_d, SUM(error) AS jml_error_d FROM dbo.[gedung_d]";

      $q_a = sqlsrv_query($con, $sql_jumlah_a);
      $q_c = sqlsrv_query($con, $sql_jumlah_c);
      $q_d = sqlsrv_query($con, $sql_jumlah_d);
	  
	
      $array_a = sqlsrv_fetch_array($q_a, SQLSRV_FETCH_BOTH);
      $array_c = sqlsrv_fetch_array($q_c, SQLSRV_FETCH_BOTH);
      $array_d = sqlsrv_fetch_array($q_d, SQLSRV_FETCH_BOTH);

      $jml_pass_all = $array_a['jml_pass_a'] + $array_c['jml_pass_c'] + $array_d['jml_pass_d'];
      $jml_detect_all = $array_a['jml_detect_a'] + $array_c['jml_detect_c'] + $array_d['jml_detect_d'];
      $jml_error_all = $array_a['jml_error_a'] + $array_c['jml_error_c'] + $array_d['jml_error_d'];
	  ?>
    
      <div class="col-xs-4 col-md-4">
         <div class="pass-o pull-right text-center"><br>
            <p style="padding-top:5px; font-size: 45px"><b><?php echo $jml_pass_all; ?></b></p>
            <!-- <p style="padding-top:5px;font-size: 45px">10000</p> -->
            <p style="padding-top: 50px;font-size: 30px;"><b>PASS</b></p>
         </div>
      </div>
      <div class="col-xs-4 col-md-4">
         <div class="detect-o text-center"><br>
            <p style="padding-top:5px; font-size: 45px"><b><?php echo $jml_detect_all; ?></b></p>
            <!-- <p style="padding-top:5px; font-size: 45px">10000</p> -->
            <p style="padding-top: 50px;font-size: 30px"><b>DETECT</b></p>
         </div>
      </div>
      <div class="col-xs-4 col-md-4">
         <div class="error-o pull-left text-center"><br>
            <p style="padding-top:5px; font-size: 45px"><b><?php echo $jml_error_all; ?></b></p>
            <!-- <p style="padding-top:5px; font-size: 45px"><b>00000</b></p> -->
            <p style="padding-top: 50px;font-size: 30px"><b>ERROR</b></p>
         </div>
      </div>
   </div>
   
</section>
	  
	  
	  
<section class="content">
   <div class="row">
      <?php
      // FACTORY A (PER GEDUNG)
      $cell_awal=1;
      $cell_akhir=18;

      $sql="SELECT no_cell FROM dbo.[gedung_a]";
      
      $q = sqlsrv_query($con,$sql);

      if (sqlsrv_has_rows($q) === true){
        for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
			
			IF($i<10){
			  $sql_update = "UPDATE dbo.[gedung_a] SET no_cell = (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC), pass = (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC), detect = (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC), error = (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC) WHERE no_cell = 'A-0$i'";
			  $q_update = sqlsrv_query($con,$sql_update);
			}ELSE{
				$sql_update = "UPDATE dbo.[gedung_a] SET no_cell = (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC), pass = (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC), detect = (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC), error = (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC) WHERE no_cell = 'A-$i'";
			  $q_update = sqlsrv_query($con,$sql_update);
			}
      
        }
        
        } else {

          for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
			  
			  IF($i<10){
					$sql_insert = "INSERT INTO dbo.[gedung_a] (no_cell, pass, detect, error) VALUES ( (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-0$i' ORDER BY dates DESC))";
					$q_insert = sqlsrv_query($con,$sql_insert);
			  }ELSE{
					$sql_insert = "INSERT INTO dbo.[gedung_a] (no_cell, pass, detect, error) VALUES ( (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='A-$i' ORDER BY dates DESC))";
					$q_insert = sqlsrv_query($con,$sql_insert);
			  }          
          }
        }
    
    $sql_jumlah_pass = "SELECT SUM(pass) AS jml_pass, SUM(detect) AS jml_detect, SUM(error) AS jml_error FROM dbo.[gedung_a]";
    $q_jml_pass = sqlsrv_query($con, $sql_jumlah_pass);
	if (sqlsrv_has_rows($q) === true){
    while ($jml_array = sqlsrv_fetch_array($q_jml_pass, SQLSRV_FETCH_BOTH)){
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9;">
            <div class="box-header with-border">
               <h3 class="text-center"><b>FACTORY A</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b> <p class="numb text-center"><b><?php echo $jml_array['jml_pass']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b> <p class="numb text-center"><b><?php echo $jml_array['jml_detect']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b> <p class="numb text-center"><b><?php echo $jml_array['jml_error']; ?></b></p></td>
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
               <h3 class="text-center"><b>FACTORY A</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b> <p class="numb text-center"><b><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b> <p class="numb text-center"><b><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b> <p class="numb text-center"><b><?php echo 0; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
	  <?php }?>
      <?php
      // FACTORY C (PER GEDUNG)
      $cell_awal=1;
      $cell_akhir=25;
		
      $sql="SELECT no_cell FROM dbo.[gedung_c]";
      
      $q = sqlsrv_query($con,$sql);
		
      if (sqlsrv_has_rows($q) === true){
        for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
			IF($i<10){
			  $sql_update = "UPDATE dbo.[gedung_c] SET no_cell = (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC), pass = (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC), detect = (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC), error = (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC) WHERE no_cell = 'C-0$i'";
			  $q_update = sqlsrv_query($con,$sql_update);
			}ELSE{
				$sql_update = "UPDATE dbo.[gedung_c] SET no_cell = (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC), pass = (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC), detect = (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC), error = (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC) WHERE no_cell = 'C-$i'";
			  $q_update = sqlsrv_query($con,$sql_update);
			}
			}
			
			} else {

			  for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
			IF($i<10){
					$sql_insert = "INSERT INTO dbo.[gedung_c] (no_cell, pass, detect, error) VALUES ( (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-0$i' ORDER BY dates DESC))";
					$q_insert = sqlsrv_query($con,$sql_insert);
			  }ELSE{
					$sql_insert = "INSERT INTO dbo.[gedung_c] (no_cell, pass, detect, error) VALUES ( (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='C-$i' ORDER BY dates DESC))";
					$q_insert = sqlsrv_query($con,$sql_insert);
			  }
			  }
        }

        $sql_jumlah_pass = "SELECT SUM(pass) AS jml_pass, SUM(detect) AS jml_detect, SUM(error) AS jml_error FROM dbo.[gedung_c]";
        $q_jml_pass = sqlsrv_query($con, $sql_jumlah_pass);
		if (sqlsrv_has_rows($q) === true){
        while ($jml_array = sqlsrv_fetch_array($q_jml_pass, SQLSRV_FETCH_BOTH)){
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9">
            <div class="box-header with-border">
               <h3 class="text-center"><b>FACTORY C</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b><p class="numb text-center"><b><?php echo $jml_array['jml_pass']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b><p class="numb text-center"><b><?php echo $jml_array['jml_detect']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b><p class="numb text-center"><b><?php echo $jml_array['jml_error']; ?></b></p></td>
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
               <h3 class="text-center"><b>FACTORY C</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b> <p class="numb text-center"><b><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b> <p class="numb text-center"><b><?php echo 0; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b> <p class="numb text-center"><b><?php echo 0; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
	  <?php }?>

      <?php
      //FACTORY D (PER GEDUNG)
      $cell_awal=1;
      $cell_akhir=78;

      $sql="SELECT no_cell FROM dbo.[gedung_d]";
      
      $q = sqlsrv_query($con,$sql);

      if (sqlsrv_has_rows($q) === true){
        for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
			
			IF($i<10){
			  $sql_update = "UPDATE dbo.[gedung_d] SET no_cell = (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC), pass = (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC), detect = (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC), error = (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC) WHERE no_cell = 'D-0$i'";
			  $q_update = sqlsrv_query($con,$sql_update);
			}ELSE{
				$sql_update = "UPDATE dbo.[gedung_c] SET no_cell = (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC), pass = (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC), detect = (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC), error = (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC) WHERE no_cell = 'D-$i'";
			  $q_update = sqlsrv_query($con,$sql_update);
			}
  
        }
        
        } else {

          for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
			  
			  IF($i<10){
					$sql_insert = "INSERT INTO dbo.[gedung_d] (no_cell, pass, detect, error) VALUES ( (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-0$i' ORDER BY dates DESC))";
					$q_insert = sqlsrv_query($con,$sql_insert);
			  }ELSE{
					$sql_insert = "INSERT INTO dbo.[gedung_d] (no_cell, pass, detect, error) VALUES ( (SELECT TOP 1 no_cell FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC), (SELECT TOP 1 pass FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC), (SELECT TOP 1 detect FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC), (SELECT TOP 1 error FROM dbo.[data_real_time] WHERE no_cell='D-$i' ORDER BY dates DESC))";
					$q_insert = sqlsrv_query($con,$sql_insert);
			  }

          
          }
        }

        $sql_jumlah_pass = "SELECT SUM(pass) AS jml_pass, SUM(detect) AS jml_detect, SUM(error) AS jml_error FROM dbo.[gedung_d]";
        $q_jml_pass = sqlsrv_query($con, $sql_jumlah_pass);
        while ($jml_array = sqlsrv_fetch_array($q_jml_pass, SQLSRV_FETCH_BOTH)){
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9">
            <div class="box-header with-border">
               <h3 class="text-center"><b>FACTORY D</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b><p class="numb text-center"><b><?php echo $jml_array['jml_pass']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b><p class="numb text-center"><b><?php echo $jml_array['jml_detect']; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b><p class="numb text-center"><b><?php echo $jml_array['jml_error']; ?></b></p></td>
                  </tr>
               </table>
            </div>
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
      } 
	  //END PINDAH ?>
   </div> 
</section> 
<!-- /.content -->
<?php include "foot.php"; ?>
	  