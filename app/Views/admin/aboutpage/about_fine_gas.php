<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php

$paragraphs = $aboutFineGas['extra_data']['paragraphs'] ?? [];

$getParagraphText = function ($index) use ($paragraphs) {
    $value = $paragraphs[$index] ?? '';

    if (is_array($value)) {
        return $value['text'] ?? '';
    }

    return $value;
};

$getParagraphLinkText = function ($index) use ($paragraphs) {
    $value = $paragraphs[$index] ?? [];

    if (is_array($value) && !empty($value['link']['text'])) {
        return $value['link']['text'];
    }

    return '';
};

$getParagraphLinkUrl = function ($index) use ($paragraphs) {
    $value = $paragraphs[$index] ?? [];

    if (is_array($value) && !empty($value['link']['url'])) {
        return $value['link']['url'];
    }

    return '';
};

?>

<div class="page-header">
    <div class="page-header-left">
        <h4 class="page-title">About Fine Gas</h4>

        <div class="page-header-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/home') ?>">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/aboutpage') ?>">About Page CMS</a>
                </li>
                <li class="breadcrumb-item active">About Fine Gas</li>
            </ol>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">

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
            <div class="card-header">
                <div>
                    <h5 class="card-title mb-1">About Fine Gas Section</h5>
                    <p class="text-muted mb-0">
                        Manage the detailed company information displayed on the About page.
                    </p>
                </div>
            </div>

            <div class="card-body">
                <form action="<?= base_url('admin/aboutpage/about-fine-gas-update') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="row">

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control"
                                value="<?= esc($aboutFineGas['title'] ?? '') ?>">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control"
                                value="<?= esc($aboutFineGas['subtitle'] ?? '') ?>">
                        </div>

                        <?php for ($i = 1; $i <= 6; $i++): ?>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">
                                    Paragraph <?= $i ?>
                                </label>

                                <textarea name="paragraph_<?= $i ?>" rows="4"
                                    class="form-control"><?= esc($getParagraphText($i - 1)) ?></textarea>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Paragraph <?= $i ?> Link Text
                                </label>

                                <input type="text" name="link_text_<?= $i ?>" class="form-control"
                                    value="<?= esc($getParagraphLinkText($i - 1)) ?>"
                                    placeholder="Ghana Standards Authority">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">
                                    Paragraph <?= $i ?> Link URL
                                </label>

                                <input type="text" name="link_url_<?= $i ?>" class="form-control"
                                    value="<?= esc($getParagraphLinkUrl($i - 1)) ?>" placeholder="https://gsa.gov.gh/">
                            </div>
                        <?php endfor; ?>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Status</label>

                            <select name="status" class="form-select">
                                <option value="1" <?= ($aboutFineGas['status'] ?? 1) == 1 ? 'selected' : '' ?>>
                                    Active
                                </option>
                                <option value="0" <?= ($aboutFineGas['status'] ?? 1) == 0 ? 'selected' : '' ?>>
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                    <hr>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="feather-save me-2"></i>
                            Save About Fine Gas
                        </button>

                        <a href="<?= base_url('admin/aboutpage') ?>" class="btn btn-light">
                            Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection() ?>