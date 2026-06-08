<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">

        <h1 class="display-3 text-white mb-3 animated slideInDown">
            <?= esc($page_header['title'] ?? 'Our Team') ?>
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
                        <a class="text-white" href="<?= base_url() ?>">
                            Home
                        </a>
                    </li>

                    <li class="breadcrumb-item text-white active" aria-current="page">
                        Team
                    </li>

                <?php endif; ?>

            </ol>
        </nav>

    </div>
</div>
<!-- Page Header End -->


<!-- Team Start -->
<div class="container-xxl py-5">
    <div class="container">

        <?php if (!empty($team_header)): ?>
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">

                <h6 class="text-primary">
                    <?= esc($team_header['subtitle'] ?? 'Team Member') ?>
                </h6>

                <h1 class="mb-4">
                    <?= esc($team_header['title'] ?? 'Experienced Team Members') ?>
                </h1>

                <?php if (!empty($team_header['description'])): ?>
                    <p class="mb-0">
                        <?= esc($team_header['description']) ?>
                    </p>
                <?php endif; ?>

            </div>
        <?php endif; ?>

        <?php if (!empty($team_members)): ?>

            <div class="row g-4">

                <?php foreach ($team_members as $index => $member): ?>

                    <?php
                    $delay = 0.1 + (($index % 3) * 0.2);

                    $socialLinks = $member['extra_data']['social_links'] ?? [];

                    if (empty($socialLinks) && !empty($member['extra_data'])) {
                        $socialLinks = [];

                        if (!empty($member['extra_data']['facebook'])) {
                            $socialLinks[] = [
                                'icon' => 'fab fa-facebook-f',
                                'url'  => $member['extra_data']['facebook'],
                            ];
                        }

                        if (!empty($member['extra_data']['twitter'])) {
                            $socialLinks[] = [
                                'icon' => 'fab fa-twitter',
                                'url'  => $member['extra_data']['twitter'],
                            ];
                        }

                        if (!empty($member['extra_data']['linkedin'])) {
                            $socialLinks[] = [
                                'icon' => 'fab fa-linkedin-in',
                                'url'  => $member['extra_data']['linkedin'],
                            ];
                        }

                        if (!empty($member['extra_data']['instagram'])) {
                            $socialLinks[] = [
                                'icon' => 'fab fa-instagram',
                                'url'  => $member['extra_data']['instagram'],
                            ];
                        }
                    }
                    ?>

                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="<?= esc(number_format($delay, 1)) ?>s">

                        <div class="team-item rounded overflow-hidden h-100">

                            <div class="d-flex">

                                <?php if (!empty($member['image'])): ?>

                                    <img class="img-fluid w-75" src="<?= base_url($member['image']) ?>"
                                        alt="<?= esc($member['title'] ?? '') ?>">

                                <?php else: ?>

                                    <img class="img-fluid w-75" src="<?= base_url('public/assets/img/team-1.jpg') ?>"
                                        alt="<?= esc($member['title'] ?? '') ?>">

                                <?php endif; ?>

                                <div class="team-social w-25">

                                    <?php if (!empty($socialLinks)): ?>

                                        <?php foreach ($socialLinks as $social): ?>

                                            <?php if (!empty($social['url'])): ?>
                                                <a class="btn btn-lg-square btn-outline-primary rounded-circle mt-3"
                                                    href="<?= esc($social['url']) ?>" target="_blank">
                                                    <i class="<?= esc($social['icon'] ?? 'fab fa-facebook-f') ?>"></i>
                                                </a>
                                            <?php endif; ?>

                                        <?php endforeach; ?>

                                    <?php endif; ?>

                                </div>

                            </div>

                            <div class="p-4">

                                <h5 class="mb-1">
                                    <?= esc($member['title'] ?? '') ?>
                                </h5>

                                <span class="text-primary d-block mb-3">
                                    <?= esc($member['subtitle'] ?? '') ?>
                                </span>

                                <?php if (!empty($member['description'])): ?>

                                    <p class="mb-0 text-muted">
                                        <?= esc(mb_strimwidth($member['description'], 0, 150, '...')) ?>
                                    </p>

                                <?php endif; ?>

                            </div>

                        </div>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endif; ?>

    </div>
</div>
<!-- Team End -->

<?= $this->endSection() ?>