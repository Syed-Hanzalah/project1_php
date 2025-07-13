<?php include_once './includes/functions.php';

if (isset($_REQUEST['category_name'])) {
$category_name = $_REQUEST['category_name'];
$info = addCategory($category_name);

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
                    <h2>Add Category</h2>
                    <a href="./categories.php" class="btn btn-primary">Back</a>
                </div>
                <!-- form card  -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <?php
                        if (isset($info)) {
                            if($info['status']){
                                $alertClass='alert-success';
                            }else{
                                $alertClass= 'alert-danger';
                            }
                            echo '<div class="alert '.$alertClass.' p-2" role="alert">'.$info['message'].'</div>';
                        };
                        ?>
                        <form action="add-category.php" method="POST">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category Name</label>
                                <input type="text" class="form-control" id="category" name="category_name" required>
                            </div>
                            <button type="submit" class="btn btn-success ">Add Category</button>
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