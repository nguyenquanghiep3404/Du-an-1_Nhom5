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
        <a href="#" class="profile">

            <img src="../uploads/<?= $_SESSION['admin']['avatar'] ?>">
        </a>
    </nav>
    <!-- NAVBAR -->
    
<a href="?action=create-dm"><input type="button" value="Nhập thêm" class="input mt-5 input-group bg-primary text-white"></a>
<table class="table table-striped">

    <thead>
        <tr>
            <td>ID</td>
            <td>Name</td>
            <td>Description</td>
            <td>Status</td>

            <td>Operation</td>

        </tr>
    </thead>
    <tbody>
        <?php foreach($cate as $cates) {?>
        <tr>

            <td><?= $cates['category_id'] ?></td>
            <td><?= $cates['name'] ?></td>
            <td><?= $cates['description'] ?></td>
            <td><?= $cates['status'] ?></td>
            <td>

              
               <!-- <a href="?act=delete-dm&id=<?= $cates['category_id'] ?>" onclick="return confirm('Ban có muốn xoá không?')"><input type="button" value="Xoá"></a> -->
               <a href="?action=update-dm&id=<?= $cates['category_id'] ?>" ><input type="button" class="" value="Sửa"></a>
               <a href="?action=hide-dm&id=<?= $cates['category_id'] ?>" onclick="return confirm('Ban có muốn xoá không?')"><input type="button" value="Xoá"></a>
               <a href="?action=show-dm&id=<?= $cates['category_id'] ?>" onclick="return confirm('Ban có muốn bỏ xoá không?')"><input type="button" value="Bỏ xoá"></a>

            </td>
        </tr>
        <?php }?>
    </tbody>
</table>
<?php include ('./views/admin/layout/footer.php'); ?>