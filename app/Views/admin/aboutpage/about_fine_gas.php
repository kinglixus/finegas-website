<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php

$paragraphs = $aboutFineGas['extra_data']['paragraphs'] ?? [];

$getParagraph = function ($index) use ($paragraphs) {

    $value = $paragraphs[$index] ?? '';

    if (is_array($value)) {

        if (isset($value['text'])) {
            return $value['text'];
        }

        return json_encode(
            $value,
            JSON_UNESCAPED_UNICODE
        );
    }

    return $value;
};

?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            About Fine Gas

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/aboutpage') ?>">

                        About Page CMS

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    About Fine Gas

                </li>

            </ol>

        </div>

    </div>

</div>

<div class="row">

    <div class="col-xl-12">

        <div class="card">

            <div class="card-header">

                <div>

                    <h5 class="card-title mb-1">

                        About Fine Gas Section

                    </h5>

                    <p class="text-muted mb-0">

                        Manage the detailed company information displayed on the About page.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/aboutpage/about-fine-gas-update') ?>" method="post">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- TITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                            </label>

                            <input type="text" name="title" class="form-control"
                                value="<?= esc($aboutFineGas['title'] ?? '') ?>">

                        </div>

                        <!-- SUBTITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Subtitle

                            </label>

                            <input type="text" name="subtitle" class="form-control"
                                value="<?= esc($aboutFineGas['subtitle'] ?? '') ?>">

                        </div>

                        <!-- PARAGRAPH 1 -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Paragraph 1

                            </label>

                            <textarea name="paragraph_1" rows="4"
                                class="form-control"><?= esc($getParagraph(0)) ?></textarea>

                        </div>

                        <!-- PARAGRAPH 2 -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Paragraph 2

                            </label>

                            <textarea name="paragraph_2" rows="4"
                                class="form-control"><?= esc($getParagraph(1)) ?></textarea>

                        </div>

                        <!-- PARAGRAPH 3 -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Paragraph 3

                            </label>

                            <textarea name="paragraph_3" rows="4"
                                class="form-control"><?= esc($getParagraph(2)) ?></textarea>

                        </div>

                        <!-- PARAGRAPH 4 -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Paragraph 4

                            </label>

                            <textarea name="paragraph_4" rows="4"
                                class="form-control"><?= esc($getParagraph(3)) ?></textarea>

                        </div>

                        <!-- PARAGRAPH 5 -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Paragraph 5

                            </label>

                            <textarea name="paragraph_5" rows="4"
                                class="form-control"><?= esc($getParagraph(4)) ?></textarea>

                        </div>

                        <!-- PARAGRAPH 6 -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Paragraph 6

                            </label>

                            <textarea name="paragraph_6" rows="4"
                                class="form-control"><?= esc($getParagraph(5)) ?></textarea>

                        </div>

                        <!-- STATUS -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Status

                            </label>

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