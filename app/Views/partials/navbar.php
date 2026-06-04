<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0">
    <a href="<?= base_url() ?>" class="navbar-brand d-flex align-items-center border-end px-4 px-lg-5">
        <img src="<?= base_url('public/assets/img/thick-logo.png') ?>" alt="Fine Gas" style="height: 75px;">
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="<?= base_url() ?>" class="nav-item nav-link <?= uri_string() == '' ? 'active' : '' ?>">Home</a>
            <a href="<?= base_url('about') ?>" class="nav-item nav-link <?= uri_string() == 'about' ? 'active' : '' ?>">About</a>
            <a href="<?= base_url('service') ?>" class="nav-item nav-link <?= uri_string() == 'service' ? 'active' : '' ?>">Service</a>
            <a href="<?= base_url('product') ?>" class="nav-item nav-link <?= uri_string() == 'product' ? 'active' : '' ?>">Product</a>
            <a href="<?= base_url('team') ?>" class="nav-item nav-link <?= uri_string() == 'team' ? 'active' : '' ?>">Our Team</a>
            <a href="<?= base_url('testimonial') ?>" class="nav-item nav-link <?= uri_string() == 'testimonial' ? 'active' : '' ?>">Testimonial</a>
            <a href="<?= base_url('contact') ?>" class="nav-item nav-link <?= uri_string() == 'contact' ? 'active' : '' ?>">Contact</a>
        </div>
        <a href="<?= base_url('safety-tips') ?>" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Cylinder Safety Tips<i class="fa fa-arrow-right ms-3"></i></a>
    </div>
</nav>
<!-- Navbar End -->
