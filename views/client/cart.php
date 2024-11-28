<?php include ('./views/client/layout/header.php'); ?>
<?php
// tổng giá trị đơn hàng
$total_price = $_SESSION['total_price'] ?? 0;
// tổng số lượng sản phẩm trong giỏ hàng
$total_order = $_SESSION['total_order'] ?? 0;
// tổng giá trị tạm thời của giỏ hàng
$temporary = $_SESSION['temporary'] ?? 0;

?>
      <!--breadcrumbs area start-->
    <div class="breadcrumbs_area breadcrumbs_other">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content text-center">
                        <ul>
                            <li><a href="index.html">home</a></li>
                            <li><a href="#">pages</a></li>
                        </ul>
                        <h3>Giỏ hàng</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

     <!--shopping cart area start -->
    <div class="shopping_cart_area">
        <div class="container">
            <form action="#">
                <div class="cart_page_inner mb-60">
                    <div class="row">
                        <div class="col-12">
                            <div class="cart_page_tabel">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Thông Tin</th>
                                        <th>Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Tổng</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $cartTotal = 0; // Biến tổng giá trị giỏ hàng ?>
                                    <?php foreach ($_SESSION['myCart'] as $index => $pro) : ?>
                                        <?php $cartTotal += $pro['price'] * $pro['quantity']; ?>
                                        <tr class="border-top" data-index="<?= $index ?>">
                                            <td>
                                                <div class="cart_product_thumb">
                                                    <img src="<?= BASE_URL . $pro['image'] ?>" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_text">
                                                    <h4><?= $pro['name'] ?></h4>
                                                    <ul>
                                                        <li><i class="ion-ios-arrow-right"></i> Màu sắc : <span><?= $pro['color'] ?></span></li>
                                                        <li><i class="ion-ios-arrow-right"></i> Kích thước : <span><?= $pro['size'] ?></span></li>
                                                    </ul>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_price">
                                                    <span><?= number_format($pro['price'], 0, ',', '.') ?>đ</span>
                                                </div>
                                            </td>
                                            <td class="product_quantity">
                                                <div class="cart_product_quantity">
                                                    <input 
                                                        min="1" 
                                                        max="100" 
                                                        value="<?= $pro['quantity'] ?>" 
                                                        type="number" 
                                                        class="quantity-input" 
                                                        data-price="<?= $pro['price'] ?>" 
                                                        data-index="<?= $index ?>">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_price total-price">
                                                    <span><?= number_format($pro['price'] * $pro['quantity'], 0, ',', '.') ?>đ</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="cart_product_remove text-right">
                                                    <a href="#" class="remove-item" data-index="<?= $index ?>"><i class="ion-android-close"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="text-right">Tổng cộng:</td>
                                        <td colspan="2" class="cart-total">
                                            <span><?= number_format($cartTotal, 0, ',', '.') ?>đ</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>

                            </div>
                            <div class="cart_page_button border-top d-flex justify-content-between">
                                <div class="shopping_cart_btn">
                                    <a href="?action=cart&action=del_all" class="btn btn-primary border">XÓA TOÀN BỘ GIỎ HÀNG</a>
                                    <button class="btn btn-primary border" type="submit">UPDATE YOUR CART</button>
                                </div>
                                <div class="shopping_continue_btn">
                                    <button class="btn btn-primary" type="submit">TIẾP TỤC MUA SẮM</button>
                                </div>
                            </div>
                         </div>
                     </div>
                 </div>
                 <!--coupon code area start-->
                <div class="cart_page_bottom">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="shopping_coupon_calculate top">
                                <h3 class="border-bottom">Tính Toán Vận Chuyển </h3>
                                <select class="select_option border">
                                    <option value="1">United Kingdom (UK)  </option>
                                    <option value="2">Åland Islands  </option>
                                    <option value="3">Afghanistan  </option>
                                    <option value="4">Belgium </option>
                                    <option value="5">Albania  </option>
                                </select>
                                <input class="border" placeholder="State / Country" type="text">
                                <input class="border" placeholder="Postcode / Zip" type="text">
                                <button class="btn btn-primary" type="submit">get a quote</button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="shopping_coupon_calculate">
                                <h3 class="border-bottom">Mã Giảm Giá   </h3>
                                <p>Enter your coupon code if you have one.</p>
                                <input class="border" placeholder="Enter your code" type="text">
                                <button class="btn btn-primary" type="submit">apply coupon</button>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-8">
                            <div class="grand_totall_area">
                               <div class="grand_totall_inner border-bottom">
                                   <div class="cart_subtotal d-flex justify-content-between">
                                       <p style="font-size: 17px;" class="text-capitalize">Tạm tính </p>
                                       <span style="font-size: 17px;">
                                            <?php
                                                if (isset($temporary)) {
                                                    echo number_format($temporary, 0, ',', '.') . ' đ';
                                                } else {
                                                    echo '0 đ';
                                                }
                                            ?>
                                        </span>
                                   </div>
                                   <div class="cart_grandtotal d-flex justify-content-between">
                                       <p style="font-size: 28px;">Tổng</p>
                                       <span style="font-size: 28px;"><?php if (isset($total_price)) {
                                            echo number_format($total_price, 0, ',', '.');
                                            } ?>đ
                                        </span>
                                   </div>
                               </div>
                               <div class="proceed_checkout_btn">
                                   <a class="btn btn-primary" href="#">Tiến Hành Thanh Toán</a>
                               </div>
                               <a href="#">Checkout with Mutilple Adresses</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--coupon code area end-->
            </form>
        </div>
    </div>
     <!--shopping cart area end -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const cartTable = document.querySelector('table');
    const cartTotal = document.querySelector('.cart-total span');

    // Gửi AJAX để cập nhật số lượng
    function updateQuantity(index, quantity) {
        fetch('?action=update_cart_quantity', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `index=${index}&quantity=${quantity}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Cập nhật tổng tiền sản phẩm
                const row = cartTable.querySelector(`tr[data-index="${index}"]`);
                const totalCell = row.querySelector('.total-price span');
                totalCell.textContent = data.productTotal.toLocaleString('vi-VN') + 'đ';

                // Cập nhật tổng tiền giỏ hàng
                cartTotal.textContent = data.cartTotal.toLocaleString('vi-VN') + 'đ';
            } else {
                alert(data.message || 'Có lỗi xảy ra!');
            }
        });
    }

    // Gửi AJAX để xóa sản phẩm
    function removeItem(index) {
        fetch('?action=remove_cart_item', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: `index=${index}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Xóa dòng sản phẩm khỏi bảng
                const row = cartTable.querySelector(`tr[data-index="${index}"]`);
                row.remove();

                // Cập nhật tổng tiền giỏ hàng
                cartTotal.textContent = data.cartTotal.toLocaleString('vi-VN') + 'đ';
            } else {
                alert(data.message || 'Có lỗi xảy ra!');
            }
        });
    }

    // Lắng nghe thay đổi số lượng
    cartTable.addEventListener('input', function (e) {
        if (e.target.classList.contains('quantity-input')) {
            const quantity = parseInt(e.target.value, 10);
            const index = e.target.dataset.index;

            updateQuantity(index, quantity);
        }
    });

    // Lắng nghe sự kiện xóa sản phẩm
    cartTable.addEventListener('click', function (e) {
        if (e.target.closest('.remove-item')) {
            const index = e.target.closest('.remove-item').dataset.index;

            if (confirm('Bạn có chắc muốn xóa sản phẩm này?')) {
                removeItem(index);
            }
        }
    });
});

</script>
     <?php include ('./views/client/layout/footer.php'); ?>