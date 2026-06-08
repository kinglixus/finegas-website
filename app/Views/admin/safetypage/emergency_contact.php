<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$extraData = $emergency_contact['extra_data'] ?? [];
$contacts = $extraData['contacts'] ?? [];

$contact1 = $contacts[0] ?? [];
$contact2 = $contacts[1] ?? [];
$contact3 = $contacts[2] ?? [];
?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Emergency Contact

        </h4>

        <p class="text-muted mb-0">

            Manage emergency contact box and numbers.

        </p>

    </div>

    <a href="<?= base_url('admin/safetypage') ?>" class="btn btn-light">

        Back

    </a>

</div>

<?php if (session()->getFlashdata('success')): ?>

    <div class="alert alert-success">

        <?= esc(session()->getFlashdata('success')) ?>

    </div>

<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>

    <div class="alert alert-danger">

        <?= esc(session()->getFlashdata('error')) ?>

    </div>

<?php endif; ?>

<div class="card">

    <div class="card-body">

        <form action="<?= base_url('admin/safetypage/emergency-contact-update') ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Main Title

                    </label>

                    <input type="text" name="title" class="form-control"
                        value="<?= esc($emergency_contact['title'] ?? '') ?>" required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon

                    </label>

                    <input type="text" name="icon" id="icon" class="form-control"
                        value="<?= esc($emergency_contact['icon'] ?? 'fa fa-phone-alt') ?>">

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="4"
                        class="form-control"><?= esc($emergency_contact['description'] ?? '') ?></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Button Text

                    </label>

                    <input type="text" name="button_text" class="form-control"
                        value="<?= esc($emergency_contact['button_text'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Button URL

                    </label>

                    <input type="text" name="button_url" class="form-control"
                        value="<?= esc($emergency_contact['button_url'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Box Background Color

                    </label>

                    <input type="text" name="box_background" class="form-control"
                        value="<?= esc($extraData['box_background'] ?? '#395555') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Box Text Color

                    </label>

                    <input type="text" name="box_text_color" class="form-control"
                        value="<?= esc($extraData['box_text_color'] ?? '#ffffff') ?>">

                </div>

            </div>

            <hr>

            <h5 class="mb-3">

                Emergency Numbers

            </h5>

            <div class="row">

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 1 Label

                    </label>

                    <input type="text" name="contact_label_1" class="form-control"
                        value="<?= esc($contact1['label'] ?? 'Toll Free') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 1 Number

                    </label>

                    <input type="text" name="contact_number_1" class="form-control"
                        value="<?= esc($contact1['number'] ?? '192') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 1 Heading Tag

                    </label>

                    <select name="heading_tag_1" class="form-select">

                        <option value="h2" <?= (($contact1['heading_tag'] ?? 'h2') == 'h2') ? 'selected' : '' ?>>h2
                        </option>
                        <option value="h4" <?= (($contact1['heading_tag'] ?? 'h2') == 'h4') ? 'selected' : '' ?>>h4
                        </option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 2 Label

                    </label>

                    <input type="text" name="contact_label_2" class="form-control"
                        value="<?= esc($contact2['label'] ?? 'Hotline 1') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 2 Number

                    </label>

                    <input type="text" name="contact_number_2" class="form-control"
                        value="<?= esc($contact2['number'] ?? '0302-684-468') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 2 Heading Tag

                    </label>

                    <select name="heading_tag_2" class="form-select">

                        <option value="h2" <?= (($contact2['heading_tag'] ?? 'h4') == 'h2') ? 'selected' : '' ?>>h2
                        </option>
                        <option value="h4" <?= (($contact2['heading_tag'] ?? 'h4') == 'h4') ? 'selected' : '' ?>>h4
                        </option>

                    </select>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 3 Label

                    </label>

                    <input type="text" name="contact_label_3" class="form-control"
                        value="<?= esc($contact3['label'] ?? 'Hotline 2') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 3 Number

                    </label>

                    <input type="text" name="contact_number_3" class="form-control"
                        value="<?= esc($contact3['number'] ?? '0505-760-855') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Contact 3 Heading Tag

                    </label>

                    <select name="heading_tag_3" class="form-select">

                        <option value="h2" <?= (($contact3['heading_tag'] ?? 'h4') == 'h2') ? 'selected' : '' ?>>h2
                        </option>
                        <option value="h4" <?= (($contact3['heading_tag'] ?? 'h4') == 'h4') ? 'selected' : '' ?>>h4
                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= (($emergency_contact['status'] ?? 1) == 1) ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= (($emergency_contact['status'] ?? 1) == 0) ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon Preview

                    </label>

                    <div class="border rounded p-3 text-center">

                        <i id="iconPreview"
                            class="<?= esc($emergency_contact['icon'] ?? 'fa fa-phone-alt') ?> text-primary"
                            style="font-size:40px;"></i>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="feather-save me-2"></i>

                Update Emergency Contact

            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    $('#icon').on('keyup change', function() {
        $('#iconPreview').attr('class', $(this).val() + ' text-primary');
    });
</script>

<?= $this->endSection() ?>