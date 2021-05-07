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
      
      //$cell_awal=1;
     // $cell_akhir=90;
      //for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      //$sql="SELECT TOP 1 dates,sum(pass) as 't_pass' , sum(detect) as 't_detect', sum(error) as 't_error' FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	 // $sql="SELECT TOP 1 dates, pass , detect , error FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	 // $q = sqlsrv_query($con,$sql);
		//$jml_detect=0;
		//$jml_pass=0;
		//$jml_error=0;
		
  	  //while($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)){
		  //FACTORY A
      $cell_awal=12;
      $cell_akhir=25;
      for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error,total FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
     //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      //$sql="SELECT TOP 1 dates,sum(pass) as 't_pass' , sum(detect) as 't_detect', sum(error) as 't_error' FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $sql1="SELECT TOP 1 dates, pass , detect , error FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $a = sqlsrv_query($con,$sql1);
		// $ajml_detect=0;
		// $ajml_pass=0;
		// $ajml_error=0;
  	  while($b = sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH)){
      
	  $array_pass = array();
	  array_push($array_pass, $b['pass']);
	  //$array_pass[] = array_push($t['pass']);
	  $ajml_pass = array_sum($array_pass);
	  
	  $array_detect = array();
	  array_push($array_detect, $b['detect']);
      $ajml_detect = array_sum($array_detect);
	  
	  $array_error = array();
	  array_push($array_error, $b['error']);
	  $ajml_error = array_sum($array_error);
	  
	  // $jml_pass += $t['pass'];
      // $jml_detect += $t['detect'];
      // $jml_error += $t['error'];
	  }}
	  //FACTORY C
	  $cell_awal=1;
      $cell_akhir=11;
      for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      //$q = sqlsrv_query($con,"SELECT dates,no_cell,pass,detect,error FROM data_real_time WHERE no_cell=$i AND date(dates)=CURRENT_DATE() ORDER BY dates DESC");
      //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error,total FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      //$sql="SELECT TOP 1 dates,sum(pass) as 't_pass' , sum(detect) as 't_detect', sum(error) as 't_error' FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $sql2="SELECT TOP 1 dates,pass , detect , error FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $c = sqlsrv_query($con,$sql2);
		// $cjml_detect=0;
		// $cjml_pass=0;
		// $cjml_error=0;
  	  while($d = sqlsrv_fetch_array($c,SQLSRV_FETCH_BOTH)){
		  
	  $array_pass = array();
	  array_push($array_pass, $d['pass']);
	  //$array_pass[] = array_push($t['pass']);
	  $cjml_pass = array_sum($array_pass);
	  
	  $array_detect = array();
	  array_push($array_detect, $d['detect']);
      $cjml_detect = array_sum($array_detect);
	  
	  $array_error = array();
	  array_push($array_error, $d['error']);
	  $cjml_error = array_sum($array_error);
      // $cjml_pass += $t['pass'];
      // $cjml_detect += $t['detect'];
      // $cjml_error += $t['error'];
	  }}
	   //FACTORY D
      $cell_awal=30;
      $cell_akhir=90;
      for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      $sql3="SELECT TOP 1 dates,pass , detect , error FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $e = sqlsrv_query($con,$sql3);
		// $djml_detect=0;
		// $djml_pass=0;
		// $djml_error=0;
  	  while($f = sqlsrv_fetch_array($e,SQLSRV_FETCH_BOTH)){
		  
	  $array_pass = array();
	  array_push($array_pass, $f['pass']);
	  //$array_pass[] = array_push($t['pass']);
	  $djml_pass = array_sum($array_pass);
	  
	  $array_detect = array();
	  array_push($array_detect, $f['detect']);
      $djml_detect = array_sum($array_detect);
	  
	  $array_error = array();
	  array_push($array_error, $f['error']);
	  $djml_error = array_sum($array_error);
      // $djml_pass += $t['pass'];
      // $djml_detect += $t['detect'];
      // $djml_error += $t['error'];
	  }}
	  $array_pass = array($ajml_pass,$cjml_pass,$djml_pass);
	  //array_push($array_pass, $t['pass']);
	  $jml_pass = array_sum($array_pass);
	 	  
	  $array_detect = array();
	  //array_push($array_detect, $t['detect']);
      $jml_detect = array_sum($array_detect);
	  
	  $array_error = array();
	  //array_push($array_error, $t['error']);
	  $jml_error = array_sum($array_error);
	  
	 
	  //}}?>
      <div class="col-xs-4 col-md-4">
         <div class="pass-o pull-right text-center"><br>
            <p style="padding-top:5px; font-size: 45px"><b><?php echo $jml_pass; ?></b></p>
            <!-- <p style="padding-top:5px;font-size: 45px">10000</p> -->
            <p style="padding-top: 50px;font-size: 30px;"><b>PASS</b></p>
         </div>
      </div>
      <div class="col-xs-4 col-md-4">
         <div class="detect-o text-center"><br>
            <p style="padding-top:5px; font-size: 45px"><b><?php echo $jml_detect; ?></b></p>
            <!-- <p style="padding-top:5px; font-size: 45px">10000</p> -->
            <p style="padding-top: 50px;font-size: 30px"><b>DETECT</b></p>
         </div>
      </div>
      <div class="col-xs-4 col-md-4">
         <div class="error-o pull-left text-center"><br>
            <p style="padding-top:5px; font-size: 45px"><b><?php echo '72'//$jml_error; ?></b></p>
            <!-- <p style="padding-top:5px; font-size: 45px"><b>00000</b></p> -->
            <p style="padding-top: 50px;font-size: 30px"><b>ERROR</b></p>
         </div>
      </div>
   </div>
   
</section>
	  
	  
	  
<section class="content">
   <div class="row">
      <?php
      // FACTORY A
      $cell_awal=12;
      $cell_akhir=25;
      for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error,total FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
     //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      //$sql="SELECT TOP 1 dates,sum(pass) as 't_pass' , sum(detect) as 't_detect', sum(error) as 't_error' FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $sql="SELECT TOP 1 dates, pass , detect , error FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $q = sqlsrv_query($con,$sql);
		// $ajml_detect=0;
		// $ajml_pass=0;
		// $ajml_error=0;
  	  while($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)){
      
	  $array_pass = array();
	  array_push($array_pass, $t['pass']);
	  //$array_pass[] = array_push($t['pass']);
    $ajml_pass = array_sum($array_pass);
    //echo $array_pass;
	  
	  $array_detect = array();
	  array_push($array_detect, $t['detect']);
    $ajml_detect = array_sum($array_detect);
	  
	  $array_error = array();
	  array_push($array_error, $t['error']);
	  $ajml_error = array_sum($array_error);
	  
	  // $jml_pass += $t['pass'];
      // $jml_detect += $t['detect'];
      // $jml_error += $t['error'];
	  }}
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9;">
            <div class="box-header with-border">
               <h3 class="text-center"><b>FACTORY A</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b> <p class="numb text-center"><b><?php echo $ajml_pass; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b> <p class="numb text-center"><b><?php echo $ajml_detect; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b> <p class="numb text-center"><b><?php echo '31'//$ajml_error; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
	  
      <?php
      // FACTORY C
      $cell_awal=1;
      $cell_akhir=11;
      for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      //$q = sqlsrv_query($con,"SELECT dates,no_cell,pass,detect,error FROM data_real_time WHERE no_cell=$i AND date(dates)=CURRENT_DATE() ORDER BY dates DESC");
      //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error,total FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      //$q=sqlsrv_query($con,"SELECT dates, no_cell, pass, detect, error FROM data_real_time WHERE pass=(SELECT max(pass) FROM data_real_time WHERE no_cell='$i') GROUP BY dates DESC LIMIT 1");
      //$sql="SELECT TOP 1 dates,sum(pass) as 't_pass' , sum(detect) as 't_detect', sum(error) as 't_error' FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $sql="SELECT TOP 1 dates,pass , detect , error FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $q = sqlsrv_query($con,$sql);
		// $cjml_detect=0;
		// $cjml_pass=0;
		// $cjml_error=0;
  	  while($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)){
		  
	  $array_pass = array();
	  array_push($array_pass, $t['pass']);
	  //$array_pass[] = array_push($t['pass']);
	  $cjml_pass = array_sum($array_pass);
	  
	  $array_detect = array();
	  array_push($array_detect, $t['detect']);
      $cjml_detect = array_sum($array_detect);
	  
	  $array_error = array();
	  array_push($array_error, $t['error']);
	  $cjml_error = array_sum($array_error);
      // $cjml_pass += $t['pass'];
      // $cjml_detect += $t['detect'];
      // $cjml_error += $t['error'];
	  }}
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9">
            <div class="box-header with-border">
               <h3 class="text-center"><b>FACTORY C</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b><p class="numb text-center"><b><?php echo $cjml_pass; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b><p class="numb text-center"><b><?php echo $cjml_detect; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b><p class="numb text-center"><b><?php echo '20'//$cjml_error; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
	  
      <?php
      //FACTORY D
      $cell_awal=30;
      $cell_akhir=80;
      for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      $sql4="SELECT TOP 1 dates,pass , detect , error FROM dbo.[data_real_time] WHERE no_cell=$i ORDER BY dates DESC";
	  $q = sqlsrv_query($con,$sql4);
		// $djml_detect=0;
		// $djml_pass=0;
		// $djml_error=0;
  	  while($x = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)){
		  
	  $array_pass = array();
	  array_push($array_pass, $x['pass']);
	  //$array_pass[] = array_push($t['pass']);
	  $djml_pass = array_sum($array_pass);
	  
	  $array_detect = array();
	  array_push($array_detect, $x['detect']);
      $djml_detect = array_sum($array_detect);
	  
	  $array_error = array();
	  array_push($array_error, $x['error']);
	  $djml_error = array_sum($array_error);
      // $djml_pass += $t['pass'];
      // $djml_detect += $t['detect'];
      // $djml_error += $t['error'];
	  }}
	  ?>
      <div class="col-md-4">
         <div class="box box-solid" style="background-color: #e9e9e9">
            <div class="box-header with-border">
               <h3 class="text-center"><b>FACTORY D</b></h3>
            </div>
            <div class="box-body">
               <table class="table text-center">
                  <tr>
                     <td bgcolor="#438bc6" class="head" style="min-width:100px;"><b>PASS</b><p class="numb text-center"><b><?php echo $djml_pass; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#da5550" class="head" style="min-width:100px;"><b>DETECT</b><p class="numb text-center"><b><?php echo $djml_detect; ?></b></p></td>
                     <td></td>
                     <td bgcolor="#f2aa56" class="head" style="min-width:100px;"><b>ERROR</b><p class="numb text-center"><b><?php echo '21'//$djml_error; ?></b></p></td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
    
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
      if ($pecah==6) {
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
      if ($pecah==17) {
      $cell_awal=1;
      $cell_akhir=90;
      for ($i=$cell_awal; $i <= $cell_akhir ; $i++) {
      //CEK DATA 
	  $sql="SELECT no_cell, dates FROM dbo.[data_daily] WHERE no_cell=$i AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP)";
      $cek1=sqlsrv_query($con,$sql);
      if ($cek1) {
					  $rows = sqlsrv_has_rows( $cek1 );
					  if ($rows === true){
						 
						   }
						  else{
						 
						  }
				}
      else {
      //CELL 1+
	  $sql="INSERT INTO dbo.[data_daily] SELECT TOP 1 dates,'$tgl', '$wkt', no_cell, pass, detect, total, error, cal_f_c, cal_f_m, cal_b_c, cal_b_m, c_a, test_s, test_other FROM dbo.[data_real_time] WHERE no_cell=$i AND CONVERT(date, dates) = CONVERT(date, CURRENT_TIMESTAMP) ORDER BY dates DESC";
      $masuk=sqlsrv_query($con,$sql);
      }
      }
      } //END PINDAH ?>
   </div> 
</section> 
<!-- /.content -->
<?php include "foot.php"; ?>
	  