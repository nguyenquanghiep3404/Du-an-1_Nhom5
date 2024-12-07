<?php include('./views/client/layout/header.php'); ?>
<style>
    /* Base styling for the container */
.condition {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px;
    background-color: #f9f9f9;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

/* Style for each step form */
.step-cart, .step-checkout, .step-complete {
    display: flex;
    align-items: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.step-cart svg, .step-checkout svg, .step-complete svg {
    margin-right: 10px;
    transition: transform 0.3s ease;
}

/* Text styling for steps */
.step-cart p, .step-checkout p, .step-complete p {
    font-size: 14px;
    color: rgb(153, 153, 153);
    font-weight: bold;
    margin: 0;
}

.step-cart:hover p, .step-checkout:hover p, .step-complete.active p {
    color: #C92027;
}

.step-cart:hover svg, .step-checkout:hover svg, .step-complete.active svg {
    transform: scale(1.1);
    fill: #C92027;
}

/* Dotline separator */
.dotline {
    flex-grow: 1;
    height: 1px;
    background-color: #ddd;
    margin: 0 15px;
}

/* Active step */
.step-complete.active p {
    color: #C92027;
}

.step-complete.active svg {
    fill: #C92027;
}

/* Responsive styling */
@media (max-width: 768px) {
    .condition {
        flex-direction: column;
        align-items: flex-start;
    }

    .dotline {
        display: none;
    }

    .step-cart, .step-checkout, .step-complete {
        margin-bottom: 10px;
    }
}
</style>
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
                    <h3>Trang Thanh Toán</h3>
                </div>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--Checkout page section-->
<div class="checkout_section" id="accordion">
    <div class="container">
        <!-- <div class="returning_coupon_area">
                <div class="row">
                    <div class="col-lg-7 col-md-6">
                        <div class="user-actions">
                            <h3>
                                <i class="fa fa-comment-o" aria-hidden="true"></i>
                                Returning customer?
                                <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>

                            </h3>
                             <div id="checkout_login" class="collapse" data-parent="#accordion">
                                <div class="checkout_info">
                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>
                                    <form action="#">
                                        <div class="form_group">
                                            <label>Username or email <span>*</span></label>
                                            <input type="text">
                                        </div>
                                        <div class="form_group">
                                            <label>Password  <span>*</span></label>
                                            <input type="text">
                                        </div>
                                        <div class="form_group group_3 ">
                                            <button class="btn btn-primary" type="submit">Login</button>
                                            <label for="remember_box">
                                                <input id="remember_box" type="checkbox">
                                                <span> Remember me </span>
                                            </label>
                                        </div>
                                        <a href="#">Lost your password?</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6">
                        <div class="user-actions">
                            <h3>
                                <i class="fa fa-comment-o" aria-hidden="true"></i>
                                Have a Coupon ?
                                <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon2" aria-expanded="true">Click here to enter your code</a>

                            </h3>
                             <div id="checkout_coupon2" class="collapse" data-parent="#accordion">
                                <div class="checkout_info coupon_info">
                                    <form action="#">
                                        <input placeholder="Coupon code" type="text">
                                        <button class="btn btn-primary" type="submit">Apply coupon</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-7 col-md-6">
                    <form action="?action=createOrederDetails" method="POST" >
                        <h3>Billing Details</h3>
                        <div class="checkout_form_input">
                            <label>Tên  <span>*</span></label>
                            <input type="text" name="name" value="<?= $showCheckout['name']  ?>">
                        </div>
                        <div class="checkout_form_input">
                            <label>Địa chỉ người nhận <span>*</span></label>
                            <input type="text" name="address" value="<?= $showCheckout['address']  ?>">
                        </div>
                        <div class="checkout_form_input">
                            <label> Địa chỉ email <span>*</span></label>
                            <input type="text" name="email" value="<?= $showCheckout['email']  ?>">
                        </div>
                        <div class="checkout_form_input">
                            <label> Số điện thoại <span>*</span></label>
                            <input type="text" name="phone" value="<?= $showCheckout['phone']  ?>">
                        </div>
                        <div class="checkout_form_input">
                            <label>Ghi chú </label>
                            <textarea name="note"></textarea>
                        </div>
                        <!-- </form> -->
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="order_table_right">
                        <!-- <form action="#"> -->
                        <h3>Đơn hàng của bạn</h3>
                        <div class="order_table table-responsive" style="background-color:#aecfed">
                            <?php $cartTotal = 0 ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th class="text-right">Tổng tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($_SESSION['myCart'] as $index => $order): ?>
                                      <?php  $cartTotal += $order['price'] * $order['quantity']; ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="" value="<?= $order['name'] ?>">
                                                <span><?= $order['name'] ?></span>
                                            </td>
                                            <td class="text-right">
                                                <input type="hidden" name="" value="<?= $order['price'] * $order['quantity'] ?>">
                                                <span><?= number_format($order['price'] * $order['quantity'], 0, ',', '.') ?>đ</span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td>Cart Subtotal</td>
                                        <td class="text-right">
                                            <input type="hidden" name="" value="<?= $cartTotal  ?>">
                                            <span><?= number_format($cartTotal, 0, ',', '.') ?>đ</span>
                                        </td>
                                    </tr>
                                    <tr class="order_total">
                                        <th>Order Total</th>
                                        <td class="text-right">
                                            <input type="hidden" name="" value="<?= $cartTotal  ?>">
                                            <span><?= number_format($cartTotal, 0, ',', '.') ?>đ</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                            <div class="panel-default">
                                <div class="panel_radio">
                                    <input id="payment1" name="check_method" type="radio" value="cod"  />
                                    <span class="checkmark"></span>
                                </div>

                                <label for="payment1" data-toggle="collapse" data-target="#panel1">Thanh toán bằng tiền mặt</label>
                                <div id="panel1" class="collapse show one" data-parent="#accordion">
                                    <div class="card-body1">
                                        <p>Thanh toán trực tiếp. </p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <div class="panel_radio">
                                    <input id="payment5" name="check_method" type="radio" value="vnpay" />
                                    <span class="checkmark"></span>
                                </div>
                                <label for="payment5" data-toggle="collapse" data-target="#method5">Thanh toán qua VNPAY</label>
                                <div id="method5" class="collapse five" data-parent="#accordion">
                                    <div class="card-body1">
                                        <p>Thanh toán trực tuyến an toàn qua VNPAY.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <div class="panel_radio">
                                    <input id="payment5" name="check_method" type="radio" value="vnpay" />
                                    <span class="checkmark"></span>
                                </div>
                                <label for="payment5" data-toggle="collapse" data-target="#method5">Thanh toán qua MOMO</label>
                                <div id="method5" class="collapse five" data-parent="#accordion">
                                    <div class="card-body1">
                                        <p>Thanh toán trực tuyến an toàn qua Momo.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-default">
                                <div class="panel_radio">
                                    <input id="payment4" name="check_method" type="radio" data-target="createp_account" />
                                    <span class="checkmark"></span>
                                </div>
                                <label for="payment4" data-toggle="collapse" data-target="#method4">Thanh toán ở cửa hàng</label>
                                <div id="method4" class="collapse four" data-parent="#accordion">
                                    <div class="card-body1">
                                        <p>Thanh toán trực tiếp ở cửa hàng Momo. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="place_order_btn">
                            <button class="btn btn-primary">Thanh toán</button>
                            <!-- <a class="btn btn-primary" href="#">place order</a> -->
                        </div>
                        <!-- <button type="submit" class="btn btn-primary">place order</button> -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Checkout page section end-->
<?php include('./views/client/layout/footer.php'); ?>
<?php include './views/client/layout/miniCart.php' ?>