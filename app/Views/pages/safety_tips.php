<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">

    <div class="container text-center py-5">

        <h1 class="display-3 text-white mb-3 animated slideInDown">

            <?= esc($page_header['title'] ?? 'Safety Tips') ?>

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

                                <?= esc($breadcrumb['label'] ?? 'Safety Tips') ?>

                            </li>

                        <?php endif; ?>

                    <?php endforeach; ?>

                <?php else: ?>

                    <li class="breadcrumb-item">

                        <a class="text-white" href="<?= base_url() ?>">

                            Home

                        </a>

                    </li>

                    <li class="breadcrumb-item text-white active" aria-current="page">

                        Safety Tips

                    </li>

                <?php endif; ?>

            </ol>

        </nav>

    </div>

</div>
<!-- Page Header End -->


<!-- Safety Tips Start -->
<div class="container-xxl py-5">

    <div class="container">

        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

            <h6 class="text-primary">

                <?= esc($safety_header['subtitle'] ?? 'Safety Tips') ?>

            </h6>

            <h1 class="mb-4">

                <?= esc($safety_header['title'] ?? 'Gas Cylinder Safety Tips') ?>

            </h1>

            <?php if (!empty($safety_header['description'])): ?>

                <p>

                    <?= esc($safety_header['description']) ?>

                </p>

            <?php endif; ?>

        </div>

        <div class="row g-4">

            <?php if (!empty($safety_tips)): ?>

                <?php foreach ($safety_tips as $index => $tip): ?>

                    <?php
                    $delay = $tip['extra_data']['animation_delay'] ?? (0.1 + (($index % 6) * 0.1)) . 's';
                    ?>

                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="<?= esc($delay) ?>">

                        <div class="bg-light rounded p-4 h-100">

                            <h5 class="mb-3">

                                <i class="<?= esc($tip['icon'] ?? 'fa fa-check-circle') ?> text-primary me-2"></i>

                                <?= esc($tip['title'] ?? '') ?>

                            </h5>

                            <p class="mb-0">

                                <?= esc($tip['description'] ?? '') ?>

                            </p>

                        </div>

                    </div>

                <?php endforeach; ?>

            <?php else: ?>

                <div class="col-12">

                    <div class="alert alert-info text-center">

                        No safety tips available.

                    </div>

                </div>

            <?php endif; ?>

        </div>

    </div>

</div>
<!-- Safety Tips End -->


<!-- Emergency Contacts Start -->
<div class="container-xxl py-5 bg-light">

    <div class="container">

        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

            <h6 class="text-primary">

                <?= esc($emergency_header['subtitle'] ?? 'Emergency Contacts') ?>

            </h6>

            <h1 class="mb-4">

                <?= esc($emergency_header['title'] ?? 'Ghana National Fire Service') ?>

            </h1>

            <?php if (!empty($emergency_header['description'])): ?>

                <p>

                    <?= esc($emergency_header['description']) ?>

                </p>

            <?php endif; ?>

        </div>

        <div class="row justify-content-center">

            <div class="col-lg-8">

                <div class="bg-white rounded p-4 shadow-sm text-center wow fadeInUp" data-wow-delay="0.2s">

                    <i class="<?= esc($emergency_contact['icon'] ?? 'fa fa-phone-alt') ?> fa-3x text-primary mb-4"></i>

                    <h4 class="mb-4">

                        <?= esc($emergency_contact['title'] ?? 'Call Immediately in Case of Fire or Gas Emergency') ?>

                    </h4>

                    <?php if (!empty($emergency_contact['description'])): ?>

                        <p>

                            <?= esc($emergency_contact['description']) ?>

                        </p>

                    <?php endif; ?>

                    <?php
                    $contacts = $emergency_contact['extra_data']['contacts'] ?? [];

                    $boxBackground = $emergency_contact['extra_data']['box_background'] ?? '#395555';
                    $boxTextColor  = $emergency_contact['extra_data']['box_text_color'] ?? '#ffffff';
                    ?>

                    <div class="row g-4 justify-content-center mb-4">

                        <?php if (!empty($contacts)): ?>

                            <?php foreach ($contacts as $contact): ?>

                                <div class="col-md-4">

                                    <div class="text-white rounded p-3"
                                        style="background-color: <?= esc($boxBackground, 'attr') ?>; color: <?= esc($boxTextColor, 'attr') ?>;">

                                        <h5 class="mb-0" style="color: <?= esc($boxTextColor, 'attr') ?>;">

                                            <?= esc($contact['label'] ?? '') ?>

                                        </h5>

                                        <?php if (($contact['heading_tag'] ?? 'h4') === 'h2'): ?>

                                            <h2 class="mb-0 mt-2" style="color: <?= esc($boxTextColor, 'attr') ?>;">

                                                <?= esc($contact['number'] ?? '') ?>

                                            </h2>

                                        <?php else: ?>

                                            <h4 class="mb-0 mt-2" style="color: <?= esc($boxTextColor, 'attr') ?>;">

                                                <?= esc($contact['number'] ?? '') ?>

                                            </h4>

                                        <?php endif; ?>

                                    </div>

                                </div>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <div class="col-md-4">

                                <div class="text-white rounded p-3" style="background-color: #395555; color: #ffffff;">

                                    <h5 class="mb-0" style="color: #ffffff;">Toll Free</h5>

                                    <h2 class="mb-0 mt-2" style="color: #ffffff;">192</h2>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="text-white rounded p-3" style="background-color: #395555; color: #ffffff;">

                                    <h5 class="mb-0" style="color: #ffffff;">Hotline 1</h5>

                                    <h4 class="mb-0 mt-2" style="color: #ffffff;">0302-684-468</h4>

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="text-white rounded p-3" style="background-color: #395555; color: #ffffff;">

                                    <h5 class="mb-0" style="color: #ffffff;">Hotline 2</h5>

                                    <h4 class="mb-0 mt-2" style="color: #ffffff;">0505-760-855</h4>

                                </div>

                            </div>

                        <?php endif; ?>

                    </div>

                    <?php if (!empty($emergency_contact['button_text'])): ?>

                        <a href="<?= base_url($emergency_contact['button_url'] ?? 'safety-tips/more') ?>"
                            class="btn btn-primary rounded-pill py-3 px-5">

                            <?= esc($emergency_contact['button_text']) ?>

                        </a>

                    <?php endif; ?>

                </div>

            </div>

        </div>

    </div>

</div>
<!-- Emergency Contacts End -->

<?= $this->endSection() ?>