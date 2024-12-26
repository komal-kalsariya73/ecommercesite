<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<main>

<!-- slider Area Start -->
<div class="product_image_area">
    <div class="container">
      <form action="" method="post">
        <div class="row justify-content-center">

          <div class="col-lg-6">
            <div class="product_img_slide owl-carousel">
              <div class="single_product_img">
               <img src="<?= base_url('public/uploads/' . $product['image']) ?>" alt="<?= esc($product['product_name']) ?>">
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="single_product_text text-center">
              <h3><?= esc($product['product_name']) ?></h3>
              <p><?= esc($product['description']) ?></p>
              <div class="card_area">
                <div class="product_count_area">
                  <p>Quantity</p>
                  <div class="product_count d-inline-block">
                    <span class="product_count_item inumber-decrement"> <i class="ti-minus"></i></span>
                    <input class="product_count_item input-number" id="qty" type="number" value="1" min="1" max="10">
                    <span class="product_count_item number-increment"> <i class="ti-plus"></i></span>
                  </div>
                  <p>$<?= esc($product['price']) ?></p>
                </div>
                <div class="add_to_cart">
                <button id="add-to-cart-btn" class="btn bg-dark" 
        data-id="<?= esc($product['id']) ?>" 
        data-name="<?= esc($product['product_name']) ?>" 
        data-price="<?= esc($product['price']) ?>" 
        data-image="<?= esc($product['image']) ?>">Add to Cart</button>

                </div>
                <div id="error-message" class="text-danger" style="display: none;"></div>
                <div id="success-message" class="text-success" style="display: none;"></div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
</div>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
      $('#add-to-cart-btn').on('click', function (e) {
    e.preventDefault();  // Prevent the default form submission

    const productId = $(this).data('id');
    const productName = $(this).data('name');
    const price = $(this).data('price');
    const qty = $('#qty').val();
    const image = $(this).data('image');

    $.ajax({
        url: "<?= base_url('product/addtocart') ?>",  // Correct POST URL
        method: "POST",  // Ensure POST method
        data: {
            product_id: productId,
            product_name: productName,
            price: price,
            qty: qty,
            image: image
        },
        success: function (response) {
            if (response.status === 'success') {
              $("#cart-item-count").text(response.cartCount); // Update cart item count
                    $('#success-message').text(response.message).show();
                    $('#error-message').hide();
            } else {
                $('#error-message').text(response.message).show();
                $('#success-message').hide();
            }
        },
        error: function () {
            $('#error-message').text('An error occurred. Please try again.').show();
            $('#success-message').hide();
        }
    });
});
    });

</script>

<?= $this->endSection(); ?>
