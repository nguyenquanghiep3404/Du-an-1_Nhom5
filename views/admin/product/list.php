<?php include ('./views/admin/layout/header.php'); ?>

<!-- SIDEBAR -->
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
            <a href="index.php?page=category">
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
            <a href="?action=listOrders">
                <i class='bx bxs-calendar-check'></i>
                <span class="text">Đơn Hàng</span>
            </a>
        </li>
        <li>
            <a href="?action=showComment">
                <i class='bx bxs-chat'></i>
                <span class="text">Phản Hồi</span>
            </a>
        </li>
        <li>
            <a href="index.php?page=user">
                <i class='bx bxs-group'></i>
                <span class="text">Tài Khoản</span>
            </a>
        </li>
        <li>
            <a href="index.php?page=voucher">
                <i class='bx bxs-offer'></i>
                <span class="text">Mã Giảm Giá</span>
            </a>
        </li>
        <li>
            <a href="index.php?page=voucher">
                <i class='bx bxs-slideshow'></i>
                <span class="text">Slider Shows</span>
            </a>
        </li>
        <li>
            <a href="index.php?page=voucher">
                <i class='bx bxs-analyse'></i>
                <span class="text">Thống Kê</span>
            </a>
        </li>
    </ul>
    <ul class="side-menu">
        <li>
            <a href="index.php?page=logout" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Đăng Xuất</span>
            </a>
        </li>
    </ul>
</section>
<!-- NAVBAR -->
<section id="content">
    <nav>
        <i class='bx bx-menu'></i>
        <a href="#index.php?page=home" class="nav-link">Trang Chủ</a>
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
            <!-- <img src="../uploads/<?= $_SESSION['admin']['avatar'] ?>"> -->
        </a>
    </nav>
    <main>
    <h3 class="text-center">Quản Lý Sản Phẩm</h3>
    <a href="index.php?action=product-create">Thêm sản phẩm mới</a>
    <table class="table table-show-category">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên</th>
                <th>Hình Ảnh</th>
                <th>Giá</th>
                <th>Danh mục</th>
                <th>Ngày Nhập</th>
                <th>Ngày chỉnh sửa</th>
                <!-- <th>Trạng thái</th> -->
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            foreach ($danhSachProduct as $key => $product) : ?>
                <tr>
                    <!-- <?php var_dump($product) ?> -->
                    <td> <?= $key +1 ?> </td>
                    <td> <?= $product['name'] ?></td>
                    <td>
                        <div style="height: 60px; width: 60px">
                            <img style="max-height:100%; max-width:100%;" src="<?=  $product['image'] ?>">
                        </div>
                    </td>
                    <td> <?= $product['price'] ?> </td>
                    <td><?= $product['category_name'] ?></td>
                    <td><?=  $product['created_at'] ?></td>
                    <td>
                    <?=  $product['updated_at'] ?>
                    </td>
                    <!-- <td><?=  $product['status'] ==1 ? 'Còn bán' : 'Dừng bán'  ?> </td> -->
                        <!-- <a href="?action=product-edit&id=<?= $product->product_id ?>">Sửa</a>
                        <a href="?action=product-delete&id=<?= $product->product_id ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a> -->

                        <td>
                            <!-- <a href="<?= '?action=product-details&product_id='.$product['product_id'] ?>">
                            <button class="btn btn-primary"><i class="far fa-eye"></i></button>
                            </a> -->
                            <a href="<?= '?action=product-form-edit&id='.$product['product_id'] ?>"><i class="bx bx-edit"></i></a>
                            <!-- <a href="<?= '?action=delete-product&id=' . $product['product_id'] ?>" 
                                onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                <i class="bx bx-trash"></i>
                            </a> -->
                        </td>
                </tr>
                <?php endforeach ?>
        </tbody>
    </table >

<?php include ('./views/admin/layout/footer.php'); ?>