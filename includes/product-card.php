<div class="col-lg-3 col-md-6 col-12">
    <!-- Start Single Product -->
    <div class="single-product">
        <div class="product-image">
            <img src="./dashboard/<?= $product['image']; ?>" alt="<?= $product['title']; ?>">
            <?php
            if ($product['discount'] > 0) {
                echo '<span class="sale-tag">-' . $product['discount'] . '%</span>';
            }
            if (time() - strtotime($product['created_at']) <= 2 * 24 * 60 * 60) {
                echo '<span class="new-tag">New</span>';
            }
            ?>
            <div class="button">
                <a href="product-details.html" class="btn"><i class="lni lni-cart"></i> Add to Cart</a>
            </div>
        </div>
        <div class="product-info">
            <span class="category"><?= $product['category_name']; ?></span>
            <h4 class="title">
                <a href="product-grids.html"><?= $product['title']; ?></a>
            </h4>
            <!-- <ul class="review">
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><i class="lni lni-star-filled"></i></li>
                                <li><span>5.0 Review(s)</span></li>
                            </ul> -->
            <div class="price">
                <span><?= $product['price']; ?></span>
                <span class="discount-price">$300.00</span>
            </div>
        </div>
    </div>
</div>
