<style>
#file-info {
    display: none;
}

input {
    display: none;
}
</style>

<?php include ('./views/admin/layout/header.php'); ?>
<!-- <section id="sidebar">
    <a href="index.php" class="brand">
        <image src="../uploads/logo_owenstore.svg" alt="">
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
        <a href="#index.php?action=admin" class="nav-link">Trang Chủ</a>
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
        <div class="container ">
            <h3 class="text-center">Thêm Sản Phẩm</h3>
            
            <form method="POST" style="width:500px; margin:0 auto;"
                class="mt-3 mb-5" enctype="multipart/form-data">
                <div class="mb-3 mr-5">
                    <label for="category_id">Tên Danh Mục</label>

                    <select class="form-control" name="category_id" id="category_id">
                    <?php foreach ($listCategories as $cate): ?> 
                        <option value="">Chọn Danh Mục</option>
                        <option value="<?= $cate['category_id'] ?>"><?= $cate['name'] ?></option>
                    <?php endforeach; ?>   
                    </select>

                </div>

                <div class="form-group mb-3">
                    <label >Tên Sản Phẩm</label>
                    <input type="text" name="product_name" id="name" class="form-control">
                    <span class="err" id="nameErr"></span>
                </div>
                <!-- tải lên nhiều ảnh -->
                <div class="form-group mb-3">
                    <label >Bộ sưu tập</label>
                    <input type="file" name="gallery_image[]" id="gallery" id="gallery_image[]" class="form-control d-block" multiple>
                    <span class="err" id="galleryErr"></span>
                </div>
                <!-- Khu vực nhập ảnh -->
                <div class="form-group mb-3">
                    <label >Hình Ảnh</label>
                    <input type="file" name="product_image"  class="form-control d-block">
                    <input type="file" name="img" id="img" class="form-control d-block">
                </div>
                <div>
                <!-- Hiển thị ảnh -->
                <!-- <div>
                    <span>Ảnh hiện tại:</span>
                    <div style="height: 60px; width: 100px">
                        <img style="max-height:100%; max-width:100%;" src="">
                    </div>
                </div>

                <span >Đường dẫn ảnh:</span>
                <input  type="text" name="image" value="">
                </div> -->
                <!-- duong dan -->
                <!-- <div class="form-group mb-3">
                    <label >Đường dẫn</label>
                    <input type="text" name="product_slug" class="form-control" id="slug">
                    
                    <?php if(isset($_SESSION['errors']['product_'])) : ?>
                        <p class="text-danger"><?= $_SESSION['errors']['product_name'] ?></p>
                    <?php endif; ?>
                </div> -->
                <!-- Giá sp -->
                <div class="row mt-3">
                    <div class="form-group col-lg-6 ">
                        <label>Giá Sản Phẩm</label>
                        <input type="text" name="product_price" class="form-control" >
                        <?php if(isset($_SESSION['errors']['product_price'])) : ?>
                            <p class="text-danger"><?= $_SESSION['errors']['product_price'] ?></p>
                        <?php endif; ?>
                    </div>
                    <!-- giá khuyến mãi -->
                    <div class="form-group col-lg-6 mb-3">
                        <label >Giá Khuyến Mãi</label>
                        <input type="text" name="product_sale_price" class="form-control">
                         <!-- thong bao chua nhap -->
                        <?php if(isset($_SESSION['errors']['product_sale_price'])) : ?>
                            <p class="text-danger"><?= $_SESSION['errors']['product_sale_price'] ?></p>
                        <?php endif; ?>
                    </div>

                </div>
                
                <!-- variant product -->
                <div id="variants">
                <div class=" border rounded px-2 mb-3 bg-info">
                        <div class="row mt-3">
                            <div class="form-group  mb-3">
                                <label >Số Lượng</label>
                                <input type="text" name="variant_quantity[]" id="variant_quantity" class="form-control">
                                <!-- <span class="err" id="quantityErr"></span> -->
                                <!-- thong bao chua nhap -->
                                <?php if(isset($_SESSION['errors']['variant_quantity'])) : ?>
                                <?php foreach(($_SESSION['errors']['variant_quantity']) as $variant_quantity) : ?>
                                <p class="text-danger"><?=  $variant_quantity ?></p>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group mb-3 d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                            <p class="mt-2">Kích thước</p>
                            <?php foreach ($listSizes as $size): ?>
                            <input type="checkbox" class="btn-check" name="variant_size[]" value="<?= $size["variant_size_id"]?>" id="size-<?= $size["variant_size_id"]?>" class="form-control">
                            <label class="btn btn-light rounded justify-content-center align-items-center" for="size-<?= $size["variant_size_id"]?>"><?= $size["size_name"]?></label>
                            <?php endforeach; ?>
                            <!-- thong bao chua nhap -->
                            <?php if(isset($_SESSION['errors']['variant_size'])) : ?>
                              <p class="text-danger"><?= $_SESSION['errors']['variant_size'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group mb-3 d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                            <p class>Màu sắc</p>
                            <?php foreach ($listColors as $color): ?>
                            <input type="checkbox" class="btn-check" name="variant_color[]" value="<?=$color["variant_color_id"]?>" id="color-<?= $color["variant_color_id"]?>" class="form-control">
                            <label class="btn btn-light rounded justify-content-center align-items-center" for="color-<?= $color["variant_color_id"]?>"><i class="bx bxs-circle fs-18 " style="color:<?=$color['color_code'] ?>"></i></label>
                            <?php endforeach; ?>
                            <!-- thong bao chua nhap -->
                            <?php if(isset($_SESSION['errors']['variant_color'])) : ?>
                              <p class="text-danger"><?= $_SESSION['errors']['variant_color'] ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-lg-6 ">
                                <label >Giá SP Biến Thể</label>
                                <input type="text" name="variant_price[]" class="form-control" >
                                <!-- <span class="err" id="priceErr"></span> -->
                                <!-- thong bao chua nhap -->
                                <?php if(isset($_SESSION['errors']['variant_price'])) : ?>
                                <?php foreach(($_SESSION['errors']['variant_price']) as $variant_price) : ?>
                                <p class="text-danger"><?=  $variant_price ?></p>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                            <!-- giá khuyến mãi -->
                            <div class="form-group col-lg-6 mb-3">
                                <label >Giá Khuyến Mãi Biến Thể</label>
                                <input type="text" name="variant_sale_price[]" class="form-control">
                                <!-- thong bao chua nhap -->
                                <!-- <?php if(isset($_SESSION['errors']['variant_sale_price'])) : ?>
                                    <?php foreach(($_SESSION['errors']['variant_sale_price']) as $variant_sale_price) : ?>
                                    <p class="text-danger"><?= $variant_sale_price?></p>
                                    <?php endforeach; ?>
                                <?php endif; ?> -->
                            </div>
                        </div>
                       
                </div>
                </div>
                <button type="button" id="add-variant" class="btn btn-dark">+</button>
                

                <div class="form-group mb-3 mt-2">
                    <div > Mô Tả</div>
                    <input type="text" name="product_description" id="infoErr" class="form-control">
                    <span class="err" id="infoErr"></span>
                </div>            
                <div class="form-group mb-3">
                    <input type="submit" name="add_products" value="Thêm Sản Phẩm Mới" class="btn btn-dark px-5">
                   
                </div> 
                <div> 
                    <a href="?action=product">Quay lại</a>
                </div>
            
            </form>
        </div>
    </main>


</section>
<script>
    document.getElementById('add-variant').addEventListener('click', function() {
         const container = document.getElementById('variants');

        // Tao ra 1 the div
         const newVarient = document.createElement('div');
        //  them cac lop css cho div
        newVarient.innerHTML = `
            <div class=" border rounded px-2 mb-3 bg-info">
                        <div class="row mt-3">
    
                            <div class="form-group  mb-3">
                                <label for="quantity">Số Lượng</label>
                                <input type="text" name="variant_quantity[]" id="variant_quantity[]" class="form-control">
                                
                            </div>
                        </div>
                        <div class="form-group mb-3 d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                            <p class>Kích thước</p>
                            <?php foreach ($listSizes as $size): ?>
                            <input type="checkbox" class="btn-check" name="variant_size[]" id="size-<?=$size['variant_size_id']?>-${container.children.length}" value="<?= $size['variant_size_id']  ?>" class="form-control">
                            <label class="btn btn-light rounded justify-content-center align-items-center" for="size-<?=$size['variant_size_id']?>-${container.children.length}"><?=$size['size_name']?></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="form-group mb-3 d-flex flex-wrap gap-2" role="group" aria-label="Basic checkbox toggle button group">
                            <p class>Màu sắc</p>
                            <?php foreach ($listColors as $color): ?>
                            <input type="checkbox" class="btn-check" name="variant_color[]" id="color-<?=$color['variant_color_id']?>-${container.children.length}" value="<?=$color['variant_color_id']?>" class="form-control" >
                            <label class="btn btn-light rounded justify-content-center align-items-center" for="color-<?=$color['variant_color_id']?>-${container.children.length}"><i class="bx bxs-circle fs-18 " style="color:<?=$color['color_code'] ?>"></i></label>
                            <?php endforeach; ?>
                        </div>
                        <div class="row mt-3">
                            <div class="form-group col-lg-6 ">
                                <label >Giá SP Biến Thể</label>
                                <input type="text" name="variant_price[]" class="form-control">
                                
                            </div>
                            <!-- giá khuyến mãi -->
                            <div class="form-group col-lg-6 mb-3">
                                <label >Giá Khuyến Mãi Biến Thể</label>
                                <input type="text" name="variant_sale_price[]" class="form-control">
                                
                            </div>
                        </div>
                       
                </div>
        `;
        // them bien the moi vao container
        container.appendChild(newVarient);
          })
</script>
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