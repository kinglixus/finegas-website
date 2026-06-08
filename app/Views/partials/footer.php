 <div class="container-fluid bg-dark text-body footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
     <div class="container py-5">
         <div class="row g-5">
             <div class="col-lg-3 col-md-6 text-center">
                 <h5 class="text-white mb-4">Address</h5>
                 <div class="text-start d-inline-block">
                     <p class="mb-2"><i class="fa fa-map-marker-alt me-2"></i>Tema, Community 9</p>
                     <p class="mb-2"><i class="fa fa-phone-alt me-2"></i>+233 209235682</p>
                     <p class="mb-2"><i class="fa fa-phone-alt me-2"></i>+233 506617880</p>
                     <p class="mb-2"><i class="fa fa-envelope me-2"></i>info@finegasgh.com</p>
                     <div class="d-flex pt-2 justify-content-center">
                         <a class="btn btn-square btn-outline-light btn-social me-2" href=""><i
                                 class="fab fa-twitter"></i></a>
                         <a class="btn btn-square btn-outline-light btn-social me-2" href=""><i
                                 class="fab fa-facebook-f"></i></a>
                         <a class="btn btn-square btn-outline-light btn-social me-2" href=""><i
                                 class="fab fa-youtube"></i></a>
                         <a class="btn btn-square btn-outline-light btn-social" href=""><i
                                 class="fab fa-linkedin-in"></i></a>
                     </div>
                 </div>
             </div>
             <div class="col-lg-3 col-md-6">
                 <h5 class="text-white mb-4">Quick Links</h5>
                 <a class="btn btn-link" href="<?= base_url('about') ?>">About Us</a>
                 <a class="btn btn-link" href="<?= base_url('contact') ?>">Contact Us</a>
                 <a class="btn btn-link" href="<?= base_url('service') ?>">Our Services</a>
                 <a class="btn btn-link" href="">Terms & Condition</a>
                 <a class="btn btn-link" href="">Support</a>
             </div>
             <div class="col-lg-3 col-md-6">
                 <h5 class="text-white mb-4">Useful Links</h5>
                 <a class="btn btn-link" href="<?= base_url('about') ?>">About Us</a>
                 <a class="btn btn-link" href="<?= base_url('contact') ?>">Contact Us</a>
                 <a class="btn btn-link" href="<?= base_url('service') ?>">Our Services</a>
                 <a class="btn btn-link" href="">Terms & Condition</a>
                 <a class="btn btn-link" href="">Support</a>
             </div>
             <?= $this->include('partials/newsletter') ?>
         </div>
     </div>
     <div class="container">
         <div class="copyright">
             <div class="row">
                 <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                     &copy;<a href="#">finegas</a>, All Right Reserved <?= date('Y') ?> | Designed By <a
                         href="https://htmlcodex.com">Fine Gas Team</a>
                 </div>

             </div>
         </div>
     </div>
 </div>