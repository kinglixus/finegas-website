<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Our Products</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Products</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->



<!-- Products Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Our Products</h6>
            <h1 class="mb-4">Premium Fiber & Steel Gas Cylinders for Modern Homes</h1>
        </div>
        <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">
            <div class="col-lg-4 col-md-6 portfolio-item first">
                <div class="portfolio-img rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-6.jpg') ?>" alt="">
                    <div class="portfolio-btn">
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                            href="<?= base_url('public/assets/img/img-600x400-6.jpg') ?>" data-lightbox="portfolio"><i
                                class="fa fa-eye"></i></a>
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href=""><i
                                class="fa fa-link"></i></a>
                    </div>
                </div>
                <div class="pt-3">
                    <p class="text-primary mb-0">14.5kg Fiber Gas Cylinder</p>
                    <hr class="text-primary w-25 my-2">
                    <!-- <h5 class="lh-base">We Are pioneers of solar & renewable energy industry</h5> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item second">
                <div class="portfolio-img rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-5.jpg') ?>" alt="">
                    <div class="portfolio-btn">
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                            href="<?= base_url('public/assets/img/img-600x400-5.jpg') ?>" data-lightbox="portfolio"><i
                                class="fa fa-eye"></i></a>
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href=""><i
                                class="fa fa-link"></i></a>
                    </div>
                </div>
                <div class="pt-3">
                    <p class="text-primary mb-0">52kg Steel Gas Cylinder</p>
                    <hr class="text-primary w-25 my-2">
                    <!-- <h5 class="lh-base">We Are pioneers of solar & renewable energy industry</h5> -->
                </div>
            </div>
            <div class="col-lg-4 col-md-6 portfolio-item third">
                <div class="portfolio-img rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-4.jpg') ?>" alt="">
                    <div class="portfolio-btn">
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                            href="<?= base_url('public/assets/img/img-600x400-4.jpg') ?>" data-lightbox="portfolio"><i
                                class="fa fa-eye"></i></a>
                        <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1" href="">
                            <i class="fa fa-link"></i></a>
                    </div>
                </div>
                <div class="pt-3">
                    <p class="text-primary mb-0">6kg Steel Gas Cylinder</p>
                    <hr class="text-primary w-25 my-2">
                    <!-- <h5 class="lh-base">We Are pioneers of solar & renewable energy industry</h5> -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Products End -->

<!-- Fiber Gas Cylinder Benefits Start -->
<?= $this->include('partials/fiber-benefits') ?>
<!-- Fiber Gas Cylinder Benefits End -->
<?= $this->endSection() ?>