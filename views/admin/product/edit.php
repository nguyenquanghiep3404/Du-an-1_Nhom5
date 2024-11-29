<?php include ('./views/admin/layout/header.php'); ?>
<!-- 
<section id="sidebar">
    <a href="index.php" class="brand">
        <img src="../uploads/logo_owenstore.svg" alt="">
    </a>
    <ul class="side-menu top">
        <li>
            <a href="index.php?action=admin">
                <i class='bx bxs-home'></i>
                <span class="text">Trang Chủ</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=category">
                <i class='bx bxs-category-alt'></i>
                <span class="text">Danh Mục</span>
            </a>
        </li>
        <li class="active">
            <a href="index.php?action=product">
                <i class='bx bxs-window-alt'></i>
                <span class="text">Sản Phẩm</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=bill">
                <i class='bx bxs-calendar-check'></i>
                <span class="text">Đơn Hàng</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=respon">
                <i class='bx bxs-chat'></i>
                <span class="text">Phản Hồi</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=user">
                <i class='bx bxs-group'></i>
                <span class="text">Tài Khoản</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=voucher">
                <i class='bx bxs-offer'></i>
                <span class="text">Mã Giảm Giá</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=voucher">
                <i class='bx bxs-slideshow'></i>
                <span class="text">Slider Shows</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=arrange">
                <i class='bx bxs-analyse'></i>
                <span class="text">Thống Kê</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="index.php?action=logout" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Đăng Xuất</span>
            </a>
        </li>
    </ul>
</section> -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#index.php?action=home" class="nav-link">Trang Chủ</a>
        <form action="#">
            <div class="form-input">
                <input type="search" placeholder="Tìm Kiếm...">
                <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
        </form>
        <input type="checkbox" id="switch-mode" hidden>
        <label for="switch-mode" class="switch-mode"></label>
        <a href="#" class="notification">
            <i class='bx bxs-bell'></i>
            <span class="num">8</span>
        </a>
        <a href="#" class="profile">
            
        </a>
    </nav>
    <main class="my-5">
        <div class="container">
            <h3 class="text-center"> Chỉnh Sửa Sản Phẩm: <?= $one[0]['name'] ?></h3>

            <form action="?action=product-form-edit&id=<?= $one[0]['product_id'] ?>" method="post" enctype="multipart/form-data" style="width:1000px; margin:0 auto;" class="mt-3 mb-5">

    <div class="form-group mb-3">
        <label for="id_category">Tên Danh Mục</label>
        <!-- <select class="form-control" name="category_id" id="category_id">
            <?php foreach ($listCategories as $cate): ?> 
                <option <?= $cate['category_id'] == $one['category_id'] ? 'selected' : '' ?> value="<?= $cate['category_id'] ?>">
                    <?= $cate['name'] ?>
                </option>
            <?php endforeach; ?>
        </select> -->
        <select class="form-control" name="category_id" id="category_id">
            <?php
                if(isset($listCategories)) {
                    foreach($listCategories as $cate) {
                        echo '<option value="'.$cate['category_id'].'">'.$cate['name'].'</option>';
                }
                }
                ?>
        </select>
    </div>

    <div class="form-group mb-3">
        <label for="name">Tên Sản Phẩm</label>
        <input type="text" name="name" id="name" class="form-control" value="<?= $one[0]['name']?>">
    </div>

    <div class="form-group mb-3">
        <label for="img">Hình Ảnh Hiện Tại</label>
        <img src="<?= $one[0]['image'] ?>" alt="" class="img-thumbnail d-block mb-2" width="150" >
        <input type="file" name="image" id="image" class="form-control">
        
    </div>

    <div class="form-group mb-3">
        <label for="gallery">Gallery Hiện Tại</label>
        <div class="d-flex flex-wrap gap-2">
        <?php
        $gallery_images = json_decode($one[0]['gallery'], true); // Giải mã JSON thành mảng
        if (!empty($gallery_images)) {
            foreach ($gallery_images as $gallery_image) {
                echo '<img src="' . $gallery_image . '" alt="Ảnh gallery" class="img-thumbnail mb-2" width="100">';
            }
        } else {
            echo '<p>Không có ảnh trong gallery.</p>';
        }
        ?>
        </div>
        <input type="file" name="product_gallery[]" id="gallery" class="form-control" multiple>
    </div>

    <div class="form-group mb-3">
        <label for="product_description">Mô tả sản phẩm</label>
        <textarea id="product_description" name="product_description" class="form-control" rows="4"><?= $one[0]['description'] ?></textarea>
    </div>

    <div class="form-group mb-3">
        <label for="product_price">Giá</label>
        <input type="text" name="product_price" id="product_price" class="form-control" value="<?= $one[0]['price'] ?>">
    </div>

    <div class="form-group mb-3">
        <label for="product_sale_price">Sale</label>
        <input type="text" name="product_sale_price" id="product_sale_price" class="form-control" value="<?= $one[0]['sale_price'] ?>">
    </div>

    <div class="form-group mb-3">
            <div class="group-checkout">
                        <label for="size">
                            Size
                            <span>*</span>
                        </label>
                        <select class="form-select" name="size" id="size">
                            <option selected disabled hidden>
                                <?php
                                if(isset($variant)) {
                                    foreach($variant as $size) {
                                        echo '<option value="'.$size['product_variant_id'].'">'.$size['size'].'</option>';

                                    }
                                }
                                ?>
                            </option>
                        </select>
            </div>

            <div class="group-checkout">
                        <label for="size">
                            Màu
                            <span>*</span>
                        </label>
                        <select class="form-select" name="color" id="color">

                            <?php
                            if(isset($variant)) {
                                foreach($variant as $color) {
                                    echo '<option value="'.$color['product_id'].'">'.$color['color'].'</option>';

                                }
                            }
                            ?>
                            </option>
                        </select>
            </div>        

            <div class="group-checkout">
                    <label for="size">
                        Số Lượng
                        <span>*</span>
                    </label>    
                    <select class="form-select" name="quantity" id="quantity">
                        <?php
                            if(isset($variant)) {
                                foreach($variant as $quantity) {
                                    echo '<option value="'.$quantity['product_id'].'">'.$quantity['quantity'].'</option>';
                                }
                            }
                        ?>
                        </option>
                    </select>
            </div>        
        </div>

    <div class="form-group mb-3">
        <button type="submit" name="capnhat" class="btn btn-dark px-5">Sửa thông tin</button>
    </div>
</form>
        </div>
    </main>
    




</section>
<?php include ('./views/admin/layout/footer.php'); ?>