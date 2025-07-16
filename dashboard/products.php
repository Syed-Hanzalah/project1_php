<?php
include_once './includes/functions.php';
$info = getProducts();
$products = $info['status'] ? $info['data'] : [];

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
                        <?php


                        ?>
                        <div class="row justify-content-around">
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-4 col-sm-6 mb-4 border-rounded">
                                    <div class="card h-100 shadow-sm overflow-hidden">
                                        <img src="<?= htmlspecialchars($product['image']) ?>" class="card-img-top"
                                            alt="<?= htmlspecialchars($product['title']) ?>"
                                            style="height: 250px; object-fit: cover;">

                                        <div class="card-body d-flex flex-column " style="background-color: #c2c2c2ff;">
                                            <h5 class="card-title"><?= htmlspecialchars($product['title']) ?></h5>

                                            <p class="card-text text-muted" style="font-size: 14px;">
                                                <?= strlen($product['description']) > 80
                                                    ? htmlspecialchars(substr($product['description'], 0, 80)) . '...'
                                                    : htmlspecialchars($product['description']) ?>
                                            </p>



                                            <div class="mb-2">
                                                <strong class="text-dark" style="font-size: 18px;">
                                                    $<?= number_format($product['price'], 2) ?>
                                                </strong>
                                            </div>

                                            <div class="text-muted mb-2" style="font-size: 14px;">
                                                Stock:
                                                <?= $product['stock'] > 0 ? $product['stock'] : '<span class="text-danger">Out of stock</span>' ?>
                                            </div>
                                            <?php if ($product['discount'] > 0): ?>
                                                <span class="badge bg-danger mb-2">-<?= $product['discount'] ?>% Off</span>
                                            <?php endif; ?>
                                            <div class="mt-auto d-flex gap-2">
                                                <!-- Edit Product -->
                                                <a href="edit-product.php?id=<?= $product['id'] ?>"
                                                    class="btn btn-sm btn-primary w-100">
                                                    Edit
                                                </a>

                                                <!-- Delete Product -->
                                                <a href="delete-product.php?id=<?= $product['id'] ?>"
                                                    class="btn btn-sm btn-danger w-100"
                                                    onclick="return confirm('Are you sure you want to delete this product?');">
                                                    Delete
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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