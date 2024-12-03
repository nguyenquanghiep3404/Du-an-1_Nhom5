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

            <!-- <a href="index.php?act=home-dm"> -->
            <a href="index.php?action=home-dm">

                <i class='bx bxs-category-alt'></i>
                <span class="text">Danh Mục</span>
            </a>
        </li>
        <li>
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
            <a href="index.php?action=respon">
                <i class='bx bxs-chat'></i>
                <span class="text">Phản Hồi</span>
            </a>
        </li>
        <li>
            <a href="index.php?action=all_register">
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
            <a href="?action=logout" class="logout">
                <i class='bx bxs-log-out-circle'></i>
                <span class="text">Đăng Xuất</span>
            </a>
        </li>
    </ul>
</section>

<!-- CONTENT -->
<section id="content">
    <!-- NAVBAR -->
    <nav>
        <i class='bx bx-menu'></i>

        <a href="#index.php?action=category" class="nav-link">Danh Mục Sản Phẩm</a>

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
        
    </nav>
    <!-- NAVBAR -->
<h1 class="text-center text-primary mb-4">Danh sách đơn hàng</h1>

<table class="table table-hover table-bordered text-center align-middle">
    <thead class="table-dark">
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Email</th>
            <th>Điện thoại</th>
            <th>Địa chỉ</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <!-- <input type="hidden" name="order_detail_id" value="<?= $order['order_detail_id'] ?>"> -->
        
            <tr>
                <form action="?action=updateOrderPost&id=<?= $orderEdit['order_detail_id'] ?>" method="POST">
                    <td><?= $orderEdit['order_detail_id'] ?></td>
                    <td><?= $orderEdit['name'] ?></td>
                    <td><?= $orderEdit['email'] ?></td>
                    <td><?= $orderEdit['phone'] ?></td>
                    <td><?= $orderEdit['address'] ?></td>
                    <td>
                        <select name="status" id="status" class="form-select">
                            <option value="0" <?= $orderEdit['status'] == 0 ? 'selected' : '' ?>>Chờ xác nhận</option>
                            <option value="1" <?= $orderEdit['status'] == 1 ? 'selected' : '' ?>>Đã xác nhận</option>
                            <option value="2" <?= $orderEdit['status'] == 2 ? 'selected' : '' ?>>Đang vận chuyển</option>
                            <option value="3" <?= $orderEdit['status'] == 3 ? 'selected' : '' ?>>Hoàn thành</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-success btn-sm">Cập nhật</button>
                    </td>
                </form>
            </tr>
    </tbody>
</table>
<?php include ('./views/admin/layout/footer.php'); ?>