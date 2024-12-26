<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<style>
    .cart-btns {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .cart-btns a {
        padding: 10px 20px;
        background-color: #ff6f61;
        color: #fff;
        border-radius: 5px;
        text-decoration: none;
    }

    .cart-btns a:hover {
        background-color: #e55750;
    }

    .delete-icon {
        color: #ff6f61;
        cursor: pointer;
    }

    .delete-icon:hover {
        color: #e55750;
    }
</style>

<main>
    <div class="container">
        <h2>Your Cart</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="cart-table-body">
                <?php if (!empty($cart)): ?>
                    <?php foreach ($cart as $item): ?>
                        <tr id="cart-item-<?= esc($item['id']) ?>">
                            <td><?= esc($item['product_name']) ?></td>
                            <td><img src="<?= base_url('public/uploads/' . $item['image']) ?>" width="50"></td>
                            <td>$<?= esc($item['price']) ?></td>
                            <td><?= esc($item['qty']) ?></td>
                            <td>$<?= esc($item['total_price']) ?></td>
                            <td>
                                <i class="fas fa-trash delete-icon" data-id="<?= esc($item['id']) ?>"></i>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <div class="total-price">
            <h5>Subtotal: $<span id="subtotal"><?= esc($subtotal) ?></span></h5>
        </div>
        <div class="cart-btns">
            <a href="<?= base_url('/product/main') ?>">Continue Shopping</a>
            <a href="<?= base_url('/product/checkout') ?>">Proceed to Checkout</a>
        </div>
    </div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.delete-icon').click(function () {
            const itemId = $(this).data('id');

            if (!itemId) {
                alert('Invalid item ID.');
                return;
            }

            if (confirm('Are you sure you want to remove this item from the cart?')) {
                $.ajax({
                    url: '<?= base_url('cart/deleteItem') ?>/' + itemId,
                    method: 'POST',
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            $('#cart-item-' + itemId).remove();
                            $('#subtotal').text(response.newSubtotal);

                            if ($('#cart-table-body tr').length === 0) {
                                $('#cart-table-body').html('<tr><td colspan="6">Your cart is empty.</td></tr>');
                            }
                        } else {
                            alert(response.message || 'Failed to remove the item.');
                        }
                    },
                    error: function () {
                        alert('An error occurred. Please try again.');
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection(); ?>
