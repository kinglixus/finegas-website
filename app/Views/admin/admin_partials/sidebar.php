 <nav class="nxl-navigation">
     <div class="navbar-wrapper">
         <div class="m-header">
             <a href="<?= base_url('admin/home') ?>" class="b-brand">
                 <img src="<?= base_url('public/assets_admin/images/logo-full.png') ?>" alt="" class="logo logo-lg" />
                 <img src="<?= base_url('public/assets_admin/images/logo-abbr.png') ?>" alt="" class="logo logo-sm" />
             </a>
         </div>
         <div class="navbar-content">
             <ul class="nxl-navbar">
                 <li class="nxl-item nxl-caption">
                     <label>Navigation</label>
                 </li>
                 <li class="nxl-item nxl-hasmenu">
                     <a href="<?= base_url('admin/home') ?>"
                         class="nxl-link <?= uri_string() == 'admin/home' ? 'active' : '' ?>">
                         <span class="nxl-micon"><i class="feather-airplay"></i></span>
                         <span class="nxl-mtext">Dashboard</span>
                     </a>
                     <!-- <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link" href="index.html">CRM</a></li>
                         <li class="nxl-item"><a class="nxl-link" href="analytics.html">Analytics</a></li>
                     </ul> -->
                 </li>
                 <?php if (can('users.view')):
                    ?>
                 <li class="nxl-item nxl-hasmenu">
                     <a href="javascript:void(0);" class="nxl-link">
                         <span class="nxl-micon"><i class="feather-cast"></i></span>
                         <span class="nxl-mtext">Users</span><span class="nxl-arrow"><i
                                 class="feather-chevron-right"></i></span>
                     </a>
                     <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/users') ?>">All Users</a>
                         </li>
                         <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/users/create') ?>">Add
                                 User</a></li>
                     </ul>
                 </li>
                 <?php endif; ?>

                 <?php if (can('roles.view') && can('permissions.view')): ?>

                 <li class="nxl-item nxl-hasmenu">
                     <a href="javascript:void(0);" class="nxl-link">
                         <span class="nxl-micon"><i class="feather-send"></i></span>
                         <span class="nxl-mtext">Roles and Permissions</span><span class="nxl-arrow"><i
                                 class="feather-chevron-right"></i></span>
                     </a>
                     <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/roles') ?>"><i
                                     class="feather-plus "></i>&nbsp;Add Roles
                             </a>
                         </li>
                         <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/permissions') ?>">
                                 <i class="feather-plus"></i> &nbsp; Add Permissions</a></li>

                     </ul>
                 </li>
                 <?php endif; ?>

                 <li class="nxl-item nxl-hasmenu">
                     <a href="javascript:void(0);" class="nxl-link">
                         <span class="nxl-micon"><i class="feather-at-sign"></i></span>
                         <span class="nxl-mtext">Products</span><span class="nxl-arrow"><i
                                 class="feather-chevron-right"></i></span>
                     </a>
                     <ul class="nxl-submenu">
                         <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/productpage') ?>">Dashboard
                             </a></li>
                         <li class="nxl-item"><a class="nxl-link"
                                 href="<?= base_url('admin/productpage/page-header') ?>">Page Header Section</a></li>
                         </a>
                         <li class="nxl-item"><a class="nxl-link"
                                 href="<?= base_url('admin/productpage/product-header') ?>">Product Header Section</a>
                         </li>
                         </a>
                         <li class="nxl-item"><a class="nxl-link"
                                 href="<?= base_url('admin/productpage/products') ?>">Products Section</a></li>
                         </a>
                         <li class="nxl-item"><a class="nxl-link"
                                 href="<?= base_url('admin/productpage/create-product') ?>">Add Products Section</a>
                         </li>
                         </a>

                 </li>
             </ul>
             </li>
             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-home"></i></span>
                     <span class="nxl-mtext">Home Page</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/homepage/sliders') ?>">Sliders</a>
                     </li>

                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/homepage/createslider') ?>">Create
                             Sliders</a></li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/homepage/statistics') ?>">Statistics</a>
                     </li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/homepage/statistics_create') ?>">Create
                             Statistics</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/homepage/about') ?>">About
                             Section</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/homepage/services') ?>">
                             Services Section</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/homepage/choose-us') ?>">
                             Why Choose Us Section</a></li>
                 </ul>
             </li>
             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-users"></i></span>
                     <span class="nxl-mtext">About Page</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/aboutpage') ?>">
                             Dashboard</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/aboutpage/company-intro')
                                                                    ?>">Company Intro</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/aboutpage/vision') ?>">
                             Vision Section</a>
                     </li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/aboutpage/page-header') ?>">
                             Header Section</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/aboutpage/about-fine-gas') ?>">
                             About Fine Gas Section</a></li>

                 </ul>
             </li>
             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-alert-circle"></i></span>
                     <span class="nxl-mtext">Services Page</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/servicepage/index') ?>">Dashboard</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/servicepage/page-header') ?>">
                             Page Header</a></li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/servicepage/service-header') ?>">
                             Service Header</a></li>
                 </ul>
             </li>
             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-briefcase"></i></span>
                     <span class="nxl-mtext">Contact Page</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/contactpage') ?>">Dashboard
                         </a></li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/contactpage/page-header') ?>">Page Header Section</a></li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/contactpage/contact-intro') ?>">Contact Intro Section</a>
                     </li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/contactpage/contact-info') ?>">Contact Info Section</a>
                     </li>

                 </ul>
             </li>
             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-layout"></i></span>
                     <span class="nxl-mtext">Testimonials</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/testimonialpage') ?>">Dashboard</a></li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/testimonialpage/testimonial') ?>">Testimonials</a></li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/testimonialpage/page-header') ?>">Page Header Section</a>
                     </li>
                     <li class="nxl-item"><a class="nxl-link"
                             href="<?= base_url('admin/testimonialpage/testimonial-header') ?>">Testimonial Header
                             Section</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="widgets-miscellaneous.html">Miscellaneous</a>
                     </li>
                 </ul>
             </li>

             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-layout"></i></span>
                     <span class="nxl-mtext">Team Page</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/teampage') ?>">Dashboard</a>
                     </li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/teampage/page-header') ?>">Page
                             Header Section</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/teampage/members') ?>">Team
                             Members Section</a>
                     </li>
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/teampage/team-header') ?>">Team
                             Header
                             Section</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="widgets-miscellaneous.html">Miscellaneous</a>
                     </li>
                 </ul>
             </li>


             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-layout"></i></span>
                     <span class="nxl-mtext">Contact Messages</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link" href="<?= base_url('admin/contact-messages') ?>">Al
                             Messages</a>
                     </li>
                 </ul>
             </li>

             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-settings"></i></span>
                     <span class="nxl-mtext">Settings</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item">
                         <a href="<?= base_url('admin/settings') ?>" class="nxl-link">
                             <span class="nxl-micon"><i class="feather-settings"></i></span>
                             <span class="nxl-mtext">Settings</span>
                         </a>
                     </li>

                 </ul>
             </li>
             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-power"></i></span>
                     <span class="nxl-mtext">Authentication</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item nxl-hasmenu">
                         <a href="javascript:void(0);" class="nxl-link">
                             <span class="nxl-mtext">Login</span><span class="nxl-arrow"><i
                                     class="feather-chevron-right"></i></span>
                         </a>
                         <ul class="nxl-submenu">
                             <li class="nxl-item"><a class="nxl-link" href="./auth-login-cover.html">Cover</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-login-minimal.html">Minimal</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-login-creative.html">Creative</a>
                             </li>
                         </ul>
                     </li>
                     <li class="nxl-item nxl-hasmenu">
                         <a href="javascript:void(0);" class="nxl-link">
                             <span class="nxl-mtext">Register</span><span class="nxl-arrow"><i
                                     class="feather-chevron-right"></i></span>
                         </a>
                         <ul class="nxl-submenu">
                             <li class="nxl-item"><a class="nxl-link" href="./auth-register-cover.html">Cover</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-register-minimal.html">Minimal</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-register-creative.html">Creative</a>
                             </li>
                         </ul>
                     </li>
                     <li class="nxl-item nxl-hasmenu">
                         <a href="javascript:void(0);" class="nxl-link">
                             <span class="nxl-mtext">Error-404</span><span class="nxl-arrow"><i
                                     class="feather-chevron-right"></i></span>
                         </a>
                         <ul class="nxl-submenu">
                             <li class="nxl-item"><a class="nxl-link" href="./auth-404-cover.html">Cover</a></li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-404-minimal.html">Minimal</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-404-creative.html">Creative</a>
                             </li>
                         </ul>
                     </li>
                     <li class="nxl-item nxl-hasmenu">
                         <a href="javascript:void(0);" class="nxl-link">
                             <span class="nxl-mtext">Reset Pass</span><span class="nxl-arrow"><i
                                     class="feather-chevron-right"></i></span>
                         </a>
                         <ul class="nxl-submenu">
                             <li class="nxl-item"><a class="nxl-link" href="./auth-reset-cover.html">Cover</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-reset-minimal.html">Minimal</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-reset-creative.html">Creative</a>
                             </li>
                         </ul>
                     </li>
                     <li class="nxl-item nxl-hasmenu">
                         <a href="javascript:void(0);" class="nxl-link">
                             <span class="nxl-mtext">Verify OTP</span><span class="nxl-arrow"><i
                                     class="feather-chevron-right"></i></span>
                         </a>
                         <ul class="nxl-submenu">
                             <li class="nxl-item"><a class="nxl-link" href="./auth-verify-cover.html">Cover</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-verify-minimal.html">Minimal</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-verify-creative.html">Creative</a>
                             </li>
                         </ul>
                     </li>
                     <li class="nxl-item nxl-hasmenu">
                         <a href="javascript:void(0);" class="nxl-link">
                             <span class="nxl-mtext">Maintenance</span><span class="nxl-arrow"><i
                                     class="feather-chevron-right"></i></span>
                         </a>
                         <ul class="nxl-submenu">
                             <li class="nxl-item"><a class="nxl-link" href="./auth-maintenance-cover.html">Cover</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link" href="./auth-maintenance-minimal.html">Minimal</a>
                             </li>
                             <li class="nxl-item"><a class="nxl-link"
                                     href="./auth-maintenance-creative.html">Creative</a></li>
                         </ul>
                     </li>
                 </ul>
             </li>
             <li class="nxl-item nxl-hasmenu">
                 <a href="javascript:void(0);" class="nxl-link">
                     <span class="nxl-micon"><i class="feather-life-buoy"></i></span>
                     <span class="nxl-mtext">Help Center</span><span class="nxl-arrow"><i
                             class="feather-chevron-right"></i></span>
                 </a>
                 <ul class="nxl-submenu">
                     <li class="nxl-item"><a class="nxl-link" href="#!">Support</a></li>
                     <li class="nxl-item"><a class="nxl-link" href="help-knowledgebase.html">KnowledgeBase</a>
                     </li>
                     <li class="nxl-item"><a class="nxl-link" href="/docs/documentations">Documentations</a></li>
                 </ul>
             </li>
             </ul>

         </div>
     </div>
 </nav>