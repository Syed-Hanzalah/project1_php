<?php
include_once './includes/functions.php';
if (!isAdmin()) {
    header("Location: ../index.php");
    exit();}
$products = getProducts();
if (isset($_REQUEST['delete']) && $_REQUEST['delete'] == 1) {
    $info = array(
        'status' => true,
        'message' => 'Product deleted successfully'
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
                    <h2>Products</h2>
                    <a href="./add-product.php" class="btn btn-primary">Add Product</a>
                </div>
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hovered products-table">
                                <thead class="table-dark ">
                                    <tr>
                                        <th>Category Id</th>
                                        <th>Product</th>
                                        <th>Category </th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if(!empty($products)):
                                        foreach ($products as $product): ?>
                                            <tr>
                                                <td><?= $product['id']; ?></td>
                                                <td><img src="./<?= $product['image']; ?> " height="60px" width="60px" class="border rounded me-2" alt=" <?= $product['title']; ?>"> <?= $product['title']; ?></td>
                                                <td><?= $product['category_name']; ?></td>
                                                <td><?= number_format($product['price'],1,'.',',') ; ?></td>
                                                <td><?= number_format($product['stock'],2,'.',','); ?></td>
                                                <td><?= date('d M, Y h:i a',strtotime($product['created_at']) ) ; ?></td>
                                                <td><?= date('d M, Y h:i a',strtotime($product['updated_at']) ); ?></td>
                                                <td>
                                                    <a href="edit-product.php?id=<?= $product['id'];?>" class="btn btn-sm btn-warning">Edit</a>
                                                    <a href="delete-product.php?id=<?= $product['id'];?>" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; 
                                   endif ;?>
                                      

                                </tbody>
                            </table>
                        </div>
                      <!-- table end  -->
                    </div>
                </div>
            </main>
        </div>
    </div>


</body>
<!-- scripts -->
<?php include_once './includes/script.php'; ?>

</html>