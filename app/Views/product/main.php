<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<main>
    <!-- slider Area Start -->
    <div class="slider-area ">
        <div class="slider-active">
            <div class="single-slider slider-height" data-background="assets/img/hero/h1_hero.jpg">
                <div class="container">
                    <div class="row d-flex align-items-center justify-content-between">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 d-none d-md-block">
                            <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                <img src="<?= base_url('public/assets/img/hero/hero_man.png') ?>" alt="">
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-8">
                            <div class="hero__caption">
                                <span data-animation="fadeInRight" data-delay=".4s">60% Discount</span>
                                <h1 data-animation="fadeInRight" data-delay=".6s">Winter <br> Collection</h1>
                                <p data-animation="fadeInRight" data-delay=".8s">Best Cloth Collection By 2020!</p>
                                <div class="hero__btn" data-animation="fadeInRight" data-delay="1s">
                                    <a href="industries.html" class="btn hero-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End -->

    <!-- Latest Products Start -->
    <section class="latest-product-area">
        <div class="container">
            <div class="row product-btn d-flex justify-content-center align-items-center">
                <div class="col-xl-4 col-lg-5 col-md-5">
                    <div class="section-tittle mb-30 mt-4">
                        <h2>Latest Products</h2>
                    </div>
                </div>
            </div>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row">
                        <?php if (!empty($products) && is_array($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <div class="col-xl-4 col-lg-4 col-md-6">
                                    <div class="single-product mb-60">
                                        <div class="product-img">
                                            <a href="<?= base_url('product/fetchProduct/' . $product['id']) ?>">
                                                <img src="<?= base_url('public/uploads/' . $product['image']) ?>"
                                                    alt="<?= esc($product['product_name']) ?>" class="img-fluid">
                                            </a>
                                            <div class="new-product">
                                                <span>New</span>
                                            </div>
                                        </div>
                                        <div class="product-caption">
                                            <div class="product-ratting">
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star low-star"></i>
                                                <i class="far fa-star low-star"></i>
                                            </div>
                                            <h4>
                                                <a href="<?= base_url('product/fetchProduct/' . $product['id']) ?>">
                                                    <?= esc($product['product_name']) ?>
                                                </a>
                                            </h4>
                                            <div class="price">
                                                <ul>
                                                    <li>$<?= esc($product['price']) ?></li>
                                                    <li class="discount">$60.00</li>
                                                </ul>
                                            </div>
                                            <div class="d-flex justify-content-center mt-3">
                                                <!-- <form action="" method="post"> -->
                                                    <input type="hidden" name="product_id"
                                                        value="<?= esc($product['id']) ?>">
                                                    <input type="hidden" name="product_name"
                                                        value="<?= esc($product['product_name']) ?>">
                                                    <input type="hidden" name="price" value="<?= esc($product['price']) ?>">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input type="hidden" name="image"
                                                        value="<?= esc($product['image']) ?>">
                                                    <div class="add_to_cart">
                                                    <button class="add-to-cart-btn text-dark border-0 mr-4"
    data-id="<?= esc($product['id']) ?>"
    data-name="<?= esc($product['product_name']) ?>"
    data-price="<?= esc($product['price']) ?>">
    Add to Cart
</button>

                                                    </div>
                                                <!-- </form> -->
                                                <a href="<?= base_url('product/fetchProduct/' . $product['id']) ?>"
                                                    class="text-dark">View Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="col-12">
                                <p>No products available.</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Products End -->
</main>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function() {
    $('.add-to-cart-btn').on('click', function(e) {
        e.preventDefault(); // Prevent the default form submission

        const productId = $(this).data('id');
        const productName = $(this).data('name');
        const price = $(this).data('price');

        $.ajax({
            url: "<?= base_url('product/addtocart') ?>", // Correct POST URL
            method: "POST", // Ensure POST method
            data: {
                product_id: productId,
                qty: 1,
            },
            success: function(response) {
                if (response.status === 'success') {
                    $("#cart-item-count").text(response.cartCount); // Update cart item count
                    $('#success-message').text(response.message).show();
                    $('#error-message').hide();
                } else {
                    $('#error-message').text(response.message).show();
                    $('#success-message').hide();
                }
            },
            error: function() {
                $('#error-message').text('An error occurred. Please try again.').show();
                $('#success-message').hide();
            }
        });
    });
});

</script>

<?= $this->endSection(); ?>