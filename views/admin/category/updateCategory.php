<?php include('./views/admin/layout/header.php'); ?>
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

    </nav>
    <!-- NAVBAR -->

    <h1 class="text-center text-success mb-4">Update Category</h1>
    <form action="?action=updatePost-dm&id=<?= $cateEdit['category_id'] ?>" method="POST" class="bg-light p-4 rounded shadow">
        <div class="mb-3">
            <label for="">ID:</label>
            <input type="text" id="id" disabled>
        </div>
        <div class="mb-3">
            <label for="">Name:</label>
            <input type="text" id="name" name="name" value="<?= $cateEdit['name'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="">Description:</label>
            <input type="text" id="description" name="description" value="<?= $cateEdit['description'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="">Status:</label>
            <input type="text" disabled>
        </div>
        <div  class="d-flex justify-content-center">
            <input type="submit" value="Update" class="btn btn-success w-50">
        </div>
    </form>
    <?php include('./views/admin/layout/footer.php'); ?>