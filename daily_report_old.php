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
               <input type="submit" name="search" type="button" class="btn btn-danger btn-flat" value="Search">
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
               $h=mysqli_query($con,"SELECT COUNT(no_cell) as jml_cell FROM data_daily WHERE date(dates)='$tanggal'");
               $hsl=mysqli_fetch_array($h);
               $cell_awal=1;
               $cell_akhir=$hsl['jml_cell'];
               for($i = $cell_awal; $i<= $cell_akhir; $i++){
               echo '<td><b> Cell '.$i.'</b></td>';
               }}
               ?>
            </tr>
            <tr>
               <td style="font-size: 15px"><b>PASS</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $q = mysqli_query($con,"SELECT dates,pass FROM data_daily WHERE date(dates)='$tanggal'");
               while ($t = mysqli_fetch_array($q)) {
               ?>
               <td><?php echo $t['pass']; ?></td>
               <?php }} ?>
            </tr>
            <tr>
               <td style="font-size: 15px"><b>DETECT</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $q = mysqli_query($con,"SELECT dates,detect FROM data_daily WHERE date(dates)='$tanggal'");
               while ($t = mysqli_fetch_array($q)) {
               ?>
               <td><?php echo $t['detect']; ?></td>
               <?php }} ?>
            </tr>
            <tr>
               <td style="font-size: 15px"><b>ERROR</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $q = mysqli_query($con,"SELECT dates,error FROM data_daily WHERE date(dates)='$tanggal'");
               while ($t = mysqli_fetch_array($q)) {
               ?>
               <td><?php echo $t['error']; ?></td>
               <?php }} ?>
            </tr>
            <tr>
               <td style="font-size: 15px"><b>TOTAL</b></td>
               <?php
               if (isset($_POST['search'])) {
               $tanggal = $_POST['tanggal'];
               $q = mysqli_query($con,"SELECT dates,error,pass,detect FROM data_daily WHERE date(dates)='$tanggal'");
               while ($t = mysqli_fetch_array($q)) {
               $total = $t['pass'] + $t['error'] + $t['detect'];
               ?>
               <td><?php echo $total; ?></td>
               <?php }} ?>
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