<header>
        <!-- Header Start -->
       <div class="header-area">
            <div class="main-header ">
               
               <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-3">
                                <div class="logo">
                                  <a href="main.php"><img src="<?= base_url('public/assets/img/logo/logo.png')?>" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-8 col-md-7 col-sm-5">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>                                                
                                        <ul id="navigation">                                                                                                                                     
                                            <li><a href="<?= base_url('/product/main')?>">Home</a></li>
                                            <!-- <li><a href="Catagori.html">Catagori</a></li> -->
                                            <li class=""><a href="#">Product</a>
                                                <ul class="submenu">
                                                    <li><a href="addproduct.php"> Product Add</a></li>
                                                    <li><a href="<?= base_url('/product/products')?>"> Product Details</a></li>
                                                </ul>
                                            </li>
                                            <!-- <li><a href="blog.html">Blog</a>
                                                <ul class="submenu">
                                                    <li><a href="blog.html">Blog</a></li>
                                                    <li><a href="single-blog.html">Blog Details</a></li>
                                                </ul>
                                            </li> -->
                                            <li><a href="#">Pages</a>
                                                <ul class="submenu">
                                                    <li><a href="login.html">Login</a></li>
                                                    <li><a href="cart.php">Card</a></li>
                                                    <li><a href="elements.html">Element</a></li>
                                                    <li><a href="about.html">About</a></li>
                                                    <li><a href="confirmation.html">Confirmation</a></li>
                                                    <li><a href="cart.php">Shopping Cart</a></li>
                                                    <li><a href="checkout.php">Product Checkout</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="contact.html">Contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div> 
                            <div class="col-xl-5 col-lg-3 col-md-3 col-sm-3 fix-card">
                                <ul class="header-right f-right d-none d-lg-block d-flex justify-content-between">
                                    <li class="d-none d-xl-block">
                                        <div class="form-box f-right ">
                                            <input type="text" name="Search" placeholder="Search products">
                                            <div class="search-icon">
                                                <i class="fas fa-search special-tag"></i>
                                            </div>
                                        </div>
                                     </li>
                                    <!-- <li class=" d-none d-xl-block">
                                        <div class="favorit-items">
                                            <i class="far fa-heart"></i>
                                        </div>
                                    </li> -->
                                    <li>
                                    <div class="shopping-card">
    <a href="<?= base_url('product/cart') ?>" id="cart-count">
        <i class="fas fa-shopping-cart"></i><span id="cart-item-count" class="text-dark cart">0</span>
    </a>
</div>
                                    </li>
                                   <li class="d-none d-lg-block"> <a href="<?= base_url('/login')?>" class="btn header-btn bg-dark">Sign in</a></li>
                                   <li class="d-none d-lg-block"> <a href="<?= base_url('/logout')?>" class="btn header-btn bg-dark">LogOut</a></li>
                                </ul>
                            </div>
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
               </div>
            </div>
       </div>
        <!-- Header End -->
    </header>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    function updateCartCount() {
        $.get("<?= base_url('/cart/getCartCount') ?>", function(data) {
            if (data && data.cartCount !== undefined) {
                $("#cart-item-count").text(data.cartCount);  // Update the cart count
            } else {
                console.error('Cart count not found in response:', data);
            }
        });
    }

    $(document).ready(function() {
        updateCartCount();  // Call the function on page load to get the current cart count

        // Optional: If you are adding items to the cart using AJAX, you can call updateCartCount here as well.
    });
</script>

</script>

    