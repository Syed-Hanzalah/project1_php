<?php
include_once './includes/functions.php';
if (!isAdmin()) {
    header("Location: ../index.php");
    exit();}
$categories=getCategories();
if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == 1) {
    $info = array(
        'status' => true,
        'message' => 'Category deleted successfully'
    );
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
                    <h2>Categories</h2>
                    <a href="./add-category.php" class="btn btn-primary">Add Category</a>
                </div>
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
                        <div class="table-responsive">
                            <table class="table table-hovered">
                                <thead class="table-dark ">
                                    <tr>
                                        <th>Category Id</th>
                                        <th>Category Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($categories as  $category): ?>
                                    <tr>
                                        <td><?= $category['id']; ?></td>
                                        <td><?= $category['category_name']; ?></td>
                                        <td>
                                            <a href="edit-category.php?id=<?= $category['id'];?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="delete-category.php?id=<?= $category['id'];?>" class="btn btn-sm btn-danger
                                            ">Delete</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


</body>
<!-- scripts -->
<?php include_once './includes/script.php'; ?>

</html>