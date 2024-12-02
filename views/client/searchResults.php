
    <style>
        .product-list { display: flex; flex-wrap: wrap; gap: 20px; }
        .product-item { border: 1px solid #ccc; padding: 10px; width: 270px; }
        .product-item h3 { font-size: 18px; margin: 0 0 10px; }
        .product-item p { font-size: 14px; }
    </style>
<?php include ('./views/client/layout/header.php'); ?>
<body>
    <!-- <?php var_dump($keyword) ?> -->
<h2 class="text-center mt-4 mb-3">Kết quả tìm kiếm cho:  <?php echo ($keyword) ?> </h2>
    <?php if (!empty($results)): ?>
        <div class="product-list" style="padding-left:20px">
            <?php foreach ($results as $product): ?>
                <div class="product-item">
                <a href="?action=product-details&product_id=<?php echo $product['product_id']; ?>">
                    <img style="width:250px" src="<?php echo $product['image']; ?>" alt="">
                    </a>
                    <h4 class="product_name mt-3 text-center" ><?php echo $product['name'] ?></h4>
                    <div class="price_box text-center">
                        <span class="current_price"><?php echo number_format($product['price'], 0, ',', '.'); ?>đ</span>
                        <span class="old_price"><?php echo number_format($product['sale_price'], 0, ',', '.'); ?>đ</span>
                    </div>
                    <div class="add_to_cart  text-center">
                        <form action="?action=addToCart" method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $product['product_id'] ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button class="btn btn-primary" href="####" name="add_to_cart" >Mua ngay</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-center text-danger" style="font-size: 18px">Không tìm thấy sản phẩm nào.</p>
    <?php endif; ?>
</body>
</html>
<?php include './views/client/layout/modalPoduct.php' ?>
    <?php include './views/client/layout/miniCart.php' ?>
    <?php include ('./views/client/layout/footer.php'); ?>