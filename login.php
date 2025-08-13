<?php
include_once './dashboard/includes/functions.php';
if (isset($_REQUEST['login'])) {
    $email = sanitize($_REQUEST['email']);
    $password = sanitize($_REQUEST['password']);
    $info = loginUser($email, $password);
   
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<?php include './includes/head.php'; ?>

<body>
   

   <?php include './includes/preloder.html'; ?>
   

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login-form" method="post">
                        <div class="card-body">
                            <div class="title">
                                <h3>Login Now</h3>
                                <p>You can login using your social media account or email address.</p>
                            </div>
                            
                            <?php
                        if (isset($info)) {
                            if ($info['status']) {
                                $alertClass = 'alert-success';
                            } else {
                                $alertClass = 'alert-danger';
                            }
                            echo '<div class="alert ' . $alertClass . ' p-2" role="alert">' . $info['message'] . '</div>';
                        }
                        ;
                        ?>
                            <div class="form-group input-group">
                                <label for="reg-fn">Email</label>
                                <input class="form-control" name="email" type="email" id="reg-email" required>
                            </div>
                            <div class="form-group input-group">
                                <label for="reg-fn">Password</label>
                                <input class="form-control" name="password" type="password" id="reg-pass" required>
                            </div>
                            <div class="d-flex flex-wrap justify-content-between bottom-content">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input width-auto" id="exampleCheck1">
                                    <label class="form-check-label">Remember me</label>
                                </div>
                                <a class="lost-pass" href="https://demo.graygrids.com/themes/shopgrids/account-password-recovery.html">Forgot password?</a>
                            </div>
                            <div class="button">
                                <button class="btn" name="login" type="submit">Login</button>
                            </div>
                            <p class="outer-link">Don't have an account? <a href="register.php">Register here </a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Login Area -->


    <!-- ========================= scroll-top ========================= -->
    <a href="login.html#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>
<?php include './includes/script.php'; ?>
  
</body>

</html>