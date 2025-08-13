<?php
include_once './includes/functions.php';
if (!isAdmin()) {
    header("Location: ../index.php");
    exit();}
$categories = getCategories();
if (isset($_REQUEST['id'])) {
    if (isset($_REQUEST['update-product'])) {
        $id = sanitize($_REQUEST['id']);
        $title = sanitize($_REQUEST['title']);
        // Process other form fields similarly
        $category_id = sanitize($_REQUEST['category_id']);
        $description = sanitize($_REQUEST['description']);
        $price = sanitize($_REQUEST['price']);
        $discount = sanitize($_REQUEST['discount']);
        $stock = sanitize($_REQUEST['stock']);
        $info = updateProduct($id, $title, $category_id, $description, $price, $discount, $stock);
    }

    $products = getProductsById($_REQUEST['id']);
    if (empty($products)) {
        header('Location: products.php');
    }

} else {
    header('Location: products.php');
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
                    <h2>Edit Product</h2>
                    <a href="./products.php" class="btn btn-primary">Back</a>
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
                        <div class="container mt-4">
                            <form action="edit-product.php?id=<?= $products['id'] ?>" method="POST" enctype="multipart/form-data">
                                <!-- Category dropdown -->
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php if (!empty($categories)): ?>
                                            <!-- Assuming you have a getCategories() function -->
                                            <?php foreach ($categories as $category):
                                                if ($category['id'] == $products['category_id']) {
                                                    $selected = 'selected';
                                                } else {
                                                    $selected = '';
                                                } ?>

                                                <option value="<?= $category['id'] ?>" <?= $selected; ?>>
                                                    <?= $category['category_name'] ?>
                                                </option>

                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Product Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Product Title</label>
                                    <input type="text" class="form-control" id="title" name="title"
                                        value="<?= $products['title']; ?>" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="3"><?= $products['description']; ?></textarea>
                                </div>

                                <!-- Price -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price (PKR)</label>
                                    <input type="number" step="0.1" class="form-control" id="price" name="price"
                                        value="<?= $products['price']; ?>" required>
                                </div>

                                <!-- Discount -->
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount (%)</label>
                                    <input type="number" step="1" class="form-control" id="discount" name="discount"
                                        value="<?= $products['discount']; ?>">
                                </div>

                                <!-- Stock -->
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock Quantity</label>
                                    <input type="number" class="form-control" id="stock" name="stock"
                                        value="<?= $products['stock']; ?>">
                                </div>

                                <!-- Image -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                    <a href="./<?= $products['image']; ?>" target="_blank" class="d-block mt-3 ">
                                        <img src="./<?= $products['image']; ?>" alt=" <?= $products['title']; ?>"
                                            height="100px" width="100px" class="mt-2 border rounded">
                                    </a>
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn btn-primary" name="update-product">update
                                    Product</button>
                            </form>
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