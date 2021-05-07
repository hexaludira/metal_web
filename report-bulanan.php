<?php include "head.php" ?>
<div class="content-header">
   <p class="text-center" style="font-size: 20px">
      <b>MONTHLY REPORT</b> (<?php echo date('Y-m-d');?>)
   </p>
</div>
<section class="content">
   <div class="col-sm-8 col-sm-offset-2">
      <form class="form-horizontal" method="POST" action="monthly_report">
         <div class="col-sm-5">
            <div class="form-group">
               <label class="col-sm-4 control-label">Select Year</label>
               <div class="col-sm-8">
                  <select name="tahun" class="form-control">
                     <option value="">Pilih Tahun</option>
                     <?php
                     $mulai= date('Y') - 1;
                     for($a = $mulai;$a<$mulai +14;$a++){
                     $sel = $i == date('Y') ? ' selected="selected"' : '';
                     echo '<option value="'.$a.'"'.$sel.'>'.$a.'</option>';
                     }
                     ?>
                  </select>
               </div>
            </div>
            
         </div>
         <div class="col-sm-5">
            <div class="form-group">
               <label class="col-sm-5 control-label">Select Month</label>
               <div class="col-sm-7">
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
                     <option value="10">Oktober</option>
                     <option value="11">November</option>
                     <option value="12">December</option>
                  </select>
               </div>
            </div>
         </div>
         
         <div class="col-sm-2">
            <input type="submit" class="btn btn-primary btn-flat" name="search" value="Search">
         </div>
         
      </form>
      <hr>
   </div>
   <?php  if (isset($_POST['search'])) {
   $kalender = CAL_GREGORIAN;
   $bulan =$_POST['bulan'];
   $tahun =$_POST['tahun'];
   $hari = cal_days_in_month($kalender, $bulan, $tahun);
   ?>
   
   <p align="right"> <a href="#" class="export btn btn-info">Download <i class="fa fa-download"></i></a></p>
   <div class="scroll">
      <div class="tes">
         <!-- <button type="submit" class="btn btn-info pull-right">Download <i class="fa fa-download"></i></button><br><br> -->
         <div id="dvData">
            <table>
               <tr>
                  <td>Monthly Report - Year : </td>
                  <td><?php echo  $_POST['tahun']; ?></td>
                  <td> Month : </td>
                  <td><?php echo  $_POST['bulan']; ?></td>
               </tr>
            </table>
            <table class="table table-bordered">
               <tr>
                  <td style="border-right-color:white;"></td>
                  <td></td>
                  
                  <?php for ($tgl=1; $tgl<=$hari; $tgl++) {  ?>
                  <!-- <td><?php // echo $tgl; ?></td> -->
                  <td><?php echo $tahun."-".$bulan."-".$tgl; ?></td>
                  <?php }?>
                  
               </tr>
               <?php
               for($c=1; $c<=80; $c++)
               {?>
               <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL".$c; ?></td>
                  <td>PASS</td>
                  
                  <?php
                  for ($tgl=1; $tgl<=$hari; $tgl++) {
                  //$q = sqlsrv_query($con,"SELECT pass,date,no_cell, DAY(dates) as tgl1 FROM dbo.[data_daily] WHERE day(date)=$tgl and month(date)='$bulan' and year(date)='$tahun' and no_cell=$c GROUP BY date");
                  $q = "SELECT pass, date,no_cell, DAY(date) as tgl1 FROM dbo.[data_daily] WHERE day(date)=$tgl and month(date)='$bulan' and year(date)='$tahun' and no_cell=$c GROUP BY pass, no_cell, date";
                  
                    $q_query = sqlsrv_query($con, $q);

                  while($tds = sqlsrv_fetch_array($q_query,SQLSRV_FETCH_BOTH)){
                    $tgl2 = $tds['tgl1'];
                  if ($tgl==$tgl2) { ?>
                  <td><?php echo  $tds['pass']; ?></td>
                  <?php } elseif($tgl!=$tgl2){ ?>
                  <td>0</td>
                  <?php }}} ?>

            
                  
               </tr>
               <tr>
                  <td style="border-bottom-color:white;"></td>
                  <td>DETECT</td>
                  <?php
                  for ($tgl=1; $tgl<=$hari; $tgl++) {
                    $sql = "SELECT detect,date,no_cell, DAY(date) as tgl1 FROM dbo.[data_daily] WHERE   day(date)=$tgl and month(date)='$bulan' and year(date)='$tahun' and no_cell=$c GROUP BY detect,date, no_cell";

                  $q = sqlsrv_query($con, $sql);
                  while($tds = sqlsrv_fetch_array($q, SQLSRV_FETCH_BOTH)){

                  $tgl2 = $tds['tgl1'];
                  if ($tgl==$tgl2) { ?>
                  <td><?php echo  $tds['detect']; ?></td>
                  <?php } elseif($tgl!=$tgl2){ ?>
                  <td>0</td>
                  <?php } } }?>
               </tr>
               <tr>
                  <td style="border-bottom-color:white;"></td>
                  <td>ERROR</td>
                  <?php
                  for ($tgl=1; $tgl<=$hari; $tgl++) {
                    $sql = "SELECT error,date,no_cell, DAY(date) as tgl1 FROM dbo.[data_daily] WHERE   day(date)=$tgl and month(date)='$bulan' and year(date)='$tahun' and no_cell=$c GROUP BY error,date, no_cell";

                  $q = sqlsrv_query($con,$sql);

                  while($tds = sqlsrv_fetch_array($q, SQLSRV_FETCH_BOTH)){
                    $tgl2 = $tds['tgl1'];
                    if ($tgl==$tgl2) { ?>
                    <td><?php echo  $tds['error']; ?></td>
                    <?php } elseif($tgl!=$tgl2){ ?>
                    <td>0</td>
                  <?php } } }?>
               </tr>
			   <tr>
              
               <td>CALIBRATION</td>
               <?php
				for ($tgl=1; $tgl<=$hari; $tgl++) {
                    $sql = "SELECT cal_f_c,date,no_cell, DAY(date) as tgl1 FROM dbo.[data_daily] WHERE   day(date)=$tgl and month(date)='$bulan' and year(date)='$tahun' and no_cell=$c GROUP BY cal_f_c,date, no_cell";
                  
                    $q = sqlsrv_query($con, $sql);

                  while($td_cal = sqlsrv_fetch_array($q, SQLSRV_FETCH_BOTH)){
                  $tgl2 = $td_cal['tgl1'];
                  if ($tgl==$tgl2) { ?>
                  
					<?php 
						$data_persen = $td_cal['cal_f_c']/12*100;
						if($data_persen >= 100) { 
							echo '<td style="background-color: #009900; color:black"><b>100%</b>';
						} else {
							echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>';
						}
							?></td>
                  <?php } elseif($tgl!=$tgl2){ ?>
                  <td>0%</td>
                  <?php } } }?>

				</tr>
               <?php } ?>
            </table>
         </div>
      </div>
   </div>
   <?php } else {} ?>
</section>
<?php include "foot.php" ?>
<script type="text/javascript">
$(document).ready(function() {
function exportTableToCSV($table, filename) {
var $rows = $table.find('tr:has(td)'),
// Temporary delimiter characters unlikely to be typed by keyboard
// This is to avoid accidentally splitting the actual contents
tmpColDelim = String.fromCharCode(11), // vertical tab character
tmpRowDelim = String.fromCharCode(0), // null character
// actual delimiter characters for CSV format
colDelim = '","',
rowDelim = '"\r\n"',
// Grab text from table into CSV formatted string
csv = '"' + $rows.map(function(i, row) {
var $row = $(row),
$cols = $row.find('td');
return $cols.map(function(j, col) {
var $col = $(col),
text = $col.text();
return text.replace(/"/g, '""'); // escape double quotes
}).get().join(tmpColDelim);
}).get().join(tmpRowDelim)
.split(tmpRowDelim).join(rowDelim)
.split(tmpColDelim).join(colDelim) + '"';
// Deliberate 'false', see comment below
if (false && window.navigator.msSaveBlob) {
var blob = new Blob([decodeURIComponent(csv)], {
type: 'text/csv;charset=utf8'
});
// Crashes in IE 10, IE 11 and Microsoft Edge
// See MS Edge Issue #10396033
// Hence, the deliberate 'false'
// This is here just for completeness
// Remove the 'false' at your own risk
window.navigator.msSaveBlob(blob, filename);
} else if (window.Blob && window.URL) {
// HTML5 Blob
var blob = new Blob([csv], {
type: 'text/csv;charset=utf-8'
});
var csvUrl = URL.createObjectURL(blob);
$(this)
.attr({
'download': filename,
'href': csvUrl
});
} else {
// Data URI
var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
$(this)
.attr({
'download': filename,
'href': csvData,
'target': '_blank'
});
}
}
// This must be a hyperlink
$(".export").on('click', function(event) {
<?php
if (isset($_POST['search'])) {
$tahun = $_POST['tahun'];
$bulan = $_POST['bulan'];
}
?>
// CSV
var args = [$('#dvData>table'), 'mdm-download-year-<?php echo $tahun ?>-month-<?php echo $bulan ?>.csv'];
exportTableToCSV.apply(this, args);
// If CSV, don't do event.preventDefault() or return false
// We actually need this to be a typical hyperlink
});
});
</script>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> -->
<style type="text/css">
a.export, a.export:visited {
display: inline-block;
text-decoration: none;
color:white;
background-color:#00c0ef;
border: 1px solid #ccc;
padding:8px;
}
/*.tes {
width: 100%;
height: 10%;
overflow-x: auto;
overflow-y: auto;
padding-bottom: 100px;
margin-bottom: 100px;
}*/
div.scroll {
/*background-color: #00FFFF;*/
width: 100%;
height: 430px;
overflow: scroll;
}
</style>