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
            <a href="?action=showComment">
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
    <h1 class="text-center text-primary mb-4">Quản Lý Bình luận</h1>
<table class="table table-hover table-bordered text-center align-middle">
    <thead class="table-dark">
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Email</td>
            <td>Create_at</td>
            <td>Comment</td>
            <td>Operation</td>

        </tr>
    </thead>
    <tbody>
        <?php foreach($showComment as $item) {?>
        <tr>

            <td><?= $item['comment_id'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['email'] ?></td>
            <td><?= $item['create_at'] ?></td>
            <td><?= $item['comment'] ?></td>
            <td>
               <a href="?action=delete_comment&id=<?= $item['comment_id'] ?>" onclick="return confirm('Ban có muốn xoá không?')"><input type="button" value="Xoá"></a>
            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
<?php include ('./views/admin/layout/footer.php'); ?>