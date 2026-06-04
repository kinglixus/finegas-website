<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $title ?? 'Fine Gas - Renewable Energy' ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <?php
    $uri = service('uri')->getPath();
    $seo = match (true) {
        $uri === '' || $uri === '/' => [
            'title' => 'Fine Gas - Premium LPG Gas Supplier in Ghana',
            'keywords' => 'LPG gas, propane, cylinder gas, cooking gas, Ghana gas supplier, Tema gas, fine gas, renewable energy, LPG delivery',
            'description' => 'Fine Gas is a leading LPG gas supplier in Ghana offering premium cooking gas, cylinder refills, and door-to-door delivery services in Tema and surrounding areas.'
        ],
        str_starts_with($uri, 'about') => [
            'title' => 'About Us - Fine Gas Ghana',
            'keywords' => 'about fine gas, company history, LPG Ghana, gas supplierTema, our mission, team, fine gas Ghana',
            'description' => 'Learn about Fine Gas, a trusted LPG gas supplier in Ghana. Our mission is to provide safe, reliable, and efficient gas solutions to homes and businesses across Tema.'
        ],
        str_starts_with($uri, 'service') => [
            'title' => 'LPG Services - Fine Gas Ghana',
            'keywords' => 'LPG services, gas delivery, cylinder refill, cooking gas service, gas installation, Ghana LPG services, commercial gas supply',
            'description' => 'Fine Gas offers comprehensive LPG services including door-to-door gas delivery, cylinder refills, gas installations, and commercial gas supply solutions across Ghana.'
        ],
        str_starts_with($uri, 'product') => [
            'title' => 'LPG Products - Fine Gas Ghana',
            'keywords' => 'LPG products, gas cylinders, propane tanks, cooking gas, 6kg cylinder, 14kg cylinder, gas refills, fine gas products',
            'description' => 'Explore Fine Gas premium LPG products including various cylinder sizes, gas refills, and accessories for residential and commercial use in Ghana.'
        ],
        str_starts_with($uri, 'feature') => [
            'title' => 'Why Choose Fine Gas - Features & Benefits',
            'keywords' => 'why choose fine gas, gas supplier features, safe gas delivery, reliable LPG Ghana, quality assurance, customer benefits',
            'description' => 'Discover why Fine Gas is the preferred LPG supplier in Ghana. We offer safe delivery, quality gas, competitive pricing, and exceptional customer service.'
        ],
        str_starts_with($uri, 'quote') => [
            'title' => 'Get a Quote - Fine Gas Ghana',
            'keywords' => 'get quote, LPG quote, gas price quote, request quote, fine gas pricing, bulk gas quote, Ghana',
            'description' => 'Request a free quote for LPG gas delivery, cylinder refills, or bulk gas supply from Fine Gas. Get competitive pricing for residential and commercial needs.'
        ],
        str_starts_with($uri, 'team') => [
            'title' => 'Our Team - Fine Gas Ghana',
            'keywords' => 'our team, fine gas staff, gas experts, Ghana team, company team, LPG professionals',
            'description' => 'Meet the dedicated team at Fine Gas. Our experienced professionals are committed to providing you with the best LPG solutions and customer service in Ghana.'
        ],
        str_starts_with($uri, 'testimonial') => [
            'title' => 'Customer Reviews - Fine Gas Ghana',
            'keywords' => 'customer reviews, testimonials, client feedback, fine gas reviews, LPG reviews Ghana, customer satisfaction',
            'description' => 'Read what our customers say about Fine Gas. Discover why homeowners and businesses trust us for their LPG gas needs across Ghana.'
        ],
        str_starts_with($uri, 'safety-tips') => [
            'title' => 'Gas Safety Tips - Fine Gas Ghana',
            'keywords' => 'gas safety, LPG safety, safety tips, cylinder safety, gas handling, fire safety, safe gas use, Ghana safety',
            'description' => 'Important safety tips for handling and using LPG gas cylinders. Learn proper storage, usage, and emergency procedures from Fine Gas experts.'
        ],
        str_starts_with($uri, 'contact') => [
            'title' => 'Contact Us - Fine Gas Ghana',
            'keywords' => 'contact fine gas, get in touch, LPG supplier contact, gas delivery contact, Ghana contact, phone, email, address',
            'description' => 'Contact Fine Gas for LPG gas delivery, cylinder refills, or inquiries. Reach us at Tema Community 9 or call +233 209235682 / +233 506617880.'
        ],
        default => [
            'title' => 'Fine Gas - Renewable Energy',
            'keywords' => 'LPG gas, propane, cooking gas, Ghana gas supplier, fine gas',
            'description' => 'Fine Gas - Your trusted LPG gas supplier in Ghana providing premium cooking gas and door-to-door delivery services.'
        ]
    };
    ?>
    <meta name="keywords" content="<?= $seo['keywords'] ?>">
    <meta name="description" content="<?= $seo['description'] ?>">

    <!-- Favicon -->
    <link href="<?= base_url('public/assets/img/thick-logo.png') ?>" rel="icon" sizes="any" type="image/png">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Roboto:wght@500;700;900&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url('public/assets/lib/animate/animate.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/lib/owlcarousel/assets/owl.carousel.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('public/assets/lib/lightbox/css/lightbox.min.css') ?>" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('public/assets/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('public/assets/css/style.css') ?>" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    <?= $this->include('partials/topbar') ?>
    <!-- Topbar End -->

    <?= $this->include('partials/navbar') ?>

    <?= $this->renderSection('content') ?>

    <!-- Geographical Location Start -->
    <?= $this->include('partials/geolocation') ?>
    <!-- Geographical Location End -->

    <!-- Footer Start -->
    <?= $this->include('partials/footer') ?>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i
            class="bi bi-arrow-up"></i></a>

    <!--Scripts and Libraries -->
    <?= $this->include('partials/scripts') ?>

    <!-- Whatsapp Floating Button -->
    <?= $this->include('partials/whatsapp') ?>
</body>

</html>