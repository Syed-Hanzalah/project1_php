<?php include_once './includes/functions.php';
if (!isAdmin()) {
    header("Location: ../index.php");
    exit();}
$productDetails = [];

// print_r($_REQUEST);
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
if (isset($_REQUEST['confirm']) && $_REQUEST['confirm'] == 1) {
        $info = deleteProduct($id);
        if($info['status']) {
            header("Location: products.php?delete=1");
            die();
        } 
    } 
    
    $productDetails = getProductsById($id);
    if (empty($productDetails)) {
        header("Location: products.php");

    }
}

?>
<html lang="en" data-qb-installed="true">
<!-- head  -->
<?php include_once './includes/head.php'; ?>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- side bar -->
            <?php include_once './includes/sidebar.php'; ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="border-bottom mb-3 d-flex justify-content-between align-items-center gap-3 flex-wrap">
                    <h2>Delete Product</h2>
                    <a href="./products.php" class="btn btn-primary">Back</a>
                </div>
                <!-- form card  -->
                <div class="card shadow-sm">
                    <div class="card-body">
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
                        <form method="POST" action="delete-product.php?id=<?= $id; ?>&confirm=1" >
                            <div class="mb-3">
                                <label for="category" class="form-label fw-bold">Are You Sure to Delete Product.</label>
                                
                            </div>
                            <a href="./products.php" class="btn btn-primary ">Go Back</a> 
                            <button type="submit" class="btn btn-danger ">Delete Product</button>
                        </form>
                    </div>
                </div>

            </main>
        </div>
    </div>


</body>
<!-- scripts -->
<?php include_once './includes/script.php'; ?>

</html>