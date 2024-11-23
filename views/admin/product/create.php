<style>
#file-info {
    display: none;
}

input {
    display: none;
}
</style>

<?php include ('./views/admin/layout/header.php'); ?>
<section id="sidebar">
    <a href="index.php" class="brand">
        <img src="../uploads/logo_owenstore.svg" alt="">
    </a>
    <ul class="side-menu top">
        <li>
            <a href="index.php?action=home">
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
</section>

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
            <!-- <img src="../uploads/<?= $_SESSION['admin']['avatar'] ?>"> -->
        </a>
    </nav>

    <main class="my-5">
        <div class="container">
            <h3 class="text-center">Thêm Sản Phẩm</h3>
            <form  method="post" style="width:500px; margin:0 auto;"
                class="mt-3 mb-5" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class=" form-group mb-3">
                    <label for="id_category">Tên Danh Mục</label>
                        <select class="form-control" name="category_id" id="id_category">
                            <?php foreach ($listCategories as $cate): ?> 
                                <option value="">Chọn Danh Mục</option>
                                <option value="<?= $cate['category_id'] ?>"><?= $cate['name'] ?></option>
                            <?php endforeach; ?>   
                        </select>
                    <span class="err" id="categoryErr"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="name">Tên Sản Phẩm</label>
                    <input type="text" name="product_name" id="name" class="form-control">
                    <span class="err text-danger" id="nameErr"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="img">Hình Ảnh</label>
                    <input type="file" name="product_image" id="img" class="form-control d-block">

                    <span class="err text-danger" id="imgErr"></span>
                </div>
                <div class="form-group mb-3">
                    <label for="gallery">Bộ sưu tập</label>
                    <input type="file" name="product_gallery[]" id="gallery" class="form-control d-block" multiple>
                    <span class="err text-danger" id="galleryErr"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="info"> Mô Tả</label>
                    <input type="text" name="product_description" id="info" class="form-control">
                    <span class="err text-danger" id="infoErr"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="price">Giá</label>
                    <input type="text" name="product_price" id="price" class="form-control">
                    <span class="err text-danger" id="priceErr"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="sale">Sale</label>
                    <input type="text" name="product_sale_price" id="sale" class="form-control">
                    <span class="err text-danger" id="saleErr"></span>
                </div>

                
                <div class="form-group mb-3">
                    <label for="size">Size</label>
                    <input type="text" name="size" id="size" class="form-control">
                    <span class="err text-danger" id="sizeErr"></span>
                </div>

                <div class="form-group mb-3">
                    <label for="color">Màu Sắc</label>
                    <input type="text" name="color" id="color" class="form-control">
                    <span class="err text-danger" id="colorErr"></span>
                </div>
                <div class="form-group mb-3">
                    <label for="quantity">Số Lượng</label>
                    <input type="text" name="quantity" id="quantity" class="form-control">
                    <span class="err text-danger" id="quantityErr"></span>
                </div>
                <div class="form-group mb-3">
                    <input type="submit" name="themmoi" value="Thêm Sản Phẩm Mới" class="btn btn-dark px-5">
                </div>
            </form>
        </div>
    </main>


</section>
<script>
function validateForm() {
    // Reset errors
    resetErrors();

    // Validate category
    var category = document.getElementById('id_category');
    if (category.value.trim() === '0') {
        displayError('categoryErr', 'Vui lòng chọn danh mục');
        category.focus();
        return false;
    }

    // Validate name
    var name = document.getElementById('name');
    if (name.value.trim() === '') {
        displayError('nameErr', 'Vui lòng nhập tên sản phẩm');
        name.focus();
        return false;
    }
    // Validate image
    var img = document.getElementById('img');
    if (img.files.length === 0) {
        displayError('imgErr', 'Vui lòng chọn hình ảnh');
        img.focus();
        return false;
    }
    var gallery = document.getElementById('gallery');
    if (gallery.value.trim() === '') {
        displayError('galleryErr', 'Vui lòng chọn 4 ảnh chi tiết');
        gallery.focus();
        return false;
    }


    var info = document.getElementById('info');
    if (info.files.length === 0) {
        displayError('infoErr', 'Vui lòng chọn hình ảnh');
        info.focus();
        return false;
    }
    // Validate image
    var price = document.getElementById('price');
    if (price.files.length === 0) {
        displayError('priceErr', 'Vui lòng chọn hình ảnh');
        price.focus();
        return false;
    }
    // Validate image
    var sale = document.getElementById('sale');
    if (sale.files.length === 0) {
        displayError('saleErr', 'Vui lòng chọn hình ảnh');
        sale.focus();
        return false;
    }
    // Validate image
    var view = document.getElementById('view');
    if (view.files.length === 0) {
        displayError('viewErr', 'Vui lòng chọn hình ảnh');
        view.focus();
        return false;
    }
    // Validate image
    var size = document.getElementById('size');
    if (size.files.length === 0) {
        displayError('sizeErr', 'Vui lòng chọn hình ảnh');
        size.focus();
        return false;
    }
    // Validate image
    var color = document.getElementById('color');
    if (color.files.length === 0) {
        displayError('colorErr', 'Vui lòng chọn hình ảnh');
        color.focus();
        return false;
    }
    // Validate image
    var quantity = document.getElementById('quantity');
    if (quantity.files.length === 0) {
        displayError('quantityErr', 'Vui lòng chọn hình ảnh');
        quantity.focus();
        return false;
    }
    // Add more validations as needed

    // If all validations pass, return true to allow form submission
    return true;
}

// Function to reset error messages
function resetErrors() {
    var errorElements = document.getElementsByClassName('err');
    for (var i = 0; i < errorElements.length; i++) {
        errorElements[i].innerText = '';
    }
}

// Function to display error message
function displayError(elementId, message) {
    var errorElement = document.getElementById(elementId);
    errorElement.innerText = message;
}
</script>
<?php include ('./views/admin/layout/footer.php'); ?>
<!-- ... Your existing HTML code ... -->

<!-- ... Your existing HTML code ... -->