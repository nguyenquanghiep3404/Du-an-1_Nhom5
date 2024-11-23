<?php include ('./views/admin/layout/header.php'); ?>


<!-- <?php
// $gallery_db = json_decode($one[0]['gallery'], true);
// $gallery = [];
// $html_gallery = '';
// foreach($gallery_db as $img_gallery) {
//     $gallery[] = $img_gallery;
//     $html_gallery .= '<img src="../uploads/'.$img_gallery.'" width="50px" alt="">';
// }
// ?> -->

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
</section>>
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

            <form  method="post"
                style="width:500px; margin:0 auto;" class="mt-3 mb-5" enctype="multipart/form-data">


                <div class="form-group mb-3">
                    <label for="id_category">Tên Danh Mục</label>

                    
                    <div class="form-group mb-3">
                        <label for="name">Tên Sản Phẩm</label>
                        <input type="text" name="name" class="form-control" value="<?= $product->name ?>">
                        <!-- <span class="err" id="nameErr"></span> -->
                    </div>
                <!-- Khu vực nhập ảnh -->
                <div class="form-group mb-3">
                    <label for="image">Hình Ảnh</label>
                    <input type="file" name="file_anh_upload"  class="form-control d-block">

                    <!-- <span class="err" id="imageErr"></span> -->
                </div>
                <div>
                <!-- Hiển thị ảnh -->
                <div>
                    <span>Ảnh hiện tại:</span>
                    <div style="height: 60px; width: 100px">
                        <img style="max-height:100%; max-width:100%;" src="<?= $product->image ?>">
                    </div>
                </div>

                <span>Đường dẫn ảnh:</span>
                <input type="text" name="image" value="<?= $product->image ?>">
                </div>
                <!-- <div class="form-group mb-3">
                    <label for="gallery">Bộ sưu tập</label>
                    <input type="file" name="gallery[]" id="gallery" class="form-control d-block" multiple>
                    <span class="err" id="galleryErr"></span>
                </div> -->

                <div class="form-group mb-3">
                    <label for="info"> Mô Tả</label>
                    <input type="text" name="content" class="form-control" value="<?= $product->content ?>">
                    <!-- <span class="err" id="infoErr"></span> -->
                </div>

                <div class="form-group mb-3">
                    <label for="price">Giá</label>
                    <input type="text" name="price" class="form-control" value="<?= $product->price ?>">
                    <!-- <span class="err" id="priceErr"></span> -->
                </div>

                <!-- <div class="form-group mb-3">
                    <label for="sale">Sale</label>
                    <input type="text" name="sale" id="sale" class="form-control">
                    <span class="err" id="saleErr"></span>
                </div> -->

                <!-- <div class="form-group mb-3">
                    <label for="view">Lượt Xem</label>
                    <input type="text" name="view" id="view" class="form-control">
                    <span class="err" id="viewErr"></span>
                </div> -->
                <!-- <div class="form-group mb-3">
                    <div class="group-checkout">
                        <label for="hot">Hot</label>

                        <select class="form-control" name="hot" id="hot">
                            <option value="0">Bình Thường</option>
                            <option value="1">Sản Phẩm Hot</option>
                        </select>
                        <span class="err" id="hotErr"></span>
                    </div>
                </div> -->
                <!-- <div class="form-group mb-3">
                    <label for="size">Size</label>
                    <input type="text" name="size" id="size" class="form-control">
                    <span class="err" id="sizeErr"></span>
                </div> -->

                <!-- <div class="form-group mb-3">
                    <label for="color">Màu Sắc</label>
                    <input type="text" name="color" id="color" class="form-control">
                    <span class="err" id="colorErr"></span>
                </div> -->

                <!-- <div class="form-group mb-3">
                    <label for="quantity">Số Lượng</label>
                    <input type="text" name="quantity" id="quantity" class="form-control">
                    <span class="err" id="quantityErr"></span>
                </div> -->
                <div class="form-group mb-3">
                    <input type="submit" name="submitForm" value="Chỉnh Sửa Sản Phẩm" class="btn btn-dark px-5">
                </div>
                <!-- Khu vực thông báo lỗi -->
                <div style="color: red;">
                    <?= $thongBaoLoi ?>
                </div>
                <div style="color: red;">
                    <?= $thongBaoLoiUploadFile ?>
                </div>

                <!-- Khu vực thông báo thành công -->
                <div style="color: green;">
                    <?= $thongBaoThanhCong ?>
                </div>
            </form>
        </div>
    </main>




</section>
<?php include ('./views/admin/layout/footer.php'); ?>