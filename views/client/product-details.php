<?php include ('./views/client/layout/header.php'); ?>
<?= var_dump($product) ?>
    <!--breadcrumbs area start-->
    <div class="breadcrumbs_area breadcrumbs_product">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                        <ul>
                            <li><a href="?action=client">Trang chủ</a></li>
                            <li><a href="?action=product&product_id=<?= $category_id?>"><?= $product['category_name'] ?></a></li>
                            <li><?= $product['name'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumbs area end-->

    <!--product details start-->
    <section class="product_details mb-135">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                <div class="product_zoom_gallery">
    <div class="zoom_gallery_inner d-flex">
                <div class="zoom_tab_img">
                    <?php
                    // Trích xuất mảng `gallery` và chuyển đổi từ JSON nếu cần
                    $images = json_decode($product['gallery']); // Dữ liệu của bạn
                    if (is_array($images)) {
                        foreach ($images as $image) {
                            // Hiển thị từng ảnh nhỏ (thumbnail)
                            echo '<a class="zoom_tabimg_list" href="javascript:void(0)">
                                    <img src="' . $image . '" alt="tab-thumb" onclick="changeImage(this)" />
                                </a>';
                        }
                        }
                        ?>
                    </div>

                        <div class="product_zoom_main_img">
                            <div class="large-img">
                                <!-- Ảnh lớn, hiển thị mặc định là ảnh đầu tiên trong mảng -->
                                <img src="<?= $product['image']; ?>" alt="Large Image" width="100%" id="largeImage">
                            </div>
                        </div>
                    </div>
                </div>

                <script>
                    // Hàm thay đổi ảnh lớn khi người dùng click vào ảnh nhỏ
                    function changeImage(thumbnail) {
                        var largeImage = document.getElementById("largeImage");
                        largeImage.src = thumbnail.src; // Cập nhật src của ảnh lớn
                    }
                </script>
                </div>
                
                <div class="col-lg-6 col-md-6">
                    <div class="product_d_right">
                       <form action="#">
                            <h1><div class="product-name">
                            <?= $product['name'] ?>
                </div> </h1>
                            <div class="product_ratting_review d-flex align-items-center">
                                <div class=" product_ratting">
                                    <ul class="d-flex">
                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                        <li><a href="#"><i class="ion-ios-star"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product_review">
                                    <ul class="d-flex">
                                        <li>4 reviews</li>
                                        <li>Write your review</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="price_box">
                                <span class="current_price"><?=  $product['price'] ?></span>
                            </div>
                            <div class="product_availalbe">
                                <ul class="d-flex">
                                    <li><i class="icon-layers icons"></i> Chỉ còn: <span>  <?= $product['quantity'] ?></span> sản phẩm </li>
                                    <li>Trạng thái: <span class="stock">Còn hàng</span></li>
                                </ul>
                            </div>
                            <div class="product_desc">
                                <p> <?=  $product['description'] ?>  </p>
                            </div>
                            <!-- /////// -->
                             <form action="?action=addToCart" method="POST" id="form-cart">
                                <div class="product_variant">
                                    <!-- Chọn biến thể màu -->
                                    <div class="filter__list widget_color d-flex align-items-center">
                                        <h3>Màu sắc</h3>
                                        <?php
                                            $currentColor = null;

                                            usort($variant, function ($a, $b) {
                                                return strcmp($a['color'], $b['color']);
                                            });

                                            foreach ($variant as $va) {
                                                extract($va);

                                                if ($currentColor !== $color) {
                                                    echo '
                                                            <div class="size-item">
                                                                <input type="radio" name="color" id="' . $color . '" value="' . $color . '" class="color">
                                                                <label for="' . $color . '" class="color-label" >' . $color . '</label>
                                                            </div>
                                                        ';
                                                    $currentColor = $color;
                                                }
                                            }
                                            ?>
                                    </div>
                                    <!-- chọn biến thể size -->
                                    <div class="filter__list widget_size d-flex align-items-center">
                                        <h3>Kích thước</h3>
                                        
                                            <?php
                                            $currentSize = null;
                                            usort($variant, function ($a, $b) {
                                                return strcmp($a['size'], $b['size']);
                                            });

                                            foreach ($variant as $va) {
                                                extract($va);

                                                if ($currentSize !== $size) {
                                                    echo '<div class="size-item">
                                                                    <input type="radio" name="size" id="' . $size . '" value="' . $size . '" class="size">
                                                                    <label for="' . $size . '" class="size-label">' . $size . '</label>
                                                                </div>
                                                        ';
                                                    $currentSize = $size;
                                                }
                                            }
                                            ?>

                                        
                                    </div>
                                    
                                    <!-- chọn số lượng -->
                                    <div class="variant_quantity_btn d-flex">
                                        <div class="">
                                            <button id="decrement">-</button>
                                            <input type="number" name="quantity" id="quantity" value="1" min="1" max="10">
                                            <button id="increment" >+</button>
                                            <script>
                                                var decrementButton = document.getElementById("decrement");
                                                var incrementButton = document.getElementById("increment");
                                                var quantityInput = document.getElementById("quantity");

                                                decrementButton.addEventListener("click", function (e) {
                                                    e.preventDefault();
                                                    var currentQuantity = parseInt(quantityInput.value);
                                                    if (currentQuantity > 1) {
                                                        quantityInput.value = currentQuantity - 1;
                                                    }
                                                });

                                                incrementButton.addEventListener("click", function (e) {
                                                    e.preventDefault();
                                                    var currentQuantity = parseInt(quantityInput.value);
                                                    quantityInput.value = currentQuantity + 1;
                                                });
                                            </script>
                                        </div>
                                            <!-- ẩn thông tin sản phẩm -->
                                            <input type="hidden" name="product-id" value="<?= $product['product_id'] ?>">
                                            <input type="hidden" name="product-img" value="<?=$product['product_id'] ?>">
                                            <input type="hidden" name="product-name" value="<?= $product['product_id'] ?>">
                                            <input type="hidden" name="product-price" value="<?= $product['product_id'] ?>">

                                            
                                            <button class="button btn btn-primary" type="submit" id="btn-addToCart" name="add_to_cart">
                                                <i class="ion-android-add"></i> Thêm Giỏ Hàng
                                            </button>
                                    </div>
                                </div>
                            </form>

                            <!-- end /////// -->
                            <div class="product_sku">
                                <p><span>SKU: </span> <?php echo $product_id ?></p>
                            </div>
                            <div class="product_tags d-flex">
                                <span>tags: </span>
                                <ul class="d-flex">
                                    <li><a href="#">fashion,</a></li>
                                    <li><a href="#">clothings,</a></li>
                                    <li><a href="#">accessorires</a></li>
                                </ul>
                            </div>
                            <!-- Phần mạng xã hội -->
                            <div class="priduct_social d-flex">
                                <span>SHARE: </span>
                                <ul>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-googleplus-outline"></i></a></li>
                                    <li><a href="#"><i class="ion-social-pinterest"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram-outline"></i></a></li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product details end-->

    <!--product info start-->
    <div class="product_d_info mb-118">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product_d_inner">
                        <div class="product_info_button border-bottom">
                            <ul class="nav" role="tablist">
                                <li >
                                    <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Product Description</a>
                                </li>
                                <li>
                                   <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews          </a>
                                </li>
                                 <li>
                                   <a data-toggle="tab" href="#tags" role="tab" aria-controls="tags" aria-selected="false">Tags </a>
                                </li>
                                <li>
                                     <a data-toggle="tab" href="#additional" role="tab" aria-controls="additional" aria-selected="false">Additional Information </a>
                                </li>
                                <li>
                                     <a data-toggle="tab" href="#tabinfo" role="tab" aria-controls="tabinfo" aria-selected="false">Custom Tab Info  </a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="info" role="tabpanel" >
                                <div class="product_info_content">
                                    <p>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. <br> Our model wearing a size medium blazer, and usually takes a size medium/38L shirt. <br> He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</p>
                                    <ul>
                                        <li>Length: 74cm</li>
                                        <li>Regular fit</li>
                                        <li>Notched lapels</li>
                                        <li>Twin button front fastening</li>
                                        <li>Front patch pockets; chest pocket</li>
                                        <li> Internal pockets</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" >
                                <div class="reviews_wrapper">
                                    <h2>1 review for Donec eu furniture</h2>
                                    <div class="reviews_comment_box">
                                        <div class="comment_thmb">
                                            <img src="assets/img/blog/comment2.jpg" alt="">
                                        </div>
                                        <div class="comment_text">
                                            <div class="reviews_meta">
                                                <div class="star_rating">
                                                    <ul class="d-flex">
                                                        <li><a href="#"><i class="icon-star"></i></a></li>
                                                       <li><a href="#"><i class="icon-star"></i></a></li>
                                                       <li><a href="#"><i class="icon-star"></i></a></li>
                                                       <li><a href="#"><i class="icon-star"></i></a></li>
                                                       <li><a href="#"><i class="icon-star"></i></a></li>
                                                    </ul>
                                                </div>
                                                <p><strong>admin </strong>- September 12, 2018</p>
                                                <span>roadthemes</span>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="comment_title">
                                        <h2>Add a review </h2>
                                        <p>Your email address will not be published.  Required fields are marked </p>
                                    </div>
                                    <div class="product_ratting mb-10">
                                       <h3>Your rating</h3>
                                        <ul class="d-flex">
                                            <li><a href="#"><i class="icon-star"></i></a></li>
                                               <li><a href="#"><i class="icon-star"></i></a></li>
                                               <li><a href="#"><i class="icon-star"></i></a></li>
                                               <li><a href="#"><i class="icon-star"></i></a></li>
                                               <li><a href="#"><i class="icon-star"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_review_form">
                                        <form action="#">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="review_comment">Your review </label>
                                                    <textarea name="comment" id="review_comment" ></textarea>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="author">Name</label>
                                                    <input id="author"  type="text">

                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <label for="email">Email </label>
                                                    <input id="email"  type="text">
                                                </div>
                                            </div>
                                            <button type="submit">Submit</button>
                                         </form>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tags" role="tabpanel" >
                                <div class="product_info_content">
                                    <ul>
                                        <li>Length: 74cm</li>
                                        <li>Regular fit</li>
                                        <li>Notched lapels</li>
                                        <li>Twin button front fastening</li>
                                        <li>Front patch pockets; chest pocket</li>
                                        <li> Internal pockets</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="additional" role="tabpanel" >
                                <div class="product_d_table">
                                   <form action="#">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="first_child">Compositions</td>
                                                    <td>Polyester</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Styles</td>
                                                    <td>Girly</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Properties</td>
                                                    <td>Short Dress</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                                </div>
                            </div>
                             <div class="tab-pane fade" id="tabinfo" role="tabpanel" >
                                <div class="product_d_table">
                                   <form action="#">
                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td class="first_child">Compositions</td>
                                                    <td>Polyester</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Styles</td>
                                                    <td>Girly</td>
                                                </tr>
                                                <tr>
                                                    <td class="first_child">Properties</td>
                                                    <td>Short Dress</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                                <div class="product_info_content">
                                    <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                                </div>
                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--product info end-->

    <!--product area start-->
    <section class="product_area related_products mb-118">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section_title mb-50">
                        <h2>Related Products</h2>
                    </div>
                </div>
            </div>
            <div class="product_container row">
                <div class=" product_slick slick_slider_activation" data-slick='{
                    "slidesToShow": 4,
                    "slidesToScroll": 1,
                    "arrows": true,
                    "dots": false,
                    "autoplay": false,
                    "speed": 300,
                    "infinite": true,
                    "responsive":[
                      {"breakpoint":992, "settings": { "slidesToShow": 3 } },
                      {"breakpoint":768, "settings": { "slidesToShow": 2 } },
                      {"breakpoint":300, "settings": { "slidesToShow": 1 } }
                     ]
                }'>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a href="product-details.html" >
                                        <img class="primary_img" src="assets/img/product/product1.jpg" alt="consectetur">
                                    </a>
                                    <div class="product_action">
                                        <ul>
                                            <li class="wishlist"><a href="#" data-tippy="Wishlist" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                            <li class="quick_view"><a data-toggle="modal" data-target="#modal_box" data-tippy="Quick View" href="#" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a></li>
                                            <li class="compare"><a data-tippy="Compare" href="#" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content text-center">
                                    <div class="product_ratting">
                                        <ul class="d-flex justify-content-center">
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><span>(4)</span></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Basic Joggin Shorts</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">$26.00</span>
                                        <span class="old_price">$62.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a class="btn btn-primary" href="#" data-tippy="Add To Cart"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a href="product-details.html" >
                                        <img class="primary_img" src="assets/img/product/product2.jpg" alt="consectetur">
                                    </a>
                                    <div class="product_action">
                                        <ul>
                                            <li class="wishlist"><a href="#" data-tippy="Wishlist" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                            <li class="quick_view"><a data-toggle="modal" data-target="#modal_box" data-tippy="Quick View" href="#" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a></li>
                                            <li class="compare"><a data-tippy="Compare" href="#" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_label">
                                        <span>-20%</span>
                                    </div>
                                </div>
                                <figcaption class="product_content text-center">
                                    <div class="product_ratting">
                                        <ul class="d-flex justify-content-center">
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><span>(6)</span></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Make Thing Happen T-Shirts</a></h4>
                                    <div class="price_box">
                                        <span class="text-black">$38.00</span>

                                    </div>
                                    <div class="add_to_cart">
                                        <a class="btn btn-primary" href="#" data-tippy="Add To Cart"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a href="product-details.html" >
                                        <img class="primary_img" src="assets/img/product/product3.jpg" alt="consectetur">
                                    </a>
                                    <div class="product_action">
                                        <ul>
                                            <li class="wishlist"><a href="#" data-tippy="Wishlist" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                            <li class="quick_view"><a data-toggle="modal" data-target="#modal_box" data-tippy="Quick View" href="#" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a></li>
                                            <li class="compare"><a data-tippy="Compare" href="#" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_label">
                                        <span>-18%</span>
                                    </div>
                                </div>
                                <figcaption class="product_content text-center">
                                    <div class="product_ratting">
                                        <ul class="d-flex justify-content-center">
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><span>(2)</span></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Basic White Simple Sneaker</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">$43.00</span>
                                        <span class="old_price">$46.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a class="btn btn-primary" href="#" data-tippy="Add To Cart"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a href="product-details.html" >
                                        <img class="primary_img" src="assets/img/product/product4.jpg" alt="consectetur">
                                    </a>
                                    <div class="product_action">
                                        <ul>
                                            <li class="wishlist"><a href="#" data-tippy="Wishlist" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                            <li class="quick_view"><a data-toggle="modal" data-target="#modal_box" data-tippy="Quick View" href="#" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a></li>
                                            <li class="compare"><a data-tippy="Compare" href="#" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content text-center">
                                    <div class="product_ratting">
                                        <ul class="d-flex justify-content-center">
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><span>(8)</span></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Simple Rounded Sunglasses</a></h4>
                                    <div class="price_box">
                                       <span class="text-black">$42.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a class="btn btn-primary" href="#" data-tippy="Add To Cart"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a href="product-details.html" >
                                        <img class="primary_img" src="assets/img/product/product1.jpg" alt="consectetur">
                                    </a>
                                    <div class="product_action">
                                        <ul>
                                            <li class="wishlist"><a href="#" data-tippy="Wishlist" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                            <li class="quick_view"><a data-toggle="modal" data-target="#modal_box" data-tippy="Quick View" href="#" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a></li>
                                            <li class="compare"><a data-tippy="Compare" href="#" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <figcaption class="product_content text-center">
                                    <div class="product_ratting">
                                        <ul class="d-flex justify-content-center">
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><span>(12)</span></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Basic Joggin Shorts</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">$26.00</span>
                                        <span class="old_price">$362.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a class="btn btn-primary" href="#" data-tippy="Add To Cart"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                    <div class="col-lg-3">
                        <article class="single_product">
                            <figure>
                                <div class="product_thumb">
                                    <a href="product-details.html" >
                                        <img class="primary_img" src="assets/img/product/product2.jpg" alt="consectetur">
                                    </a>
                                    <div class="product_action">
                                        <ul>
                                            <li class="wishlist"><a href="#" data-tippy="Wishlist" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-heart icons"></i></a></li>

                                            <li class="quick_view"><a data-toggle="modal" data-target="#modal_box" data-tippy="Quick View" href="#" data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-size-fullscreen icons"></i></a></li>
                                            <li class="compare"><a data-tippy="Compare" href="#" data-tippy-inertia="true" data-tippy-delay="50"
                                            data-tippy-arrow="true" data-tippy-placement="left"><i class="icon-refresh icons"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product_label">
                                        <span>-20%</span>
                                    </div>
                                </div>
                                <figcaption class="product_content text-center">
                                    <div class="product_ratting">
                                        <ul class="d-flex justify-content-center">
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><a href="#"><i class="ion-android-star"></i></a></li>
                                            <li><span>(14)</span></li>
                                        </ul>
                                    </div>
                                    <h4 class="product_name"><a href="product-details.html">Simple Rounded Sunglasses</a></h4>
                                    <div class="price_box">
                                        <span class="current_price">$35.00</span>
                                        <span class="old_price">$38.00</span>
                                    </div>
                                    <div class="add_to_cart">
                                        <a class="btn btn-primary" href="#" data-tippy="Add To Cart"  data-tippy-inertia="true" data-tippy-delay="50" data-tippy-arrow="true" data-tippy-placement="top">Add To Cart</a>
                                    </div>
                                </figcaption>
                            </figure>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--product area end-->

    
    <?php include './views/client/layout/modalPoduct.php' ?>
    <?php include './views/client/layout/miniCart.php' ?>
    <?php include ('./views/client/layout/footer.php'); ?>


