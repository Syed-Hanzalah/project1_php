<?php
include_once './dashboard/includes/functions.php';
if (isset($_REQUEST['id'])) {
    $categorydetails = getCategoryById($_REQUEST['id']);
    $products = getproductsbycategory($_REQUEST['id']);
    if (empty($categorydetails)) {
        header("Location: index.php");
        exit();
    }
}else {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<?php include './includes/head.php'; ?>

<body>
    <!-- preloder  -->
    <?php include './includes/preloder.html'; ?>
    <!-- navbar  -->
    <?php include './includes/navbar.php'; ?>




    <!-- Start Trending Product Area -->
    <section class="trending-product section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2><?=$categorydetails['category_name']; ?></h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have
                            suffered alteration in some form.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Start Single Product -->
                <?php
                
                if (!empty($products)) {

                    foreach ($products as $product):
                    include'./includes/product-card.php';
                    endforeach;
                } else {
                    echo '<li class="alert alert-danger"><a href="#">No products Found</a></li>';
                } ?>


            </div>
        </div>
    </section>
    <!-- End Trending Product Area -->

    <!-- Start Banner Area -->
   
    <!-- End Banner Area -->

    <!-- footer   -->
    <?php include './includes/footer.php'; ?>

    <!-- ========================= scroll-top ========================= -->
    <a href="index.php#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>
    
    <?php include './includes/script.php'; ?>
</body>

</html>