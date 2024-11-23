<?php include ('./views/admin/layout/header.php'); ?>


<?php
$gallery_db = json_decode($one[0]['product_gallery'], true);
$product_gallery = [];
$html_gallery = '';
foreach($gallery_db as $img_gallery) {
    $product_gallery[] = $img_gallery;
    $html_gallery .= '<img src="./uploads/product_gallery/'.$img_gallery.'" width="50px" alt="">';
}
 ?>

<!-- <section id="sidebar">
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
</section>> -->
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
            <h3 class="text-center"> Chỉnh Sửa Sản Phẩm</h3>

            <form action="index.php?page=product-edit&id=<?= $one[0]['product_id'] ?>" method="post"
                style="width:500px; margin:0 auto;" class="mt-3 mb-5" enctype="multipart/form-data">


                <div class="form-group mb-3">
                    <label for="id_category">Tên Danh Mục</label>

                    <select class="form-control" name="id_category" id="id_category">
                        <?php
                        if(isset($list_category)) {
                            foreach($list_category as $dm) {
                                echo '<option value="'.$dm['id'].'">'.$dm['name'].'</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="name">Tên Sản Phẩm</label>
                    <input type="text" name="name" id="name" class="form-control" value="<?= $one[0]['name'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="img">Hình Ảnh</label>
                    <input type="file" name="image" id="img" class="form-control d-block" value="<?= $one[0]['image'] ?>">
                    <img src="../uploads/<?= $one[0]['image'] ?>" width="50px" alt="">
                    <input type="hidden" name="image" id="img" class="form-control d-block" value="<?= $one[0]['image'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="gallery">Bộ sưu tập</label>
                    <input type="file" name="product_gallery[]" id="gallery" class="form-control d-block" multiple
                        value="<?= $one[0]['product_gallery'] ?>">
                    <?= $html_gallery ?>
                    <input type="hidden" name="product_gallery[]" id="gallery" class="form-control d-block" multiple
                        value="<?= $one[0]['product_gallery'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="info"> Mô Tả</label>
                    <!-- <input type="text" name="info" id="info" class="form-control" value="<?= $one[0]['product_description'] ?>"> -->
                    <textarea name="product_description" id="info" cols="30" rows="10"
                        class="form-control"><?= $one[0]['product_description'] ?></textarea>
                </div>

                <div class=" form-group mb-3">
                    <label for="product_price">Giá</label>
                    <input type="text" name="price" id="price" class="form-control" value="<?= $one[0]['price'] ?>">
                </div>

                <div class="form-group mb-3">
                    <label for="sale">Sale</label>
                    <input type="text" name="product_sale_price" id="sale" class="form-control" value="<?= $one[0]['sale'] ?>">
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
                                        echo '<option value="'.$size['id'].'">'.$size['size'].'</option>';

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
                                    echo '<option value="'.$color['id'].'">'.$color['color'].'</option>';

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
                        <select class="form-select" name="color" id="color">

                            <?php
                            if(isset($variant)) {
                                foreach($variant as $quantity) {
                                    echo '<option value="'.$quantity['id'].'">'.$quantity['quantity'].'</option>';
                                }
                            }
                            ?>
                            </option>
                        </select>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <input type="submit" name="capnhat" value="Chỉnh Sửa Sản Phẩm" class="btn btn-dark px-5">
                </div>
            </form>
        </div>
    </main>
    




</section>
<?php include ('./views/admin/layout/footer.php'); ?>