<?php include "head.php" ?>
<!-- Main content -->


<section class="content">
   
  
   
   <div class="table-responsive">
      <!-- <button type="submit" class="btn btn-info pull-right">Download <i class="fa fa-download"></i></button><br><br> -->
      <!-- <p align="right"> <a href="#" class="export btn btn-info">Download <i class="fa fa-download"></i></a></p> -->
      
         
        
         <section class="content">
             <form action="calibration_fix.php" method="POST">
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Calibration Fix</h3>
                        <br><br>
                        
                    </div>
                    <div class="box-body">

                        
                    <div class="col-sm-2">
                                <br>
                                <div class="form-group">
                                    
                                    <label>07.00</label>
                                </div>
                                <div class="form-group">
                                    <label>09.00</label>
                                </div>
                                <div class="form-group">
                                    <label>11.00</label>
                                </div>
                                <div class="form-group">
                                    <label>13.00</label>
                                </div>
                                <div class="form-group">
                                    <label>15.00</label>
                                </div>

                            </div>
                        <div class="col-sm-2">
                            
                                <b>OK</b>
                               
                           

                            <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <!-- <input type="radio" name="jam_7" class="iradio_flat-red" >x -->
                                    <input type="radio" name="jam_7" class="iradio_flat-red"  value="3">

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_9" class="iradio_flat-red" <?php if (isset($jam_9) && $jam_9=="OK") echo "checked";?> value="3">

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_11" class="iradio_flat-red" <?php if (isset($jam_11) && $jam_11=="OK") echo "checked";?> value="3">

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_13" class="iradio_flat-red" <?php if (isset($jam_13) && $jam_13=="OK") echo "checked";?> value="3">

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_15" class="iradio_flat-red" <?php if (isset($jam_15) && $jam_15=="OK") echo "checked";?> value="3">

                                    </div>
                                    </label>
                
                                </div>


                        </div>
                        <div class="col-sm-2">
                            <b>Failed</b>

                            <div>
                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_7" class="iradio_flat-red" >

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_9" class="iradio_flat-red" >

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_11" class="iradio_flat-red" >

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_13" class="iradio_flat-red" >

                                    </div>
                                    </label>
                
                                </div>

                                <div class="form-group">
                                    <label class>
                                    <div class="iradio_flat-red">
                                    <input type="radio" name="jam_15" class="iradio_flat-red" >

                                    </div>
                                    </label>
                
                                </div>


                        </div>
                    </div>

                    
                </div>
            </div>

        </section>
        

        <section class="content" style="min-height:100px ">
   
   <div class="col-md-12 text-center">
      <section class="content-header">
         
           
               <div class="col-md-4">
                  <label class="control-label">Pilih Tanggal</label>
                  <div id="datepicker" class="input-group date" data-date-format="yyyy-mm-dd">
                     <input class="form-control  custom-input" type="text" name="tanggal" placeholder="yyyy-mm-dd" required="required" />
                     <span class="input-group-addon  bg-white"> <i class="fa fa-sort-desc"></i></span>
                    </div>
                </div>
                    
                <div class="col-md-4">
                     <label class="control-label">Pilih Cell</label>
                  <select class="form-control" name="cell" require>

                    <!-- <option value=''>Pilih</option>
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
                    <option value="E-51">Cell E-51</option>
                    <option value="E-52">Cell E-52</option>
                    <option value="E-53">Cell E-53</option>
                    <option value="E-54">Cell E-54</option>
                    <option value="E-55">Cell E-55</option>
                    <option value="E-56">Cell E-56</option>
                    <option value="E-57">Cell E-57</option>
                    <option value="E-58">Cell E-58</option>
                    <option value="E-59">Cell E-59</option> -->

                    <?php 

                        $query_no_cell = "SELECT no_cell FROM dbo.data_daily WHERE no_cell !='EX' and no_cell!='' and LEN(no_cell)>2  group by no_cell order by no_cell";
                        $run_query = sqlsrv_query($con,$query_no_cell);

                        while($list_cell=sqlsrv_fetch_array($run_query,SQLSRV_FETCH_BOTH))
                        { ?>
                            <option value="<?php echo $list_cell['no_cell'];?>"><?php echo 'Cell '.$list_cell['no_cell']; ?></option>

                        <?php }
                    ?>
                    

                  </select>
                  
                  
                  </div>
            <div class="col-md-2 center-block form-group">
                <!-- <label>dsds</label> -->
                </br>
                <input type="submit" name="perbaiki" type="button" class="btn btn-primary btn-flat pull-left" value="Perbaiki">
                
            </div>
                  
             
    </div>

      </section>
   
</section>
         <table class="table table-bordered text-center" name="data">
            
            <tr>
                
               <?php
               if (isset($_POST['perbaiki'])) {

               $tanggal = $_POST['tanggal'];
               $cell = $_POST['cell'];
                $jam7 = isset($_POST['jam_7'])?(int)$_POST['jam_7']:0;
                $jam9 = isset($_POST['jam_9'])?(int)$_POST['jam_9']:0;
                $jam11 = isset($_POST['jam_11'])?(int)$_POST['jam_11']:0;
                $jam13 = isset($_POST['jam_13'])?(int)$_POST['jam_13']:0;
                $jam15 = isset($_POST['jam_15'])?(int)$_POST['jam_15']:0;
            
               
 
                //$sql="SELECT no_cell, COUNT(no_cell) as jml_cell FROM dbo.[data_daily] WHERE CONVERT(date, dates)='$tanggal' GROUP BY no_cell";
               $sql = "SELECT COUNT(no_cell) as jml_cell FROM dbo.[data_daily] WHERE CONVERT(date, dates)= '$tanggal' and no_cell!=''";
                $h=sqlsrv_query($con,$sql);
               $sql2 = "SELECT no_cell FROM dbo.[data_daily] WHERE CONVERT(date, dates)= '$tanggal' and no_cell!=''  order by no_cell asc";
               $h2=sqlsrv_query($con,$sql2);
             
              $total = $jam7 + $jam9 + $jam11 + $jam13 + $jam15;

               //echo $total;

               $sql3 = "UPDATE dbo.[data_daily] SET cal_f_c = $total WHERE CONVERT(date, dates)= '$tanggal' and no_cell='$cell'";
              
               $update_cal = sqlsrv_query($con, $sql3); 
            
            }
               ?>
			   
            </tr>
               
         </table>
      </div>
      </form>
      
   </div>
   
</section>
<!-- /.content -->
<?php include "foot.php" ?>


