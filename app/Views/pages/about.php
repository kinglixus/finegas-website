<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5">
    <div class="container py-5">

        <h1 class="display-3 text-white mb-3 animated slideInDown">
            <?= esc($page_header['title'] ?? 'About Us') ?>
        </h1>

        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb">

                <?php if (!empty($page_header['extra_data']['breadcrumbs'])): ?>

                    <?php foreach ($page_header['extra_data']['breadcrumbs'] as $breadcrumb): ?>

                        <?php if (!empty($breadcrumb['url'])): ?>
                            <li class="breadcrumb-item">
                                <a class="text-white" href="<?= esc($breadcrumb['url']) ?>">
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
                        <a class="text-white" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="text-white" href="#">Pages</a>
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page">About</li>

                <?php endif; ?>

            </ol>
        </nav>

    </div>
</div>
<!-- Page Header End -->


<!-- Company Intro Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">

            <div class="col-lg-12 wow fadeInUp" data-wow-delay="0.1s">

                <div class="text-center mx-auto mb-4" style="max-width: 800px;">

                    <h6 class="text-primary">
                        <?= esc($company_intro['subtitle'] ?? 'Welcome to FINE GAS') ?>
                    </h6>

                    <h1 class="mb-4">
                        <?= esc($company_intro['title'] ?? 'Your Trusted LPG Cylinder Distribution Partner') ?>
                    </h1>

                </div>

                <p class="text-justify mb-0" style="font-size: 1.1rem; line-height: 1.8;">

                    <?php if (!empty($company_intro['extra_data']['highlight_text'])): ?>
                        <span class="text-primary fw-bold">
                            <?= esc($company_intro['extra_data']['highlight_text']) ?>
                        </span>
                    <?php endif; ?>

                    <?= esc($company_intro['description'] ?? 'is a leading LPG cylinder distribution company committed to delivering safe, reliable, and convenient gas solutions to homes and businesses. Through our certified filling plant and customer-focused approach, we eliminate the hassle of queuing for refills by bringing quality fibre cylinders directly to your doorstep. Our operations align with Ghana\'s Cylinder Recirculation Model (CRM), ensuring the highest standards of safety, accurate measurement, and transparent pricing for all our customers.') ?>

                </p>

            </div>

        </div>
    </div>
</div>
<!-- Company Intro End -->


<!-- About Start -->
<div class="container-fluid bg-light overflow-hidden py-5">
    <div class="container">
        <div class="row g-2 align-items-stretch">

            <!-- Vision Card -->
            <div class="col-12 col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="bg-white p-3 p-md-5 h-100 rounded shadow-sm border-end border-primary border-3">

                    <h6 class="text-primary">
                        <?= esc($vision['subtitle'] ?? 'Our Vision') ?>
                    </h6>

                    <h1 class="mb-4">
                        <?= esc($vision['title'] ?? 'Supporting Ghana\'s Cylinder Recirculation Model') ?>
                    </h1>

                    <p class="mb-4">
                        <?php if (!empty($vision['description'])): ?>
                            <?= $vision['description'] ?>
                        <?php else: ?>
                            <strong>Our Vision:</strong> To be Ghana's most trusted LPG distribution company,
                            revolutionizing access to clean energy through safe, innovative, and customer-centric cylinder
                            distribution services that align with national safety standards and improve quality of life for
                            households and businesses.
                        <?php endif; ?>
                    </p>

                </div>
            </div>


            <!-- About Fine Gas Card -->
            <div class="col-12 col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="bg-white p-3 p-md-5 h-100 rounded shadow-sm border-end border-primary border-3">

                    <h6 class="text-primary">
                        <?= esc($about_fine_gas['subtitle'] ?? '') ?>
                    </h6>

                    <h1 class="mb-4">
                        <?= esc($about_fine_gas['title'] ?? '') ?>
                    </h1>

                    <?php if (!empty($about_fine_gas['extra_data']['paragraphs'])): ?>

                        <?php foreach ($about_fine_gas['extra_data']['paragraphs'] as $paragraph): ?>

                            <?php
                            $text = $paragraph['text'] ?? '';
                            $link = $paragraph['link'] ?? null;
                            ?>

                            <?php if (!empty($link['text']) && !empty($link['url'])): ?>

                                <?php
                                $safeText     = esc($text);
                                $safeLinkText = esc($link['text']);
                                $safeLinkUrl  = esc($link['url']);

                                $linkedText = str_replace(
                                    $safeLinkText,
                                    '<a href="' . $safeLinkUrl . '" target="_blank">' . $safeLinkText . '</a>',
                                    $safeText
                                );
                                ?>

                                <p><?= $linkedText ?></p>

                            <?php else: ?>

                                <p><?= esc($text) ?></p>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php endif; ?>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- About End -->


<?= $this->endSection() ?>