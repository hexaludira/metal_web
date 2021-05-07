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
            <input placeholder="From Date" class="" type="text" name="tgl1" required=""> -
            <input placeholder="To Date" class="" type="text" name="tgl2"
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
               <option value="A-01">Cell A-1</option>
               <option value="A-02">Cell A-2</option>
               <option value="A-03">Cell A-3</option>
               <option value="A-04">Cell A-4</option>
               <option value="A-05">Cell A-5</option>
               <option value="A-06">Cell A-6</option>
               <option value="A-07">Cell A-7</option>
               <option value="A-08">Cell A-8</option>
               <option value="A-09">Cell A-9</option>
               <option value="A-10">Cell A-10</option>
               <option value="A-11">Cell A-11</option>
               <option value="A-12">Cell A-12</option>
               <option value="A-13">Cell A-13</option>
               <option value="A-14">Cell A-14</option>
               <option value="A-15">Cell A-15</option>
               <option value="A-16">Cell A-16</option>
               <option value="A-17">Cell A-17</option>
               <option value="A-18">Cell A-18</option>
			   <option value="C-01">Cell C-1</option>
               <option value="C-02">Cell C-2</option>
               <option value="C-03">Cell C-3</option>
               <option value="C-04">Cell C-4</option>
               <option value="C-05">Cell C-5</option>
               <option value="C-06">Cell C-6</option>
               <option value="C-07">Cell C-7</option>
               <option value="C-08">Cell C-8</option>
               <option value="C-09">Cell C-9</option>
               <option value="C-10">Cell C-10</option>
               <option value="C-11">Cell C-11</option>
               <option value="C-12">Cell C-12</option>
               <option value="C-13">Cell C-13</option>
               <option value="C-14">Cell C-14</option>
               <option value="C-15">Cell C-15</option>
               <option value="C-16">Cell C-16</option>
               <option value="C-17">Cell C-17</option>
               <option value="C-18">Cell C-18</option>
               <option value="C-19">Cell C-19</option>
               <option value="C-20">Cell C-20</option>
               <option value="C-21">Cell C-21</option>
               <option value="C-22">Cell C-22</option>
               <option value="C-23">Cell C-23</option>
               <option value="C-24">Cell C-24</option>
               <option value="C-25">Cell C-25</option>
               <option value="C-26">Cell C-26</option>
               <option value="C-27">Cell C-27</option>
			   <option value="D-01">Cell D-1</option>
               <option value="D-02">Cell D-2</option>
               <option value="D-03">Cell D-3</option>
               <option value="D-04">Cell D-4</option>
               <option value="D-05">Cell D-5</option>
               <option value="D-06">Cell D-6</option>
               <option value="D-07">Cell D-7</option>
               <option value="D-08">Cell D-8</option>
               <option value="D-09">Cell D-9</option>
               <option value="D-10">Cell D-10</option>
               <option value="D-11">Cell D-11</option>
               <option value="D-12">Cell D-12</option>
               <option value="D-13">Cell D-13</option>
               <option value="D-14">Cell D-14</option>
               <option value="D-15">Cell D-15</option>
               <option value="D-16">Cell D-16</option>
               <option value="D-17">Cell D-17</option>
               <option value="D-18">Cell D-18</option>
               <option value="D-19">Cell D-19</option>
               <option value="D-20">Cell D-20</option>
               <option value="D-21">Cell D-21</option>
               <option value="D-22">Cell D-22</option>
               <option value="D-23">Cell D-23</option>
               <option value="D-24">Cell D-24</option>
               <option value="D-51">Cell D-51</option>
               <option value="D-52">Cell D-52</option>
               <option value="D-53">Cell D-53</option>
               <option value="D-54">Cell D-54</option>
               <option value="D-55">Cell D-55</option>
               <option value="D-56">Cell D-56</option>
               <option value="D-57">Cell D-57</option>
               <option value="D-58">Cell D-58</option>
               <option value="D-59">Cell D-59</option>
               <option value="D-60">Cell D-60</option>
               <option value="D-61">Cell D-61</option>
               <option value="D-62">Cell D-62</option>
               <option value="D-63">Cell D-63</option>
               <option value="D-64">Cell D-64</option>
               <option value="D-65">Cell D-65</option>
               <option value="D-66">Cell D-66</option>
               <option value="D-67">Cell D-67</option>
               <option value="D-68">Cell D-68</option>
               <option value="D-69">Cell D-69</option>
               <option value="D-70">Cell D-70</option>
               <option value="D-71">Cell D-71</option>
               <option value="D-72">Cell D-72</option>
               <option value="D-73">Cell D-73</option>
               <option value="D-74">Cell D-74</option>
               <option value="D-75">Cell D-75</option>
               <option value="D-76">Cell D-76</option>
               <option value="D-77">Cell D-77</option>
               <option value="D-78">Cell D-78</option>
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
				if ($pass=='1'){ 
					for($c=1; $c<=18; $c++){
						if ($c<10){ ?>
               <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL A-0".$c; ?></td>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) { 					
				  $sql="SELECT pass,dates,no_cell,max(date) as date FROM data_daily WHERE no_cell='A-0$c'  and CONVERT(date, dates) BETWEEN '$date' AND '$end_date' GROUP BY date,dates,pass,no_cell";
				  $a=sqlsrv_query($con,$sql);
				  if (sqlsrv_has_rows($a) === true){
				  $h=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH);
                  if ($date==date_format($h['date'],'Y-m-d')) { ?>
                  <td><?php echo $h['pass']; ?></td>
				   <?php }else{?>
				   <td><?php echo "0";  }?></td>
				  <?php }$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));} ?>
				  <?php }ELSE{ ?>
				   <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL A-".$c; ?></td>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) { 					
				  $sql="SELECT pass,dates,no_cell,max(date) as date FROM data_daily WHERE no_cell='A-$c'  and CONVERT(date, dates) BETWEEN '$date' AND '$end_date' GROUP BY date,dates,pass,no_cell";
				  $a=sqlsrv_query($con,$sql);
				  if (sqlsrv_has_rows($a) === true){
				  $h=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH);
                  if ($date==date_format($h['date'],'Y-m-d')) { ?>
                  <td><?php echo $h['pass']; ?></td>
				   <?php }else{?>
				   <td><?php echo "0";  }?></td>
				  <?php }$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));}} ?>
                  <?php } 
				  for($c=1; $c<=27; $c++){
						if ($c<10){ ?>
               <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL C-0".$c; ?></td>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) { 					
				  $sql="SELECT pass,dates,no_cell,max(date) as date FROM data_daily WHERE no_cell='C-0$c'  and CONVERT(date, dates) BETWEEN '$date' AND '$end_date' GROUP BY date,dates,pass,no_cell";
				  $a=sqlsrv_query($con,$sql);
				  if (sqlsrv_has_rows($a) === true){
				  $h=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH);
                  if ($date==date_format($h['date'],'Y-m-d')) { ?>
                  <td><?php echo $h['pass']; ?></td>
				   <?php }else{?>
				   <td><?php echo "0";  }?></td>
				  <?php }$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));} ?>
				  <?php }ELSE{ ?>
				   <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL C-".$c; ?></td>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) { 					
				  $sql="SELECT pass,dates,no_cell,max(date) as date FROM data_daily WHERE no_cell='C-$c'  and CONVERT(date, dates) BETWEEN '$date' AND '$end_date' GROUP BY date,dates,pass,no_cell";
				  $a=sqlsrv_query($con,$sql);
				  if (sqlsrv_has_rows($a) === true){
				  $h=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH);
                  if ($date==date_format($h['date'],'Y-m-d')) { ?>
                  <td><?php echo $h['pass']; ?></td>
				   <?php }else{?>
				   <td><?php echo "0";  }?></td>
				  <?php }$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));}} ?>
                  <?php } 
				  for($c=1; $c<=78; $c++){
						if ($c<10){ ?>
               <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL D-0".$c; ?></td>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) { 					
				  $sql="SELECT pass,dates,no_cell,max(date) as date FROM data_daily WHERE no_cell='D-0$c'  and CONVERT(date, dates) BETWEEN '$date' AND '$end_date' GROUP BY date,dates,pass,no_cell";
				  $a=sqlsrv_query($con,$sql);
				  if (sqlsrv_has_rows($a) === true){
				  $h=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH);
                  if ($date==date_format($h['date'],'Y-m-d')) { ?>
                  <td><?php echo $h['pass']; ?></td>
				   <?php }else{?>
				   <td><?php echo "0";  }?></td>
				  <?php }$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));} ?>
				  <?php }ELSE{ ?>
				   <tr>
                  <td style="border-bottom-color:white;"><?php echo "CELL D-".$c; ?></td>
                  <td>PASS</td>
                  <?php
                  $date = $_POST['tgl1'];
                  $end_date=$_POST['tgl2'];
                  while (strtotime($date) <= strtotime($end_date)) { 					
				  $sql="SELECT pass,dates,no_cell,max(date) as date FROM data_daily WHERE no_cell='D-$c'  and CONVERT(date, dates) BETWEEN '$date' AND '$end_date' GROUP BY date,dates,pass,no_cell";
				  $a=sqlsrv_query($con,$sql);
				  if (sqlsrv_has_rows($a) === true){
				  $h=sqlsrv_fetch_array($a,SQLSRV_FETCH_BOTH);
                  if ($date==date_format($h['date'],'Y-m-d')) { ?>
                  <td><?php echo $h['pass']; ?></td>
				   <?php }else{?>
				   <td><?php echo "0";  }?></td>
				  <?php }$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));}} ?>
                  <?php } ?>
                  <?php } ?>
                  
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