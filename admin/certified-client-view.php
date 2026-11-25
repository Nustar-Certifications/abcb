<?php
require_once './system/main.php';
//show all data
$q = "SELECT * FROM r_certification";
$allCertified = mysqli_query($con, $q);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Certified Add | ICI-UK</title>

        <?php require_once './parts/head.php'; ?>
        <style>
            .overlay {
                /* Height & width depends on how you want to reveal the overlay (see JS below) */    
                height: 100%;
                width: 100%;
                position: fixed; /* Stay in place */
                z-index: 1; /* Sit on top */
                left: 0;
                top: 0;
                background-color: rgb(0,0,0); /* Black fallback color */
                background-color: rgba(0,0,0, 0.6); /* Black w/opacity */
                overflow-x: hidden; /* Disable horizontal scroll */
                transition: 0.5s; /* 0.5 second transition effect to slide in or slide down the overlay (height or width, depending on reveal) */
            }

        </style>
        <script>
            function toggleBlockStatus(cId) {

                var row = $('#c' + cId);
                console.log(row);

                var action = 'Block';
                confirmDialog({
                    msg: 'Confirm Delete of serial number' + ' <b>' + row.find('td:nth-child(1)').text() + 'and certification number (' + row.find('td:nth-child(2)').text() + ')</b> ?',
                    yesBtnText: 'Sure! Delete It',
                    yesAction: function () {
                        $.post('<?php echo base_url;?>process/certified-client-edit.php',
                                {
                                    method: 'delete', cId: cId
                                },
                                function (json) {
                                    var json=JSON.parse(json);
                                    
                                    if (json.status) {
                                       
                                        $(row).remove();
                                    }
                                    
                                }

                        )
                                .error(function () {
                                    messageDialog({
                                        msg: 'Something went wrong. Please try later',
                                        error: true
                                    })
                                });
                    },
                    noBtnText: 'Nope',
                    dataType: 'json',
                    noAction: function () {},
                    type: action == 'Block' ? 'danger' : 'success'
                });
            }



        </script>




    </head>
    <body class="hold-transition skin-blue admin-modern">
        <div class="wrapper">

            <?php require_once './parts/nav.php'; ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        All Certified Client
                        <small>Control panel</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo base_url; ?>admin/dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li class="active">All Certified Client</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">view Certified client</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Certificate No.</th>
                                                <th>Accredited</th>
                                                <th>Company Name</th>
                                                <th>Address</th>
                                                <th>Scope</th>
                                                <th>Valid Upto</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($array = mysqli_fetch_assoc($allCertified)) {
                                                ?>

                                                <tr id="c<?php echo $array['id']; ?>" data-block="true">
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $array['certificationNumber']; ?></td>
                                                    <td><?php 
                                                    if($array['accredited']==0){
                                                        echo "No";
                                                    }else{
                                                        echo "Yes";
                                                    }
                                                    
                                                    ?></td>
                                                    <td><?php echo $array['companyName']; ?></td>
                                                    <td><?php echo $array['address']; ?></td>
                                                    <td><?php echo $array['scheme']; ?></td>
                                                    <td><?php echo date('d-M-Y',strtotime($array['validTill'])); ?></td>
                                                    <td><button type="button" class="btn btn-xs btn-warning" onclick="editBox(<?php echo $array['id'] ?>)" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button> 
                                                        <button type="button" class="btn btn-xs btn-danger" onclick="toggleBlockStatus(<?php echo $array['id'] ?>)"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                                <!-- /.box-body -->
                                <!-- Modal -->
                                <div id="editBox" class="modal fade" role="dialog">
                                    <div class="modal-dialog">

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title" id='certificationTitle'>Certified Number</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class='overlay'><i class="fa fa-spinner text-center" aria-hidden="true"></i></div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="msg"></div>

                                                        <form id='editCertification' data-toggle="validator" role="form" method='post' action='<?php echo base_url; ?>process/editCertification.php'>
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
                                                                    <textarea class="form-control" rows="3" name='address' id='address' placeholder="Address"></textarea>
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
                                                                        <input type="text" name='validTill' id='validTill' class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                                                                    </div>
                                                                    <!-- /.input group -->
                                                                </div>
                                                                <!-- /.form group -->
                                                                <div class="checkbox">
                                                                  <label><input type="checkbox" id="accredited" name="accredited" value="1">Accredited</label>
                                                                </div>

                                                                <input type='hidden' name='id' id='editId' value="">

                                                            </div>
                                                            <div class="box-footer">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
                                                        <!-- /.box-body -->


                                                    </div>
                                                </div>
                                                <!-- /.row -->

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->
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


        <!-- DataTables -->
        <script src="<?php echo base_url; ?>assets/admin/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url; ?>assets/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>


        <!-- page script -->
        <script>
                                                            $(function () {
                                                                $("#example1").DataTable();

                                                            });
        </script>
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

                                                            //update certifciation
                                                            $('#editCertification').submit(function (event) {

                                                                event.preventDefault();
                                                                var data = $('#editCertification').serializeArray();
                                                                data.push({"name": "method", "value": "update"});
                                                                $.ajax({
                                                                    url: '<?php echo base_url; ?>process/certified-client-edit.php',
                                                                    type: 'POST',
                                                                    dataType: 'json',
                                                                    data: data,
                                                                    beforeSend: function () {
                                                                        $('.overlay').removeClass('hidden');
                                                                    },
                                                                    success: function (resp) {
                                                                        $('.overlay').addClass('hidden');
                                                                        if (resp.status) {
                                                                            $('.msg').html('<div class="alert alert-success"><strong>Contrats! </strong>' + resp.message + '</div>');
                                                                            
                                                                                window.location.reload();
                                                                            
                                                                        } else {
                                                                            $('.msg').html('<div class="alert alert-danger"><strong>OOPS! </strong>' + resp.message + '</div>');
                                                                        }

                                                                    }
                                                                });
                                                            });

        </script>

    </body>
</html>
