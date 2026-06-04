<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">

        <h1 class="display-3 text-white mb-3 animated slideInDown">
            <?= esc($page_header['title'] ?? 'Testimonials') ?>
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
                <?php endif; ?>

            </ol>
        </nav>

    </div>
</div>
<!-- Page Header End -->


<!-- Testimonial Start -->
<div class="container-xxl py-5">
    <div class="container">

        <?php if (!empty($testimonial_header)): ?>
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

                <h6 class="text-primary">
                    <?= esc($testimonial_header['subtitle'] ?? '') ?>
                </h6>

                <h1 class="mb-4">
                    <?= esc($testimonial_header['title'] ?? '') ?>
                </h1>

            </div>
        <?php endif; ?>

        <?php if (!empty($testimonials)): ?>
            <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">

                <?php foreach ($testimonials as $testimonial): ?>
                    <div class="testimonial-item text-center">

                        <div class="testimonial-img position-relative">

                            <?php if (!empty($testimonial['image'])): ?>
                                <img class="img-fluid rounded-circle mx-auto mb-5" src="<?= base_url(esc($testimonial['image'])) ?>"
                                    alt="<?= esc($testimonial['title'] ?? '') ?>">
                            <?php endif; ?>

                            <div class="btn-square bg-primary rounded-circle">
                                <i class="<?= esc($testimonial['icon'] ?? 'fa fa-quote-left') ?> text-white"></i>
                            </div>

                        </div>

                        <div class="testimonial-text text-center rounded p-4">

                            <?php if (!empty($testimonial['description'])): ?>
                                <p>
                                    <?= esc($testimonial['description']) ?>
                                </p>
                            <?php endif; ?>

                            <h5 class="mb-1">
                                <?= esc($testimonial['title'] ?? '') ?>
                            </h5>

                            <span class="fst-italic">
                                <?= esc($testimonial['subtitle'] ?? '') ?>
                            </span>

                        </div>

                    </div>
                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</div>
<!-- Testimonial End -->

<?= $this->endSection() ?>