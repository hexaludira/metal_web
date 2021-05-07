<?php include "head.php" ?>
<!-- Main content -->
<div class="content-header">
   <p class="text-center" style="font-size: 20px">
      <b>DAILY REPORT</b> (<?php echo date('Y-m-d');?>)
   </p>
</div>
<section class="content" style="min-height:100px ">
   <div class="col-lg-8 col-md-offset-3">
      <section class="content-header">
         <form class="form-horizontal" method="POST" action="daily_report.php">
            <div class="col-sm-6">
               <div class="form-group">
                  <label class="col-sm-6 control-label">Select Date</label>
                  <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                     <input class="form-control custom-input" type="text" name="tanggal" placeholder="yyyy-mm-dd" required="required" />
                     <span class="input-group-addon  bg-white"> <i class="fa fa-sort-desc"></i></span>
                  </div>
                  
               </div>
            </div>
          
            <div class="col-sm-6">
               <input type="submit" name="search" type="button" class="btn btn-primary btn-flat" value="Search">
            </div>
           
         </form>
      </section>
   </div>
</section>
<section class="content">
   
   <?php if (isset($_POST['search'])){ ?>
   <div class="table-responsive">
      <!-- <button type="submit" class="btn btn-info pull-right">Download <i class="fa fa-download"></i></button><br><br> -->
      <p align="right"> <a href="#" class="export btn btn-info">Download <i class="fa fa-download"></i></a></p>
      <div id="dvData">
         <table>
            <tr>
               <td>Daily Report - Date : </td>
               <td><?php echo  $_POST['tanggal']; ?></td>
            </tr>
         </table>
         <table class="table table-bordered text-center" name="data">
            
            <tr>
               <td></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
                //$sql="SELECT no_cell, COUNT(no_cell) as jml_cell FROM dbo.[data_daily] WHERE CONVERT(date, dates)='$tanggal' GROUP BY no_cell";
               $sql = "SELECT COUNT(no_cell) as jml_cell FROM dbo.[data_daily] WHERE CONVERT(date, dates)= '$tanggal' and no_cell!=''";
                $h=sqlsrv_query($con,$sql);
               $sql2 = "SELECT no_cell FROM dbo.[data_daily] WHERE CONVERT(date, dates)= '$tanggal' and no_cell!=''  order by no_cell asc";
               $h2=sqlsrv_query($con,$sql2);
               //$hsl=sqlsrv_fetch_array($h);
               while($hsl=sqlsrv_fetch_array($h,SQLSRV_FETCH_BOTH)){
               $cell_awal=1;
               $cell_akhir=$hsl['jml_cell'];
               //$cell_akhir = 55;
                
                    for($i = $cell_awal; $i<= $cell_akhir; $i++){
                        $no_cell = sqlsrv_fetch_array($h2,SQLSRV_FETCH_BOTH);
                            
                            echo '<td><b> Cell '.$no_cell['no_cell'].'</b></td>';      
                    }

                }
                
            
            }
               ?>
			   <td><B>TOTAL</B></td>
            </tr>
            <tr>
               <td style="font-size: 15px"><b>PASS</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $sql="SELECT dates,pass FROM dbo.[data_daily] WHERE CONVERT(date, dates)='$tanggal' and no_cell!=''  order by no_cell asc";
               $q = sqlsrv_query($con,$sql);
			   $t_pass=0;
               while ($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               ?>
               <td><?php echo $t['pass']; ?></td>
               <?php  $t_pass=$t_pass+$t['pass'];}} ?>
			   <td><?php echo $t_pass; ?></td>
            </tr>
            <tr>
               <td style="font-size: 15px"><b>DETECT</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $sql="SELECT dates,detect FROM data_daily WHERE CONVERT(date, dates)='$tanggal' and no_cell!=''  order by no_cell asc";
               $q = sqlsrv_query($con,$sql);
			   $t_detect=0;
               while ($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
				   
               ?>
               <td><?php echo $t['detect']; ?></td>
               <?php $t_detect=$t_detect+$t['detect'];}} ?>
			   <td><?php echo $t_detect; ?></td>
            </tr>
            <tr>
               <td style="font-size: 15px"><b>ERROR</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $sql="SELECT dates,error FROM data_daily WHERE CONVERT(date, dates)='$tanggal' and no_cell!=''  order by no_cell asc";
               $q = sqlsrv_query($con,$sql);
			   $t_error=0;
               while ($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
				   
               ?>
               <td><?php echo $t['error']; ?></td>
               <?php $t_error=$t_error+$t['error'];}} ?>
			   <td><?php echo $t_error; ?></td>
            </tr>
			<tr>
			<td style="font-size: 15px"><b>CALIBRATION</b></td>
               <?php
			   
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $sql="SELECT dates, cal_f_c FROM data_daily WHERE CONVERT(date, dates)='$tanggal' and no_cell!=''  order by no_cell asc";
               $q = sqlsrv_query($con,$sql);
               while ($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               ?>
               <?php 
					$data_persen = $t['cal_f_c']/12*100;
					if ($data_persen >= 100){
						echo '<td style="background-color: #009900; color:black"><b>100%</b>';
					} else {
						echo '<td style="background-color: #ffcc00; color:black"><b>'.number_format($data_persen,2).'%</b>';
					}
					// echo $t['cal_f_c']; ?></td>
                </td><?php }} ?>
				<td>-</td>
			</tr>
            <tr>
               <td style="font-size: 15px"><b>TOTAL</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $sql="SELECT dates,error,pass,detect FROM data_daily WHERE CONVERT(date, dates)='$tanggal' and no_cell!=''  order by no_cell asc";
               $q = sqlsrv_query($con,$sql);
               while ($t = sqlsrv_fetch_array($q,SQLSRV_FETCH_BOTH)) {
               $total = $t['pass'] + $t['error'] + $t['detect'];
               ?>
               <td><?php echo $total; ?></td>
               <?php }} ?>
			   <?php $sqlt="SELECT sum(error)+sum(pass)+sum(detect) as ttl FROM data_daily WHERE CONVERT(date, dates)='$tanggal' and no_cell!=''";
               $qt = sqlsrv_query($con,$sqlt);
               while ($tt = sqlsrv_fetch_array($qt,SQLSRV_FETCH_BOTH)) {
               ?>
               <td><?php echo $tt['ttl']; ?></td>
               <?php }?>
			  
            </tr>
         </table>
      </div>
      
   </div>
   <?php
    } else { ?>
   
   <?php } ?>
</section>
<!-- /.content -->
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
$tanggal = $_POST['tanggal'];
}
?>
// CSV
var args = [$('#dvData>table'), 'mdm-download-<?php echo $tanggal ?>.csv'];
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
</style>
<!-- <script type="text/javascript">
$(function () {
$("#datepicker").datepicker({
autoclose: true,
todayHighlight: true
}).datepicker('update', new Date());;
});
</script> -->