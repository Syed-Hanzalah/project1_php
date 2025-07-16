<?php include_once './includes/functions.php';
$categoryDetails = [];

if (isset($_REQUEST['category_name']) && isset($_REQUEST['id'])) {
    $category_name = $_REQUEST['category_name'];
    $id = $_REQUEST['id'];
    $info =  updateCategory($category_name, $id);

}
if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];
    $categoryDetails = getCategoryById($id);
    if (empty($categoryDetails)) {
        header("Location: categories.php");

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
                    <h2>Edit Category</h2>
                    <a href="./categories.php" class="btn btn-primary">Back</a>
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
                        <form action="edit-category.php?id=<?= $id; ?>" method="POST">
                            <div class="mb-3">
                                <label for="category" class="form-label">Category Name</label>
                                <input type="text"
                                    value="<?= !empty($categoryDetails) ? $categoryDetails['category_name'] : '' ?>"
                                    class="form-control" id="category" name="category_name" required>
                            </div>
                            <button type="submit" class="btn btn-success ">Update Category</button>
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