<?php
include_once './includes/functions.php';
$categories = getCategories();
if (isset($_REQUEST['add-product'])) {
    $title = mysqli_real_escape_string($conn, $_REQUEST['title']);
    // Process other form fields similarly
    $category_id = mysqli_real_escape_string($conn, $_REQUEST['category_id']);
    $description = mysqli_real_escape_string($conn, $_REQUEST['description']);
    $price = mysqli_real_escape_string($conn, $_REQUEST['price']);
    $discount = mysqli_real_escape_string($conn, $_REQUEST['discount']);
    $stock = mysqli_real_escape_string($conn, $_REQUEST['stock']);
    addProduct($title, $category_id, $description, $price, $discount, $stock);

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
                    <h2>Add Product</h2>
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
                            <form action="add-product.php" method="POST" enctype="multipart/form-data">
                                <!-- Category dropdown -->
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-select" id="category_id" name="category_id" required>
                                        <option value="">Select Category</option>
                                        <?php if (!empty($categories)): ?>
                                            <!-- Assuming you have a getCategories() function -->
                                            <?php foreach ($categories as $category): ?>
                                                <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>

                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <!-- Product Title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Product Title</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="3"></textarea>
                                </div>

                                <!-- Price -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price (PKR)</label>
                                    <input type="number" step="0.1" class="form-control" id="price" name="price"
                                        required>
                                </div>

                                <!-- Discount -->
                                <div class="mb-3">
                                    <label for="discount" class="form-label">Discount (%)</label>
                                    <input type="number" step="1" class="form-control" id="discount" name="discount"
                                        value="0.00">
                                </div>

                                <!-- Stock -->
                                <div class="mb-3">
                                    <label for="stock" class="form-label">Stock Quantity</label>
                                    <input type="number" class="form-control" id="stock" name="stock" value="">
                                </div>

                                <!-- Image -->
                                <div class="mb-3">
                                    <label for="image" class="form-label">Product Image</label>
                                    <input class="form-control" type="file" id="image" name="image" accept="image/*">
                                </div>

                                <!-- Submit -->
                                <button type="submit" class="btn btn-primary" name="add-product">Add Product</button>
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