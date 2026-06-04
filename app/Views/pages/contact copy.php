<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">
            <?= esc($page_header['title'] ?? 'Contact Us') ?>
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
                        <a class="text-white" href="<?= base_url('/') ?>">Home</a>
                    </li>
                    <li class="breadcrumb-item text-white active" aria-current="page">
                        Contact
                    </li>
                <?php endif; ?>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->


<!-- Contact Start -->
<style>
    @media (max-width: 576px) {
        .contact-info .btn-lg-square {
            width: 40px;
            height: 40px;
            min-width: 40px;
            font-size: 14px;
        }
    }

    .form-error {
        color: #dc3545;
        font-size: 13px;
        margin-top: 6px;
        display: none;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
    }

    .contact-alert {
        display: none;
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 20px;
        font-weight: 500;
    }

    .contact-alert.success {
        display: block;
        background: #d1e7dd;
        color: #0f5132;
        border: 1px solid #badbcc;
    }

    .contact-alert.error {
        display: block;
        background: #f8d7da;
        color: #842029;
        border: 1px solid #f5c2c7;
    }

    .contact-form-wrapper {
        position: relative;
    }

    .contact-overlay {
        position: absolute;
        inset: 0;
        background: rgba(255, 255, 255, 0.86);
        z-index: 10;
        display: none;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
    }

    .contact-overlay.active {
        display: flex;
    }

    .contact-spinner {
        width: 46px;
        height: 46px;
        border: 4px solid #ddd;
        border-top-color: var(--bs-primary);
        border-radius: 50%;
        animation: contactSpin 0.8s linear infinite;
    }

    @keyframes contactSpin {
        to {
            transform: rotate(360deg);
        }
    }
</style>

<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">

            <!-- Contact Info -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <h6 class="text-primary">
                    <?= esc($contact_intro['subtitle'] ?? 'Contact Us') ?>
                </h6>

                <h1 class="mb-4">
                    <?= esc($contact_intro['title'] ?? 'Get In Touch For LPG Cylinder Services') ?>
                </h1>

                <?php if (!empty($contact_intro['description'])): ?>
                    <p class="mb-4">
                        <?= esc($contact_intro['description']) ?>
                    </p>
                <?php endif; ?>

                <?php if (!empty($contact_info)): ?>
                    <div class="row contact-info">
                        <?php foreach ($contact_info as $info): ?>
                            <?php
                            $lines = [];

                            if (!empty($info['extra_data']['multiple_lines'])) {
                                $lines = explode('|', $info['description'] ?? '');
                            } else {
                                $lines = [$info['description'] ?? ''];
                            }
                            ?>

                            <div class="col-12 col-md-6">
                                <div class="d-flex align-items-center mb-4">
                                    <div class="btn-lg-square bg-primary rounded-circle me-3">
                                        <i class="<?= esc($info['icon'] ?? 'fa fa-info') ?> text-white"></i>
                                    </div>

                                    <div>
                                        <h5 class="mb-1">
                                            <?= esc($info['title'] ?? '') ?>
                                        </h5>

                                        <?php foreach ($lines as $line): ?>
                                            <?php if (trim($line) !== ''): ?>
                                                <p class="mb-0">
                                                    <?= esc(trim($line)) ?>
                                                </p>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>

                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>


            <!-- Contact Form -->
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <div class="contact-form-wrapper">

                    <div id="contactOverlay" class="contact-overlay">
                        <div class="text-center">
                            <div class="contact-spinner mx-auto mb-3"></div>
                            <div class="fw-bold text-primary">Sending message...</div>
                        </div>
                    </div>

                    <div id="contactAlert" class="contact-alert"></div>

                    <form id="contactForm" method="post" action="<?= base_url('contact/submit') ?>" novalidate>
                        <?= csrf_field() ?>

                        <div class="row g-3">

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Your Name">
                                    <label for="name">Your Name</label>
                                </div>
                                <div class="form-error" data-error-for="name"></div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Your Email">
                                    <label for="email">Your Email</label>
                                </div>
                                <div class="form-error" data-error-for="email"></div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="location" name="location"
                                        placeholder="Your Location">
                                    <label for="location">Your Location</label>
                                </div>
                                <div class="form-error" data-error-for="location"></div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subject" name="subject"
                                        placeholder="Subject">
                                    <label for="subject">Subject</label>
                                </div>
                                <div class="form-error" data-error-for="subject"></div>
                            </div>

                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a message here" id="message"
                                        name="message" style="height: 150px"></textarea>
                                    <label for="message">Message</label>
                                </div>
                                <div class="form-error" data-error-for="message"></div>
                            </div>

                            <div class="col-12">
                                <button id="contactSubmitBtn" class="btn btn-primary rounded-pill py-3 px-5"
                                    type="submit">
                                    Send Message
                                </button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
<!-- Contact End -->


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('contactForm');
        const alertBox = document.getElementById('contactAlert');
        const overlay = document.getElementById('contactOverlay');
        const submitBtn = document.getElementById('contactSubmitBtn');

        if (!form) {
            return;
        }

        function showAlert(type, message) {
            alertBox.className = 'contact-alert ' + type;
            alertBox.textContent = message;
            alertBox.style.display = 'block';
        }

        function hideAlert() {
            alertBox.className = 'contact-alert';
            alertBox.textContent = '';
            alertBox.style.display = 'none';
        }

        function showOverlay() {
            overlay.classList.add('active');
            submitBtn.disabled = true;
        }

        function hideOverlay() {
            overlay.classList.remove('active');
            submitBtn.disabled = false;
        }

        function clearErrors() {
            form.querySelectorAll('.form-control').forEach(function(input) {
                input.classList.remove('is-invalid');
            });

            form.querySelectorAll('.form-error').forEach(function(errorBox) {
                errorBox.textContent = '';
                errorBox.style.display = 'none';
            });
        }

        function showErrors(errors) {
            Object.keys(errors).forEach(function(field) {
                const input = form.querySelector('[name="' + field + '"]');
                const errorBox = form.querySelector('[data-error-for="' + field + '"]');

                if (input) {
                    input.classList.add('is-invalid');
                }

                if (errorBox) {
                    errorBox.textContent = errors[field];
                    errorBox.style.display = 'block';
                }
            });
        }

        function validateInline() {
            clearErrors();

            const errors = {};
            const name = form.name.value.trim();
            const email = form.email.value.trim();
            const location = form.location.value.trim();
            const subject = form.subject.value.trim();
            const message = form.message.value.trim();

            if (name.length < 2) {
                errors.name = 'Please enter your name.';
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(email)) {
                errors.email = 'Please enter a valid email address.';
            }

            if (location.length < 2) {
                errors.location = 'Please enter your location.';
            }

            if (subject.length < 3) {
                errors.subject = 'Please enter a subject.';
            }

            if (message.length < 10) {
                errors.message = 'Please enter a message of at least 10 characters.';
            }

            if (Object.keys(errors).length > 0) {
                showErrors(errors);
                showAlert('error', 'Please correct the highlighted fields.');
                return false;
            }

            return true;
        }

        form.addEventListener('input', function(event) {
            const field = event.target.getAttribute('name');

            if (!field) {
                return;
            }

            const errorBox = form.querySelector('[data-error-for="' + field + '"]');

            event.target.classList.remove('is-invalid');

            if (errorBox) {
                errorBox.textContent = '';
                errorBox.style.display = 'none';
            }
        });

        form.addEventListener('submit', function(event) {
            event.preventDefault();

            hideAlert();

            if (!validateInline()) {
                return;
            }

            showOverlay();

            fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(async function(response) {
                    const data = await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    return data;
                })
                .then(function(data) {
                    if (data.status) {
                        form.reset();
                        clearErrors();
                        showAlert('success', data.message ||
                            'Your message has been sent successfully.');
                    } else {
                        showAlert('error', data.message || 'Unable to send message.');
                    }
                })
                .catch(function(error) {
                    if (error && error.errors) {
                        showErrors(error.errors);
                    }

                    showAlert('error', error.message || 'Something went wrong. Please try again.');
                })
                .finally(function() {
                    hideOverlay();
                });
        });
    });
</script>

<?= $this->endSection() ?>