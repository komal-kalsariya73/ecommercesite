<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>
<style>
    .nice-select {
        width: 100% !important;
    }

    .order_box ul.list li {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #ddd;
    }

    .order_box ul.list li:last-child {
        border-bottom: none;
    }

    .btn-primary {
        background-color: #ff6f61;
        border: none;
        padding: 10px 20px;
        font-size: 16px;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-primary:hover {
        background-color: #e55750;
    }

    a {
        color: black;
    }

    .card {
        border: 0;
    }

    a:hover {
        color: black;
    }

    h6 {
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>
<main>
    <div class="slider-area">
        <div class="single-slider slider-height2 d-flex align-items-center" data-background="<?= base_url('public/assets/img/hero/category.jpg') ?>">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Checkout</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="checkout_area pt-5">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form id="checkout-form" method="POST" novalidate>
                            <div id="success-message" class="alert alert-success" style="display: none;"></div>
                            <div id="error-message" class="alert alert-danger" style="display: none;"></div>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="fname">First Name</label>
                                    <input type="text" class="form-control" id="fname" name="fname" required>
                                    <span class="text-danger" id="error-fname"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="lname">Last Name</label>
                                    <input type="text" class="form-control" id="lname" name="lname" required>
                                    <span class="text-danger" id="error-lname"></span>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="address">Address</label>
                                    <input type="text" class="form-control" id="address" name="address" required>
                                    <span class="text-danger" id="error-address"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone" required>
                                    <span class="text-danger" id="error-phone"></span>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <span class="text-danger" id="error-email"></span>
                                </div>
                                <div class="col-md-12 form-group">
                                    <label for="city">City</label>
                                    <select class="form-control" id="city" name="city" required>
                                        <option value="">Choose city...</option>
                                        <option value="Surat">Surat</option>
                                        <option value="Rajkot">Rajkot</option>
                                        <option value="Mumbai">Mumbai</option>
                                    </select>

                                </div>
                                <span class="text-danger" id="error-city"></span>
                                <div class="col-md-12 form-group">
                                    <label for="notes">Order Notes</label>
                                    <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                                    <span class="text-danger" id="error-notes"></span>
                                </div>
                                <input type="hidden" id="total_amt" name="total_amt" value="">
                                <span class="text-danger" id="error-total_amt"></span>

                            </div>
                            <div class="creat_account">
                                <input type="checkbox" id="terms" name="terms" required>
                                <label for="terms">I’ve read and accept the <a href="#">terms & conditions</a></label>
                                <span class="text-danger" id="error-terms"></span>
                            </div>

                        </form>
                    </div>

                    <div class="col-lg-4">
                        <div class="order_box">
                            <h3>Your Order</h3>
                            <ul class="list">
                                <li>Product <span>Total</span></li>
                                <!-- Dynamically populated cart items -->
                                <div id="cart-items">
                                    <!-- Example: Use JS to populate this -->
                                    <!-- <li>Product Name x Quantity <span>$Price</span></li> -->
                                </div>
                            </ul>
                            <ul class="list list_2">
                                <li>Subtotal <span id="subtotal">$0</span></li>
                                <li>Shipping <span id="shipping">$20</span></li>`
                                <li>Total <span id="total">$0</span></li>
                            </ul>
                            <div id="accordion" role="tablist" class="mb-4">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <label>
                                                <input type="radio" name="payment_method" value="paypal" id="paypal-button"> PayPal
                                            </label>

                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integ er bibendum sodales arcu id te mpus. Ut consectetur lacus.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h6 class="mb-0">
                                            <label>
                                                <input type="radio" name="payment_method" value="paypal" id="paypal-button"> Credit/debit cards
                                            </label>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h6 class="mb-0">
                                            <label>
                                                <input type="radio" name="payment_method" value="paypal" id="paypal-button"> Google Pay
                                            </label>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingStripe">
                                        <h6 class="mb-0">
                                            <label>
                                                <input type="radio" name="payment_method" value="stripe" id="stripe-option"> Stripe
                                            </label>
                                        </h6>
                                    </div>
                                    <div id="collapseStripe" class="collapse" role="tabpanel" aria-labelledby="headingStripe" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Pay securely with your credit or debit card via Stripe.</p>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn p-4" id="place-order-btn" style="background-color: #e55750;">Place Order</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="total_amt" name="total_amt" value="">

                </div>
            </div>
        </div>
    </section>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<!-- Your existing HTML code for the checkout page remains the same -->

<script>
    const fetchCartItems = () => {
        return $.ajax({
            url: '<?= base_url('cart/getCartItems') ?>',
            type: 'GET',
            dataType: 'json',
        });
    };

    const calculateTotals = () => {
        fetchCartItems()
            .done(function(response) {
                if (response.status === 'success') {
                    let cartItems = response.data;
                    let subtotal = 0;

                    $('#cart-items').html('');
                    cartItems.forEach(item => {
                        let totalPrice = parseFloat(item.total_price);

                        if (isNaN(totalPrice)) {
                            totalPrice = 0;
                        }

                        subtotal += totalPrice;


                        $('#cart-items').append(
                            `<li>${item.product_name} x ${item.qty} <span>$${totalPrice.toFixed(2)}</span></li>`
                        );
                    });


                    let shippingCost = 20;
                    let total = subtotal + shippingCost;


                    $('#subtotal').text(`$${subtotal.toFixed(2)}`);
                    $('#shipping').text(`$${shippingCost.toFixed(2)}`);
                    $('#total').text(`$${total.toFixed(2)}`);


                    $('#total_amt').val(total.toFixed(2));
                } else {
                    $('#cart-items').html('<li>No items in the cart.</li>');
                    $('#subtotal, #shipping, #total').text('$0.00');
                    $('#total_amt').val(0);
                }
            })
            .fail(function() {
                alert('Failed to fetch cart items. Please try again.');
            });
    };

    calculateTotals();

    $(document).ready(function() {
        $('#place-order-btn').on('click', function() {
            const totalAmt = $('#total_amt').val();
            if (!totalAmt || totalAmt === "0") {
                $('#error-total_amt').html('Total amount is required.');
                return;
            }

            $('#success-message, #error-message').hide();
            $('.text-danger').html('');

            const formData = $('#checkout-form').serialize();

            $.ajax({
                url: '<?= base_url('cart/placeOrder') ?>',
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        $('.cart-count').text('0');
                        $('#success-message').html(response.message).show();

                        if ($('#paypal-button').is(':checked')) {
                            // Handle PayPal
                            $.ajax({
                                url: '<?= base_url('paypal/create-payment') ?>',
                                type: 'POST',
                                data: {
                                    totalAmt: totalAmt
                                },
                                success: function(paymentResponse) {
                                    if (paymentResponse.status === 'success') {

                                        window.location.href = paymentResponse.redirect_url;
                                    } else {
                                        alert('Error: ' + paymentResponse.message);
                                    }
                                },
                                error: function() {
                                    alert('Error processing PayPal payment');
                                }
                            });
                        } else if ($('input[name="payment_method"]:checked').val() === 'stripe') {
                            // Stripe payment
                            $.ajax({
                                url: '<?= base_url('stripe/createSession') ?>',
                                type: 'POST',
                                data: {
                                    totalAmt: totalAmt
                                },
                                success: function(response) {
                                    if (response.status === 'success') {
                                        const sessionId = response.sessionId;
                                        // Use the session ID to redirect to Stripe Checkout
                                        var stripe = Stripe('pk_test_51QaBCyEKVRYQUNGXy2ap9V6kSPmU4eW38xUuICUguFLV6XHWXJu69FfzmQp33D8kfO4rQGI7yakxIXU4UYFISM1X00z0AWoq7M');
                                        stripe.redirectToCheckout({
                                                sessionId: sessionId
                                            })
                                            .then(function(result) {
                                                if (result.error) {
                                                    console.error('Stripe Checkout Error:', result.error.message);
                                                }
                                            });
                                    } else {
                                        alert('Error creating session: ' + response.message);
                                    }
                                },
                                error: function() {
                                    alert('An error occurred while creating the session.');
                                }
                            });

                        } else {
                            // Redirect to thank you page
                            window.location.href = '<?= base_url('product/thankyou') ?>';
                        }
                    } else if (response.status === 'error') {
                        if (typeof response.message === 'object') {
                            $.each(response.message, function(key, value) {
                                $(`#error-${key}`).html(value);
                            });
                        } else {
                            $('#error-message').html(response.message).show();
                        }
                    }
                },
                error: function() {
                    alert('An unexpected error occurred. Please try again.');
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>