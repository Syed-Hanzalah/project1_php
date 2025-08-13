
<?php
$path = $_SERVER['PHP_SELF'];
$fileName = basename($path);
?>
<div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark  col-lg-2 col-md-3 position-fixed" style=" height:100vh;">
        <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none"> <svg
                class="bi pe-none me-2" width="40" height="32" aria-hidden="true">

            </svg> <span class="fs-4">HB Garments</span> </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            
            <li> <a href="./index.php" class="nav-link text-white <?= $active = $fileName == "index.php" ? "active" : ""; ?>" > 
                <i class="fa fa-dashboard me-2"></i>
                    Dashboard
                </a> </li>
            <li> <a href="orders.php" class="nav-link text-white <?= $active = $fileName == "orders.php" ? "active" : ""; ?>"> 
                <i class="fa fa-shopping-cart me-2"></i>
                    Orders
                </a> </li>
                <li> <a href="./categories.php" class="nav-link text-white <?= $active = $fileName == "categories.php" ? "active" : ($fileName == "add-category.php" ? "active" :(($fileName == "edit-category.php" ? "active" :( ($fileName == "delete-category.php" ? "active" :""))))); ?>"> 
                <i class="fa fa-layer-group me-2"></i>
                    Categories
                </a> </li>
            <li> <a href="products.php" class="nav-link text-white <?= $active = $fileName == "products.php" ? "active" : ($fileName == "add-product.php" ? "active" :(($fileName == "edit-product.php" ? "active" :( ($fileName == "delete-product.php" ? "active" :""))))); ?>">
                 <i class="fa fa-list me-2"></i>
                    Products
                </a> </li>
            <li> <a href="#" class="nav-link text-white <?= $active = $fileName == "customers.php" ? "active" : ""; ?>"> 
                <i class="fa fa-users me-2"></i>
                    Customers
                </a> </li>
        </ul>
        <hr>
        <div class="dropdown"> <a href="#"
                class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                data-bs-toggle="dropdown" aria-expanded="false"> <img src="https://github.com/mdo.png" alt="" width="32"
                    height="32" class="rounded-circle me-2"> <strong>mdo</strong> </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="./logout.php">Sign out</a></li>
            </ul>
        </div>
    </div>