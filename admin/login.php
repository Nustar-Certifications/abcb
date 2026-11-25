<?php
require_once './system/main.php';
require_once './system/auth.php';

if (adminHasValidSession($con)) {
    header('Location:' . base_url . 'admin/dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Control login</title>
        <?php include './parts/head.php'; ?>
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href=""><b>AB</b>CB</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <p class="login-box-msg msg">Sign in to start your session</p>

                <form action="<?php echo base_url.'process/login.php';?>" method="post" id='login' data-toggle="validator" role="form">
                    <div class="form-group">
                        
                        <input type="email" name="username" class="form-control" id="username" placeholder="Please enter your email id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        
                        <input type="password" name="password" class="form-control" id="password" placeholder="Please enter your password" data-error="Enter your password" required>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="row">

                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <!-- /.social-auth-links -->

            </div>
            <!-- /.login-box-body -->

        </div>
        <?php require_once './parts/footer_script.php'; ?>    
        <!-- /.login-box -->
    </body>
</html>
