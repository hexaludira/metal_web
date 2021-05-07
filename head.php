<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <title>MDM | V.0.2</title>
      <link rel="icon" href="assets/favicon.ico" type="image/x-icon"/>
      <!-- Tell the browser to be responsive to screen width -->
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
      <!-- Bootstrap 3.3.7 -->
      <link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="assets/bower_components/font-awesome/css/font-awesome.min.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="assets/bower_components/Ionicons/css/ionicons.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="assets/dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="assets/custom.css">
      <link rel="stylesheet" href="assets/plugins/iCheck/all.css">
      
      <!-- AdminLTE Skins. Choose a skin from the css/skins
      folder instead of downloading all of them to reduce the load. -->
      <link rel="stylesheet" href="assets/dist/css/skins/_all-skins.min.css">
      <link rel='stylesheet prefetch' href='assets/bootstrap-datepicker/css/bootstrap-datepicker.css'>
      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
      <!-- Google Font -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
   </head>
   <body class="hold-transition skin-blue">
      <?php  include "config/koneksi.php";?>
      <!-- Site wrapper -->
      <div class="wrapper">
         <header class="main-header" style="border-bottom: 1px solid #ddd">
            <!-- Logo -->
            <a href="index" class="logo" style="background-color: #fff;">
               <!-- mini logo for sidebar mini 50x50 pixels -->
               <!-- <span class="logo-mini"><b>A</b>LT</span>
               logo for regular state and mobile devices
               <span class="logo-lg"><b>Admin</b>LTE</span> -->
               <!-- <span class="logo-lg"> -->
               <img src="img/HWASEUNG.png" width="70" alt="">
               <!-- </span> -->
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" style="background-color: #fff">
               <!-- Sidebar toggle button-->
               
               <div class="text-center">
                  <p style="font-size: 28px;"><b>METAL DETECTOR MONITORING SYSTEM</b></p>
               </div>
               
            </nav>
         </header>
         <!-- =============================================== -->
         <!-- Left side column. contains the sidebar -->
         <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
               <!-- Sidebar user panel -->
               
               <!-- /.search form -->
               <!-- sidebar menu: : style can be found in sidebar.less -->
               <ul class="sidebar-menu" data-widget="tree">
                  <li class="header">MAIN NAVIGATION</li>
                  <li>
                     <a href="index">
                        <i class="fa fa-home"></i> <span>HOME</span>
                     </a>
                  </li>
                  
                  <li class="treeview">
                     <a href="#">
                        <i class="fa fa-table"></i>
                        <span>GEDUNG A</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="a_1-10"><i class="fa fa-circle-o"></i> CELL 1-10</a></li>
                        <li><a href="a_11-18"><i class="fa fa-circle-o"></i> CELL 11-18</a></li>
                     </ul>
                  </li>
				   <li class="treeview">
                     <a href="#">
                        <i class="fa fa-table"></i>
                        <span>GEDUNG B</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="b_1-10"><i class="fa fa-circle-o"></i> CELL 1-8</a></li>
                        <!-- <li><a href="b_1-10"><i class="fa fa-circle-o"></i> CELL Export 1-2</a></li> -->
                     </ul>
                  </li>
                     
				   <li class="treeview">
                     <a href="#">
                        <i class="fa fa-table"></i>
                        <span>GEDUNG C</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="c_1-10"><i class="fa fa-circle-o"></i> CELL 1-10</a></li>
                        <li><a href="c_11-20"><i class="fa fa-circle-o"></i> CELL 11-20</a></li>
                        <li><a href="c_21-30"><i class="fa fa-circle-o"></i> CELL 21-27</a></li>
                     </ul>
                  </li>
				   <li class="treeview">
                     <a href="#">
                        <i class="fa fa-table"></i>
                        <span>GEDUNG D</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="d_1-10"><i class="fa fa-circle-o"></i> CELL 1-10</a></li>
                        <li><a href="d_11-20"><i class="fa fa-circle-o"></i> CELL 11-20</a></li>
                        <li><a href="d_21-30"><i class="fa fa-circle-o"></i> CELL 21-24</a></li>
                        <li><a href="d_51-60"><i class="fa fa-circle-o"></i> CELL 51-60</a></li>
                        <li><a href="d_61-70"><i class="fa fa-circle-o"></i> CELL 61-70</a></li>
                        <li><a href="d_71-78"><i class="fa fa-circle-o"></i> CELL 71-78</a></li>
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                        <i class="fa fa-table"></i>
                        <span>GEDUNG E</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="e_1-10"><i class="fa fa-circle-o"></i> CELL 1-10</a></li>
                        <li><a href="e_11-16"><i class="fa fa-circle-o"></i> CELL 11-16</a></li>
                        <li><a href="e_51-60"><i class="fa fa-circle-o"></i> CELL 51-60</a></li>
                        <!-- <li><a href="d_51-60"><i class="fa fa-circle-o"></i> CELL 51-60</a></li>
                        <li><a href="d_61-70"><i class="fa fa-circle-o"></i> CELL 61-70</a></li>
                        <li><a href="d_71-78"><i class="fa fa-circle-o"></i> CELL 71-78</a></li> -->
                     </ul>
                  </li>
                  <li class="treeview">
                     <a href="#">
                        <i class="fa fa-table"></i>
                        <span>REPORT</span>
                        <span class="pull-right-container">
                           <i class="fa fa-angle-left pull-right"></i>
                        </span>
                     </a>
                     <ul class="treeview-menu">
                        <li><a href="daily_report"><i class="fa fa-circle-o"></i> Daily Report</a></li>
                        <li><a href="calibration_fix"><i class="fa fa-circle-o"></i> Calibration Fix</a></li>
                        <li><a href="monthly_report2"><i class="fa fa-circle-o"></i> Monthly Report</a></li>
                        <li><a href="report-issue"><i class="fa fa-circle-o"></i> Search By Issue</a></li>
                     </ul>
                  </li>
               </ul>
            </section>
            <!-- /.sidebar -->
         </aside>
         <!-- =============================================== -->
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <!-- Main content -->