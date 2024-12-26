<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <?= $this->include('admin/link'); ?>
</head>

<body>

    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="preloader-circle"></div>
                <div class="preloader-img pere-text">
                    <img src="assets/img/logo/logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- Preloader Start -->


    <?= $this->include('admin/header'); ?>



    <main>

    <?= $this->renderSection('content'); ?>
    </main>
    <!-- footer -->


        <?= $this->include('admin/footer'); ?>
    

    <!-- footer end -->
    <!-- JS here -->

    <!-- All JS Custom Plugins Link Here here -->
    <?= $this->include('admin/linkjs'); ?>

</body>

</html>