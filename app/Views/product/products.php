<!-- app/Views/product/products.php -->

<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<main>
    <!-- Latest Products Start -->
    <section class="latest-product-area padding-bottom">
        <div class="container">
            <div class="row product-btn d-flex justify-content-center align-items-center">
                <div class="col-xl-4 col-lg-5 col-md-5">
                    <div class="section-tittle mb-30 mt-4">
                        <h2>Latest Products</h2>
                    </div>
                </div>
            </div>

            <!-- Search and Category Filter -->
            <div class="row">
                <div class="col-12">
                    <form id="filter-form" class="d-flex justify-content-end">
                        <input type="text" id="search" name="search" placeholder="Search products..." class="form-control mb-3 w-25" value="<?= esc($search) ?>">
                        <select id="category" name="category" class="form-control mb-3">
                            <option value="">All Categories</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= esc($cat['category']) ?>" <?= isset($category) && $category === $cat['category'] ? 'selected' : '' ?>>
                                    <?= esc($cat['category']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit" class="btn bg-dark mb-2">Filter</button>
                    </form>
                </div>
            </div>

            <div id="product-list" class="tab-content">
                <div class="tab-pane fade show active" id="nav-home">
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
                                                <form action="<?= base_url('cart/addToCart') ?>" method="post">
                                                    <input type="hidden" name="product_id"
                                                           value="<?= esc($product['id']) ?>">
                                                    <input type="hidden" name="product_name"
                                                           value="<?= esc($product['product_name']) ?>">
                                                    <input type="hidden" name="price" value="<?= esc($product['price']) ?>">
                                                    <input type="hidden" name="qty" value="1">
                                                    <input type="hidden" name="image"
                                                           value="<?= esc($product['image']) ?>">
                                                    <button type="submit" class="border-0 text-dark mr-2">Add to Cart</button>
                                                </form>
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

            <!-- Pagination -->
            <div class="pagination">
                <ul class="pagination justify-content-center">
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                            <a class="page-link" href="javascript:void(0);" data-page="<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </div>

        </div>
    </section>
    <!-- Latest Products End -->
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    
        $('#filter-form').submit(function (e) {
            e.preventDefault();
            loadProducts();
        });

        
        $(document).on('click', '.page-link', function () {
            const page = $(this).data('page');
            $('#filter-form').append('<input type="hidden" name="page" value="' + page + '">');
            loadProducts();
        });

        function loadProducts() {
            const formData = $('#filter-form').serialize();
            $.ajax({
                url: '<?= base_url('product/products') ?>',
                type: 'GET',
                data: formData,
                success: function (response) {
                    $('#product-list').html($(response).find('#product-list').html());
                    $('.pagination').html($(response).find('.pagination').html());
                }
            });
        }
    });
</script>

<?= $this->endSection(); ?>
