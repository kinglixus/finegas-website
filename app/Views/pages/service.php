<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>



<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">
            <?= esc($page_header['title'] ?? 'Our Services') ?>
        </h1>

        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">

                <?php if (!empty($page_header['extra_data']['breadcrumbs'])): ?>

                    <?php foreach ($page_header['extra_data']['breadcrumbs'] as $breadcrumb): ?>

                        <?php if (!empty($breadcrumb['url'])): ?>
                            <li class="breadcrumb-item">
                                <a class="text-white" href="<?= base_url($breadcrumb['url']) ?>">
                                    <?= esc($breadcrumb['label'] ?? '') ?>
                                </a>
                            </li>
                        <?php else: ?>
                            <li class="breadcrumb-item text-white active" aria-current="page">
                                <?= esc($breadcrumb['label'] ?? '') ?>
                            </li>
                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php else: ?>

                    <li class="breadcrumb-item">
                        <a class="text-white" href="<?= base_url() ?>">Home</a>
                    </li>

                    <li class="breadcrumb-item text-white active" aria-current="page">
                        Services
                    </li>

                <?php endif; ?>

            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">

        <?php if (!empty($service_header)): ?>
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

                <h6 class="text-primary">
                    <?= esc($service_header['subtitle'] ?? 'Our Services') ?>
                </h6>

                <h1 class="mb-4">
                    <?= esc($service_header['title'] ?? 'We Are Pioneers In The World Of Renewable Energy') ?>
                </h1>

            </div>
        <?php endif; ?>

        <?php if (!empty($services)): ?>
            <div class="row g-4">

                <?php foreach ($services as $index => $service): ?>
                    <?php
                    $delay = 0.1 + (($index % 3) * 0.2);
                    ?>

                    <div class="col-md-6 col-lg-4 wow fadeInUp" data-wow-delay="<?= esc(number_format($delay, 1)) ?>s">

                        <div class="service-item rounded overflow-hidden">

                            <?php if (!empty($service['image'])): ?>
                                <img class="img-fluid" src="<?= base_url($service['image']) ?>"
                                    alt="<?= esc($service['title'] ?? '') ?>">
                            <?php endif; ?>

                            <div class="position-relative p-4 pt-0">

                                <?php if (!empty($service['icon'])): ?>
                                    <div class="service-icon">
                                        <i class="<?= esc($service['icon']) ?> fa-3x"></i>
                                    </div>
                                <?php endif; ?>

                                <h4 class="mb-3">
                                    <?= esc($service['title'] ?? '') ?>
                                </h4>

                                <?php if (!empty($service['description'])): ?>
                                    <p>
                                        <?= nl2br(esc($service['description'])) ?>
                                    </p>
                                <?php endif; ?>

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
        <?php endif; ?>

    </div>
</div>
<!-- Service End -->

<?= $this->endSection() ?>