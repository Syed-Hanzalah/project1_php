<?php
include_once './dashboard/includes/functions.php';
if (isset($_REQUEST['register'])) {
    $first_name = sanitize($_REQUEST['first_name']);
    $last_name = sanitize($_REQUEST['last_name']);
    $email = sanitize($_REQUEST['email']);
    $phone = sanitize($_REQUEST['phone_number']);
    $password = sanitize($_REQUEST['password']);
    $confirm_password = sanitize($_REQUEST['confirm_password']);
    if ($password === $confirm_password) {
        $info = registerUser($first_name, $last_name, $email, $phone, $password);

    } else {
        $info = array('status' => 'false',
         'message' => 'Passwords do not match');
    }
}
;
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">
<!-- header  -->

<?php include './includes/head.php'; ?>

<body>

    <!-- preloader  -->
    <?php include './includes/preloder.html'; ?>



    <!-- Start Account Register Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="register-form">
                        <div class="title">
                            <h3>No Account? Register</h3>
                            <p>Registration takes less than a minute but gives you full control over your orders.</p>
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
                        </div>
                        <form class="row needs-validation" method="post" novalidate>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-fn">First Name</label>
                                    <input class="form-control" name="first_name" type="text" id="reg-fn" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-ln">Last Name</label>
                                    <input class="form-control" name="last_name" type="text" id="reg-ln" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-email">E-mail Address</label>
                                    <input class="form-control" name="email" type="email" id="reg-email" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-phone">Phone Number</label>
                                    <input class="form-control" name="phone_number" type="text" id="reg-phone" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass">Password</label>
                                    <input class="form-control" name="password" type="password" id="reg-pass" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="reg-pass-confirm">Confirm Password</label>
                                    <input class="form-control" name="confirm_password" type="password"
                                        id="reg-pass-confirm" required>
                                </div>
                            </div>
                            <div class="button">
                                <button class="btn" name="register" type="submit">Register</button>
                            </div>
                            <p class="outer-link">Already have an account? <a href="login.php">Login Now</a>
                            </p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Account Register Area -->


    <!-- ========================= scroll-top ========================= -->
    <a href="login.html#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>
    <?php include './includes/script.php'; ?>

</body>

</html>