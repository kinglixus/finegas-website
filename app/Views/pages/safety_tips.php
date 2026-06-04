<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">Safety Tips</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item text-white active" aria-current="page">Safety Tips</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- Safety Tips Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Safety Tips</h6>
            <h1 class="mb-4">Gas Cylinder Safety Tips</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i>Check for Leaks</h5>
                    <p>Always check for gas leaks before using your cylinder. Use soapy water to detect leaks - if bubbles form, there's a leak.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.2s">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i>Proper Ventilation</h5>
                    <p>Ensure your gas cylinder is stored in a well-ventilated area. Never store cylinders in enclosed spaces.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i>Keep Away from Heat</h5>
                    <p>Store cylinders away from direct heat sources, electrical outlets, and open flames.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.4s">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i>Regular Inspection</h5>
                    <p>Have your cylinders inspected regularly by professionals. Replace damaged or expired cylinders immediately.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i>Proper Handling</h5>
                    <p>Always handle cylinders with care. Never drop or drag cylinders. Use proper lifting techniques.</p>
                </div>
            </div>
            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.6s">
                <div class="bg-light rounded p-4">
                    <h5 class="mb-3"><i class="fa fa-check-circle text-primary me-2"></i>Emergency Preparedness</h5>
                    <p>Keep a fire extinguisher nearby and know emergency contact numbers. Have an evacuation plan ready.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Safety Tips End -->

<!-- Emergency Contacts Start -->
<div class="container-xxl py-5 bg-light">
    <div class="container">
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h6 class="text-primary">Emergency Contacts</h6>
            <h1 class="mb-4">Ghana National Fire Service</h1>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="bg-white rounded p-4 shadow-sm text-center wow fadeInUp" data-wow-delay="0.2s">
                    <i class="fa fa-phone-alt fa-3x text-primary mb-4"></i>
                    <h4 class="mb-4">Call Immediately in Case of Fire or Gas Emergency</h4>
                    <div class="row g-4 justify-content-center mb-4">
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
                    </div>
                    <a href="<?= base_url('safety-tips/more') ?>" class="btn btn-primary rounded-pill py-3 px-5">Read More Safety Tips</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Emergency Contacts End -->

<?= $this->endSection() ?>
