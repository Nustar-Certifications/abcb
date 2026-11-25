<?php
require_once './system/main.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Certified Add | ICI-UK</title>

        <?php require_once './parts/head.php'; ?>
    </head>
    <body class="hold-transition skin-blue admin-modern">
        <div class="wrapper">

            <?php require_once './parts/nav.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Add New Certification
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">Add New Certification</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="box box-danger">
                                <div class="box-header">
                                    <h3 class="box-title msg">Add new certification</h3>
                                </div>
                                <form id='addCertification' data-toggle="validator" role="form" method='post' action='<?php echo base_url;?>process/addCertification.php'>
                                    <div class="box-body">
                                        <div class="form-group">
                                            <label for="certificationNumber">Certification Number</label>
                                            <input type="text" class="form-control" name='certificationNumber' id="certificationNumber" placeholder="Enter Certification Number" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="companyName">Company name</label>
                                            <input type="text" class="form-control" id="companyName" name='companyName' placeholder="Enter Company Name" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea class="form-control" rows="3" name='address' placeholder="Address"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="scheme">Scheme</label>
                                            <input type="text" class="form-control" id="scheme" name='scheme' placeholder="scheme">
                                        </div>
                                        <!-- Date dd/mm/yyyy -->
                                        <div class="form-group">
                                            <label>Valid upto:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" name='validTill' class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                        <div class="checkbox">
                                          <label><input type="checkbox" name="accredited" value="1">Accredited</label>
                                        </div>
                                       
                                    </div>
                                    <div class="box-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->


                        </div>
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php require_once './parts/footer.php'; ?>

        </div>
        <!-- ./wrapper -->
        <?php require_once './parts/footer_script.php'; ?>

        <!-- InputMask -->
        <script src="<?php echo base_url; ?>assets/admin/plugins/input-mask/jquery.inputmask.js"></script>
        <script src="<?php echo base_url; ?>assets/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
        <script src="<?php echo base_url; ?>assets/admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
        <!-- Page script -->
        <script>
            $(function () {

                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();




            });
        </script>



    </body>
</html>
