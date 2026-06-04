<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Carousel Start -->
<div class="container-fluid p-0 pb-5 wow fadeIn carousel-section" data-wow-delay="0.1s">
    <style>
    @media (max-width: 991px) {

        .carousel-section p,
        .carousel-section .btn {
            display: none !important;
        }

        .carousel-section .owl-carousel-inner {
            position: absolute;
            bottom: 20px;
            left: 0;
            right: 0;
            padding: 0 !important;
        }

        .carousel-section .owl-carousel-inner .container {
            padding: 0 15px !important;
        }

        .carousel-section .owl-carousel-inner .container.py-6 {
            padding: 0 15px !important;
        }

        .carousel-section .owl-carousel-inner .row {
            min-height: auto !important;
        }

        .carousel-section .owl-carousel-inner h4 {
            font-size: 24px !important;
            line-height: 1.3 !important;
            margin-bottom: 0 !important;
            margin-top: 15%;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);
        }


    }

    @media (max-width: 991px) {

        .carousel-section .owl-carousel-item {
            min-height: auto !important;
        }

        .carousel-section .owl-carousel-item img {
            height: auto !important;
            object-fit: cover;
        }

        .carousel-section .owl-carousel-inner {
            bottom: 10px !important;
        }

        .carousel-section .container,
        .carousel-section .row,
        .carousel-section .col-10 {
            padding-bottom: 0 !important;
            margin-bottom: 0 !important;
            min-height: auto !important;
        }

        .carousel-section h4 {
            margin-bottom: 0 !important;
        }
    }
    </style>

    <div class="owl-carousel header-carousel position-relative">

        <!-- SLIDE 1 -->
        <div class="owl-carousel-item position-relative"
            data-dot="<img src='<?= base_url('public/assets/img/carousel-1.jpg') ?>'>">

            <img class="img-fluid w-100 carousel-img" src="<?= base_url('public/assets/img/carousel-1.jpg') ?>" alt="">

            <div class="owl-carousel-inner">

                <div class="container">

                    <div class="row justify-content-start">

                        <div class="col-10 col-lg-8">

                            <h4 class="display-4 text-white animated slideInDown">
                                Reliable LPG Cylinder Distribution Services
                            </h4>

                            <p class="fs-5 fw-medium text-white mb-4 pb-3">
                                Fine Gas Ghana provides safe, fast, and reliable LPG cylinder
                                distribution services for homes, restaurants, and businesses
                                across Tema and surrounding communities.
                            </p>

                            <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">
                                Read More
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- SLIDE 2 -->
        <div class="owl-carousel-item position-relative"
            data-dot="<img src='<?= base_url('public/assets/img/carousel-2.jpg') ?>'>">

            <img class="img-fluid w-100 carousel-img" src="<?= base_url('public/assets/img/carousel-2.jpg') ?>" alt="">

            <div class="owl-carousel-inner">

                <div class="container">

                    <div class="row justify-content-start">

                        <div class="col-10 col-lg-8">

                            <h4 class="display-4 text-white animated slideInDown">
                                Safe & Certified Gas Cylinder Solutions
                            </h4>

                            <p class="fs-5 fw-medium text-white mb-4 pb-3">
                                We are committed to delivering high-quality LPG cylinders
                                with safety, reliability, and customer satisfaction as our
                                top priorities.
                            </p>

                            <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">
                                Read More
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- SLIDE 3 -->
        <div class="owl-carousel-item position-relative"
            data-dot="<img src='<?= base_url('public/assets/img/carousel-3.jpg') ?>'>">

            <img class="img-fluid w-100 carousel-img" src="<?= base_url('public/assets/img/carousel-3.jpg') ?>" alt="">

            <div class="owl-carousel-inner">

                <div class="container py-6">

                    <div class="row justify-content-start align-items-center" style="min-height: 450px;">

                        <div class="col-10 col-lg-8 pb-5">

                            <h4 class="display-4 text-white animated slideInDown mb-4">
                                Trusted Energy Partner For Homes & Businesses
                            </h4>

                            <p class="fs-5 fw-medium text-white mb-4">
                                From LPG cylinder refilling to fast delivery services,
                                Fine Gas Ghana provides dependable energy solutions tailored
                                to meet your everyday needs.
                            </p>

                            <a href="" class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">
                                Read More
                            </a>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- Carousel End -->

<!-- Feature Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.1s">
                <div class="d-flex align-items-center mb-4">
                    <div class="btn-lg-square bg-primary rounded-circle me-3">
                        <i class="fa fa-users text-white"></i>
                    </div>
                    <h1 class="mb-0" data-toggle="counter-up">3453</h1>
                </div>
                <h5 class="mb-3">Happy Customers</h5>
                <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.3s">
                <div class="d-flex align-items-center mb-4">
                    <div class="btn-lg-square bg-primary rounded-circle me-3">
                        <i class="fa fa-check text-white"></i>
                    </div>
                    <h1 class="mb-0" data-toggle="counter-up">4234</h1>
                </div>
                <h5 class="mb-3">Project Done</h5>
                <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.5s">
                <div class="d-flex align-items-center mb-4">
                    <div class="btn-lg-square bg-primary rounded-circle me-3">
                        <i class="fa fa-award text-white"></i>
                    </div>
                    <h1 class="mb-0" data-toggle="counter-up">3123</h1>
                </div>
                <h5 class="mb-3">Awards Win</h5>
                <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
            </div>
            <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="0.7s">
                <div class="d-flex align-items-center mb-4">
                    <div class="btn-lg-square bg-primary rounded-circle me-3">
                        <i class="fa fa-users-cog text-white"></i>
                    </div>
                    <h1 class="mb-0" data-toggle="counter-up">1831</h1>
                </div>
                <h5 class="mb-3">Expert Workers</h5>
                <span>Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit</span>
            </div>
        </div>
    </div>
</div>
<!-- Feature End -->

<!-- About Start -->
<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
    <div class="container about px-lg-0">
        <div class="row g-0 mx-lg-0">
            <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute img-fluid w-100 h-100"
                        src="<?= base_url('public/assets/img/about.jpg') ?>" style="object-fit: cover;" alt="">
                </div>
            </div>
            <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                <div class="p-lg-5 pe-lg-0">
                    <h6 class="text-primary">About Us</h6>
                    <h1 class="mb-4">Your Trusted LPG Cylinder Distribution Partner</h1>
                    <p class="mb-4">FINE GAS is a leading LPG cylinder distribution company committed to delivering
                        safe, reliable, and convenient gas solutions to homes and businesses across Ghana.</p>
                    <p><i class="fa fa-check-circle text-primary me-3"></i>Certified filling plant with GSA-approved
                        cylinders</p>
                    <p><i class="fa fa-check-circle text-primary me-3"></i>Door-to-door delivery eliminating long queues
                    </p>
                    <p><i class="fa fa-check-circle text-primary me-3"></i>Aligned with Ghana's Cylinder Recirculation
                        Model (CRM)</p>
                    <p><i class="fa fa-check-circle text-primary me-3"></i>Accurate measurement & transparent pricing
                    </p>
                    <a href="<?= base_url('/about') ?>" class="btn btn-primary rounded-pill py-3 px-5 mt-3">Explore
                        More</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->

<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Our Services</h6>
            <h1 class="mb-4">We Are Pioneers In The World Of Renewable Energy</h1>
        </div>
        <div class="row g-4">
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-1.jpg') ?>" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa fa-solar-panel fa-3x"></i>
                        </div>
                        <h4 class="mb-3">Solar Panels</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="small fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-2.jpg') ?>" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa fa-wind fa-3x"></i>
                        </div>
                        <h4 class="mb-3">Wind Turbines</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="small fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-3.jpg') ?>" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa fa-lightbulb fa-3x"></i>
                        </div>
                        <h4 class="mb-3">Hydropower Plants</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="small fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.1s">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-4.jpg') ?>" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa fa-solar-panel fa-3x"></i>
                        </div>
                        <h4 class="mb-3">Solar Panels</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="small fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.3s">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-5.jpg') ?>" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa fa-wind fa-3x"></i>
                        </div>
                        <h4 class="mb-3">Wind Turbines</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="small fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="0.5s">
                <div class="service-item rounded overflow-hidden">
                    <img class="img-fluid" src="<?= base_url('public/assets/img/img-600x400-6.jpg') ?>" alt="">
                    <div class="position-relative p-4 pt-0">
                        <div class="service-icon">
                            <i class="fa fa-lightbulb fa-3x"></i>
                        </div>
                        <h4 class="mb-3">Hydropower Plants</h4>
                        <p>Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.</p>
                        <a class="small fw-medium" href="">Read More<i class="fa fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Service End -->

<!-- Feature Start -->
<div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
    <div class="container feature px-lg-0">
        <div class="row g-0 mx-lg-0">

            <!-- TEXT SECTION -->
            <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                <div class="p-lg-5 ps-lg-0">

                    <h6 class="text-primary text-uppercase">Why Choose Fine Gas</h6>

                    <h1 class="mb-4">
                        Reliable LPG Cylinder Distribution Services For Homes & Businesses
                    </h1>

                    <p class="mb-4 pb-2">
                        Fine Gas provides safe, reliable, and efficient LPG cylinder distribution
                        services across Tema and surrounding areas. We are committed to delivering
                        quality gas solutions for households, restaurants, shops, industries, and
                        commercial facilities with fast delivery and trusted customer support.
                    </p>

                    <div class="row g-4">

                        <!-- Safe & Quality Cylinders -->
                        <div class="col-6">
                            <div class="d-flex align-items-center">

                                <div class="btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-shield-alt text-white"></i>
                                </div>

                                <div class="ms-4">
                                    <p class="mb-0">Safe & Certified</p>
                                    <h5 class="mb-0">Gas Cylinders</h5>
                                </div>

                            </div>
                        </div>

                        <!-- Fast Delivery -->
                        <div class="col-6">
                            <div class="d-flex align-items-center">

                                <div class="btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-truck text-white"></i>
                                </div>

                                <div class="ms-4">
                                    <p class="mb-0">Fast & Reliable</p>
                                    <h5 class="mb-0">Delivery Service</h5>
                                </div>

                            </div>
                        </div>

                        <!-- Professional Team -->
                        <div class="col-6">
                            <div class="d-flex align-items-center">

                                <div class="btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-users text-white"></i>
                                </div>

                                <div class="ms-4">
                                    <p class="mb-0">Professional</p>
                                    <h5 class="mb-0">Support Team</h5>
                                </div>

                            </div>
                        </div>

                        <!-- Customer Support -->
                        <div class="col-6">
                            <div class="d-flex align-items-center">

                                <div class="btn-lg-square bg-primary rounded-circle">
                                    <i class="fa fa-headset text-white"></i>
                                </div>

                                <div class="ms-4">
                                    <p class="mb-0">24/7 Customer</p>
                                    <h5 class="mb-0">Support</h5>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- IMAGE SECTION -->
            <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">

                <div class="position-relative h-100">

                    <img class="position-absolute img-fluid w-100 h-100"
                        src="<?= base_url('public/assets/img/feature.jpg') ?>" style="object-fit: cover;"
                        alt="Fine Gas Cylinder Distribution">

                </div>

            </div>

        </div>
    </div>
</div>
<!-- Feature End -->


<!-- Quote Start -->
<!-- <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
    <div class="container quote px-lg-0">
        <div class="row g-0 mx-lg-0">
            <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                <div class="position-relative h-100">
                    <img class="position-absolute img-fluid w-100 h-100"
                        src="<?= base_url('public/assets/img/quote.jpg') ?>" style="object-fit: cover;" alt="">
                </div>
            </div>
            <div class="col-lg-6 quote-text py-5 wow fadeIn" data-wow-delay="0.5s">
                <div class="p-lg-5 pe-lg-0">
                    <h6 class="text-primary">Free Quote</h6>
                    <h1 class="mb-4">Get A Free Quote</h1>
                    <p class="mb-4 pb-2">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet
                        diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo erat amet</p>
                    <form>
                        <div class="row g-3">
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Your Name"
                                    style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="email" class="form-control border-0" placeholder="Your Email"
                                    style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <input type="text" class="form-control border-0" placeholder="Your Mobile"
                                    style="height: 55px;">
                            </div>
                            <div class="col-12 col-sm-6">
                                <select class="form-select border-0" style="height: 55px;">
                                    <option selected>Select A Service</option>
                                    <option value="1">Service 1</option>
                                    <option value="2">Service 2</option>
                                    <option value="3">Service 3</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea class="form-control border-0" placeholder="Special Note"></textarea>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary rounded-pill py-3 px-5" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!-- Quote End -->

<?= $this->endSection() ?>