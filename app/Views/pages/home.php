<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Carousel Start -->
<?php if (!empty($sliders)): ?>
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

            <?php foreach ($sliders as $index => $slider): ?>
                <div class="owl-carousel-item position-relative" data-dot="<img src='<?= base_url(esc($slider['image'])) ?>'>">

                    <img class="img-fluid w-100 carousel-img" src="<?= base_url(esc($slider['image'])) ?>"
                        alt="<?= esc($slider['title']) ?>">

                    <div class="owl-carousel-inner">

                        <div class="container <?= $index == 2 ? 'py-6' : '' ?>">

                            <div class="row justify-content-start <?= $index == 2 ? 'align-items-center' : '' ?>"
                                <?= $index == 2 ? 'style="min-height: 450px;"' : '' ?>>

                                <div class="col-10 col-lg-8 <?= $index == 2 ? 'pb-5' : '' ?>">

                                    <h4 class="display-4 text-white animated slideInDown <?= $index == 2 ? 'mb-4' : '' ?>">
                                        <?= esc($slider['title']) ?>
                                    </h4>

                                    <?php if (!empty($slider['description'])): ?>
                                        <p class="fs-5 fw-medium text-white mb-4 <?= $index == 2 ? '' : 'pb-3' ?>">
                                            <?= esc($slider['description']) ?>
                                        </p>
                                    <?php endif; ?>

                                    <?php if (!empty($slider['button_text'])): ?>
                                        <a href="<?= !empty($slider['button_url']) ? esc($slider['button_url']) : '#' ?>"
                                            class="btn btn-primary rounded-pill py-3 px-5 animated slideInLeft">
                                            <?= esc($slider['button_text']) ?>
                                        </a>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    </div>
<?php endif; ?>
<!-- Carousel End -->


<!-- Feature Start -->
<?php if (!empty($statistics)): ?>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">

                <?php foreach ($statistics as $index => $stat): ?>
                    <?php
                    $delay = 0.1 + ($index * 0.2);
                    $number = $stat['subtitle'] ?? ($stat['extra_data']['number'] ?? 0);
                    ?>

                    <div class="col-md-6 col-lg-3 wow fadeIn" data-wow-delay="<?= esc(number_format($delay, 1)) ?>s">
                        <div class="d-flex align-items-center mb-4">
                            <div class="btn-lg-square bg-primary rounded-circle me-3">
                                <i class="<?= esc($stat['icon']) ?> text-white"></i>
                            </div>
                            <h1 class="mb-0" data-toggle="counter-up">
                                <?= esc($number) ?>
                            </h1>
                        </div>

                        <h5 class="mb-3"><?= esc($stat['title']) ?></h5>

                        <?php if (!empty($stat['description'])): ?>
                            <span><?= esc($stat['description']) ?></span>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
<?php endif; ?>
<!-- Feature End -->


<!-- About Start -->
<?php if (!empty($about)): ?>
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container about px-lg-0">
            <div class="row g-0 mx-lg-0">

                <div class="col-lg-6 ps-lg-0 wow fadeIn" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute img-fluid w-100 h-100" src="<?= base_url(esc($about['image'])) ?>"
                            style="object-fit: cover;" alt="<?= esc($about['title']) ?>">
                    </div>
                </div>

                <div class="col-lg-6 about-text py-5 wow fadeIn" data-wow-delay="0.5s">
                    <div class="p-lg-5 pe-lg-0">

                        <h6 class="text-primary">
                            <?= esc($about['subtitle'] ?? 'About Us') ?>
                        </h6>

                        <h1 class="mb-4">
                            <?= esc($about['title']) ?>
                        </h1>

                        <p class="mb-4">
                            <?= esc($about['description']) ?>
                        </p>

                        <?php if (!empty($about['extra_data']['points'])): ?>
                            <?php foreach ($about['extra_data']['points'] as $point): ?>
                                <p>
                                    <i class="<?= esc($point['icon'] ?? 'fa fa-check-circle') ?> text-primary me-3"></i>
                                    <?= esc($point['text'] ?? '') ?>
                                </p>
                            <?php endforeach; ?>
                        <?php endif; ?>

                        <?php if (!empty($about['button_text'])): ?>
                            <a href="<?= base_url($about['button_url'] ?? '#') ?>"
                                class="btn btn-primary rounded-pill py-3 px-5 mt-3">
                                <?= esc($about['button_text']) ?>
                            </a>
                        <?php endif; ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
<!-- About End -->


<!-- Service Start -->
<?php if (!empty($services)): ?>
    <div class="container-xxl py-5">
        <div class="container">

            <?php if (!empty($services_header)): ?>
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h6 class="text-primary">
                        <?= esc($services_header['subtitle'] ?? 'Our Services') ?>
                    </h6>

                    <h1 class="mb-4">
                        <?= esc($services_header['title']) ?>
                    </h1>
                </div>
            <?php endif; ?>

            <div class="row g-4">

                <?php foreach ($services as $index => $service): ?>
                    <?php
                    $delay = 0.1 + (($index % 3) * 0.2);
                    ?>

                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="<?= esc(number_format($delay, 1)) ?>s">
                        <div class="service-item rounded overflow-hidden">

                            <img class="img-fluid" src="<?= base_url(esc($service['image'])) ?>"
                                alt="<?= esc($service['title']) ?>">

                            <div class="position-relative p-4 pt-0">

                                <?php if (!empty($service['icon'])): ?>
                                    <div class="service-icon">
                                        <i class="<?= esc($service['icon']) ?> fa-3x"></i>
                                    </div>
                                <?php endif; ?>

                                <h4 class="mb-3">
                                    <?= esc($service['title']) ?>
                                </h4>

                                <p>
                                    <?= esc($service['description']) ?>
                                </p>

                                <?php if (!empty($service['button_text'])): ?>
                                    <a class="small fw-medium"
                                        href="<?= !empty($service['button_url']) ? esc($service['button_url']) : '#' ?>">
                                        <?= esc($service['button_text']) ?>
                                        <i class="fa fa-arrow-right ms-2"></i>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
<?php endif; ?>
<!-- Service End -->


<!-- Feature Start -->
<?php if (!empty($choose_us)): ?>
    <div class="container-fluid bg-light overflow-hidden my-5 px-lg-0">
        <div class="container feature px-lg-0">
            <div class="row g-0 mx-lg-0">

                <!-- TEXT SECTION -->
                <div class="col-lg-6 feature-text py-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="p-lg-5 ps-lg-0">

                        <h6 class="text-primary text-uppercase">
                            <?= esc($choose_us['subtitle'] ?? 'Why Choose Fine Gas') ?>
                        </h6>

                        <h1 class="mb-4">
                            <?= esc($choose_us['title']) ?>
                        </h1>

                        <p class="mb-4 pb-2">
                            <?= esc($choose_us['description']) ?>
                        </p>

                        <?php if (!empty($choose_us['extra_data']['items'])): ?>
                            <div class="row g-4">

                                <?php foreach ($choose_us['extra_data']['items'] as $item): ?>
                                    <div class="col-6">
                                        <div class="d-flex align-items-center">

                                            <div class="btn-lg-square bg-primary rounded-circle">
                                                <i class="<?= esc($item['icon'] ?? 'fa fa-check') ?> text-white"></i>
                                            </div>

                                            <div class="ms-4">
                                                <p class="mb-0">
                                                    <?= esc($item['small_title'] ?? '') ?>
                                                </p>

                                                <h5 class="mb-0">
                                                    <?= esc($item['main_title'] ?? '') ?>
                                                </h5>
                                            </div>

                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- IMAGE SECTION -->
                <div class="col-lg-6 pe-lg-0 wow fadeIn" data-wow-delay="0.5s" style="min-height: 400px;">

                    <div class="position-relative h-100">

                        <img class="position-absolute img-fluid w-100 h-100" src="<?= base_url(esc($choose_us['image'])) ?>"
                            style="object-fit: cover;"
                            alt="<?= esc($choose_us['extra_data']['image_alt'] ?? $choose_us['title']) ?>">

                    </div>

                </div>

            </div>
        </div>
    </div>
<?php endif; ?>
<!-- Feature End -->

<?= $this->endSection() ?>