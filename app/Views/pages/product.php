<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">

        <h1 class="display-3 text-white mb-3 animated slideInDown">
            <?= esc($page_header['title'] ?? 'Our Products') ?>
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


<!-- Products Start -->
<div class="container-xxl py-5">
    <div class="container">

        <?php if (!empty($product_header)): ?>
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

                <h6 class="text-primary">
                    <?= esc($product_header['subtitle'] ?? '') ?>
                </h6>

                <h1 class="mb-4">
                    <?= esc($product_header['title'] ?? '') ?>
                </h1>

            </div>
        <?php endif; ?>

        <?php if (!empty($products)): ?>
            <div class="row g-4 portfolio-container wow fadeInUp" data-wow-delay="0.5s">

                <?php foreach ($products as $product): ?>
                    <?php
                    $filterClass   = $product['extra_data']['filter_class'] ?? 'first';
                    $lightboxImage = $product['extra_data']['lightbox_image'] ?? $product['image'];
                    $showPreview   = $product['extra_data']['show_preview'] ?? true;
                    $showLink      = $product['extra_data']['show_link'] ?? true;
                    ?>

                    <div class="col-lg-4 col-md-6 portfolio-item <?= esc($filterClass) ?>">

                        <div class="portfolio-img rounded overflow-hidden">

                            <?php if (!empty($product['image'])): ?>
                                <img class="img-fluid" src="<?= base_url(esc($product['image'])) ?>"
                                    alt="<?= esc($product['title'] ?? '') ?>">
                            <?php endif; ?>

                            <div class="portfolio-btn">

                                <?php if ($showPreview): ?>
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                                        href="<?= base_url(esc($lightboxImage)) ?>" data-lightbox="portfolio">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                <?php endif; ?>

                                <?php if ($showLink): ?>
                                    <a class="btn btn-lg-square btn-outline-light rounded-circle mx-1"
                                        href="<?= !empty($product['button_url']) ? esc($product['button_url']) : '#' ?>">
                                        <i class="fa fa-link"></i>
                                    </a>
                                <?php endif; ?>

                            </div>

                        </div>

                        <div class="pt-3">
                            <p class="text-primary mb-0">
                                <?= esc($product['title'] ?? '') ?>
                            </p>

                            <hr class="text-primary w-25 my-2">

                            <?php if (!empty($product['description'])): ?>
                                <h5 class="lh-base">
                                    <?= esc($product['description']) ?>
                                </h5>
                            <?php endif; ?>
                        </div>

                    </div>

                <?php endforeach; ?>

            </div>
        <?php endif; ?>

    </div>
</div>
<!-- Products End -->


<!-- Fiber Gas Cylinder Benefits Start -->
<?= $this->include('partials/fiber-benefits') ?>
<!-- Fiber Gas Cylinder Benefits End -->

<?= $this->endSection() ?>