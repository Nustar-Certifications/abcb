<?php 
require_once './system/main.php';
$countQ="SELECT * FROM r_certification";
$r = mysqli_query($con, $countQ);
$total = mysqli_num_rows($r);
?>
<!DOCTYPE html>
<html>
<head>
    <title>AB-CB | Dashboard</title>

  <?php    require_once './parts/head.php';?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<?php    require_once './parts/nav.php';?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $total; ?></h3>

              <p>Certified Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="<?php echo base_url;?>admin/certified-client-view.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        
        <!-- ./col -->
      </div>
      <!-- /.row -->
      

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php  require_once './parts/footer.php'; ?>

</div>
<!-- ./wrapper -->
<?php require_once './parts/footer_script.php'; ?>
</body>
</html>
