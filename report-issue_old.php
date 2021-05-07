<?php include "head.php" ?>
<div class="content-header">
   <p class="text-center" style="font-size: 20px">
      <b>SEARCH BY ISSUE</b> (<?php echo date('Y-m-d');?>)
   </p>
</div>
<section class="content">
   <div class="col-sm-12 text-center">
      
      <form action="" method="post">
         <div class="form-group">
            <label>Select Date : </label>
            <input placeholder="From Date" type="text" name="tgl1" required=""> -
            <input placeholder="To Date" type="text" name="tgl2"
            required="">
         </div>
         <div class="form-group">
            <label>Select Data : </label>
            <label class="checkbox-inline">
               <input type="checkbox" name="allcek" value="10">All
            </label>
            <label class="checkbox-inline">
               <input type="checkbox" name="pass" value="1">Pass
            </label>
            <label class="checkbox-inline">
               <input type="checkbox" name="detect" value="2">Detect
            </label>
            <label class="checkbox-inline">
               <input type="checkbox" name="error" value="3">Error
            </label>
            <!-- <label class="checkbox-inline">
               <input type="checkbox" name="cal" value="5">Calibrate
            </label> -->
         </div>
         <div class="form-group">
            <label>Select Cell : &nbsp &nbsp</label>
            <label class="checkbox-inline">
               <input type="checkbox" name="allcel" value="8"> All &nbsp &nbsp
            </label>
            <select name="cell">
               <option>pilih</option>
               <option value="1">Cell 1</option>
               <option value="2">Cell 2</option>
               <option value="3">Cell 3</option>
               <option value="4">Cell 4</option>
               <option value="5">Cell 5</option>
               <option value="6">Cell 6</option>
               <option value="7">Cell 7</option>
               <option value="8">Cell 8</option>
               <option value="9">Cell 9</option>
               <option value="10">Cell 10</option>
               <option value="11">Cell 11</option>
               <option value="12">Cell 12</option>
               <option value="13">Cell 13</option>
               <option value="14">Cell 14</option>
               <option value="15">Cell 15</option>
               <option value="16">Cell 16</option>
               <option value="17">Cell 17</option>
               <option value="18">Cell 18</option>
               <option value="19">Cell 19</option>
               <option value="20">Cell 20</option>
               <option value="21">Cell 21</option>
               <option value="22">Cell 22</option>
               <option value="23">Cell 23</option>
               <option value="24">Cell 24</option>
               <option value="25">Cell 25</option>
            </select></p>
         </div>
         <div class="form-group">
            <p><input type="submit" name="search" value="Search"></p>
         </div>
      </form>
      
   </div>
   <div class="scroll">
      <div class="tes">
         <p align="right"> <a href="#" class="export btn btn-info">Download <i class="fa fa-download"></i></a></p>
         <div id="dvData">
            <?php
            error_reporting(~E_NOTICE);
            //date 1
            $tgl1 = $_POST['tgl1'];
            $tgle1=date_create($tgl1);
            $date1= date_format($tgle1, "d");
            //date 2
            $tgl2 = $_POST['tgl2'];
            $tgle2=date_create($tgl2);
            $date2=date_format($tgle2, "d");
            //ALL CELL
            $allcel  = $_POST['allcel'];
            $allcek  = $_POST['allcek'];
            $pass    = $_POST['pass'];
            $detect  = $_POST['detect'];
            $error   = $_POST['error'];
            $cal     = $_POST['cal'];
            $cell    = $_POST['cell'];
            ?>
            <br>
            <table class="table table-bordered">
               <tr>
                  <td style="border-right-color:white;"></td>
                  <td></td>
                  <?php
                  // Start date
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) { ?>
                  <td><?php echo $date ?></td>
                  <?php $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); } ?>
                  
               </tr>
               <?php
               //check semua cell
               if ($allcel=='8'){
               for($c=1; $c<=25; $c++){?>
               <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL".$c; ?></td>
                  <?php if ($pass=='1'){ ?>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT pass,dates,no_cell,date FROM data_daily WHERE no_cell=$c and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['pass']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } elseif($allcek=='10') { ?>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT pass,dates,no_cell,date FROM data_daily WHERE no_cell=$c and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['pass']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } else{} ?>
               </tr>
               <tr>
                  <td style="border-bottom-color:white;"></td>
                  <?php if ($detect=='2'){ ?>
                  <td>DETECT</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT detect,dates,no_cell,date FROM data_daily WHERE no_cell=$c and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['detect']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } elseif($allcek=='10') { ?>
                  <td>DETECT</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT detect,dates,no_cell,date FROM data_daily WHERE no_cell=$c and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['detect']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } else{} ?>
               </tr>
               <tr>
                  
                  <?php if ($error=='3'){ ?>

                  <td>ERROR1</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT error,dates,no_cell,date FROM data_daily WHERE no_cell=$c and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['error']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } elseif($allcek=='10') { ?>
                  <td>ERROR</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT error,dates,no_cell,date FROM data_daily WHERE no_cell=$c and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['error']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } else{} ?>
               </tr>
               
               <?php }} elseif($cell=='1' || $cell=='2' || $cell=='3'|| $cell=='4' || $cell=='5' || $cell=='6' || $cell=='7' || $cell=='8' || $cell=='9' || $cell=='10'|| $cell=='11' || $cell=='12' || $cell=='13' || $cell=='14' || $cell=='15' || $cell=='16' || $cell=='17' || $cell=='18' || $cell=='19' || $cell=='20'|| $cell=='21' || $cell=='22' || $cell=='23' || $cell=='24' || $cell=='25' ) { ?>
               
               <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL ".$cell; ?></td>
                  <?php if ($pass=='1'){ ?>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT pass,dates,no_cell,date FROM data_daily WHERE no_cell=$cell and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                     
                     <td><?php echo $h['pass']; ?></td>
                     <?php } elseif($date!=$h['date']){ ?>
                     <td>0</td>
                     <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                 

                  <?php } elseif($allcek=='10') { ?>
                 

                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT pass,dates,no_cell,date FROM data_daily WHERE no_cell=$cell and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['pass']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } else{} ?>
               </tr>
               <tr>
                  <td style="border-bottom-color:white;"></td>
                  <?php if ($detect=='2'){ ?>
                  <td>DETECT</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT detect,dates,no_cell,date FROM data_daily WHERE no_cell=$cell and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['detect']; ?></td>
                  <?php } elseif($date!=$h['date']){ ?>
                  <td>0</td>
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } elseif($allcek=='10') { ?>
                  
                  <td>DETECT</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT detect,dates,no_cell,date FROM data_daily WHERE no_cell=$cell and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['detect']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } else{} ?>
               </tr>
               <tr>
                  <td></td>
                  <?php if ($error=='3'){ ?>
                  <td>ERROR</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT error,dates,no_cell,date FROM data_daily WHERE no_cell=$cell and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['error']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } elseif($allcek=='10') { ?>
                 
                  <td>ERROR</td>
                  <?php
                  $date = $_POST['tgl1'];
                  // End date
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) {
                  $q=mysqli_query($con,"SELECT error,dates,no_cell,date FROM data_daily WHERE no_cell=$cell and date(dates) BETWEEN '$date' AND '$end_date' GROUP BY date");
                  $h=mysqli_fetch_array($q);
                  // while($h=mysqli_fetch_array($q)){
                  if ($date==$h['date']) { ?>
                  <td><?php echo $h['error']; ?></td>
                  
                  <?php } elseif($date!=$h['date']){ ?>
                  
                  <td>0</td>
                  
                  <?php } $date = date ("Y-m-d", strtotime("+1 day", strtotime($date))); }?>
                  <?php } else{} ?>
               </tr>
               <?php } ?>
            </table>
         </div>
      </div>
   </div>
   
</section>
<?php include "foot.php" ?>
<script>
$(document).ready(function(){
var date_input=$('input[name="tgl1"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
date_input.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
})
</script>
<script>
$(document).ready(function(){
var date_input=$('input[name="tgl2"]'); //our date input has the name "date"
var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
date_input.datepicker({
format: 'yyyy-mm-dd',
container: container,
todayHighlight: true,
autoclose: true,
})
})
</script>
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
$tgl1 = $_POST['tgl1'];
$tgl2 = $_POST['tgl2'];
}
?>
// CSV
var args = [$('#dvData>table'), 'mdm-download-from-<?php echo $tgl1 ?>-to-<?php echo $tgl2 ?>.csv'];
exportTableToCSV.apply(this, args);
// If CSV, don't do event.preventDefault() or return false
// We actually need this to be a typical hyperlink
});
});
</script>
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
height: 380px;
overflow: scroll;
}
</style>