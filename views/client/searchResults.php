
    <style>
        .product-list { display: flex; flex-wrap: wrap; gap: 20px; }
        .product-item { border: 1px solid #ccc; padding: 10px; width: calc(33.33% - 20px); }
        .product-item h3 { font-size: 18px; margin: 0 0 10px; }
        .product-item p { font-size: 14px; }
    </style>
<?php include ('./views/client/layout/header.php'); ?>
<body>
    <h1>Kết quả tìm kiếm</h1>
    <?php if (!empty($results)): ?>
        <div class="product-list">
            <?php foreach ($results as $product): ?>
                <div class="product-item">
                    <h3><?php echo $product['name'] ?></h3>
                    <img src="<?php echo $product['image']; ?>" alt="">
                    <p>Giá: <?php echo number_format($product['price'], 0, ',', '.'); ?> VND</p>
                    <p><?php echo $product['description']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Không tìm thấy sản phẩm nào.</p>
    <?php endif; ?>
</body>
</html>
<?php include './views/client/layout/modalPoduct.php' ?>
    <?php include './views/client/layout/miniCart.php' ?>
    <?php include ('./views/client/layout/footer.php'); ?>