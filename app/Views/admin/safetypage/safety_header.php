<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Safety Tips Header

        </h4>

        <p class="text-muted mb-0">

            Manage safety tips section heading.

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

        <form action="<?= base_url('admin/safetypage/safety-header-update') ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Subtitle

                    </label>

                    <input type="text" name="subtitle" class="form-control"
                        value="<?= esc($safety_header['subtitle'] ?? '') ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control"
                        value="<?= esc($safety_header['title'] ?? '') ?>" required>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="4"
                        class="form-control"><?= esc($safety_header['description'] ?? '') ?></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= (($safety_header['status'] ?? 1) == 1) ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= (($safety_header['status'] ?? 1) == 0) ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="feather-save me-2"></i>

                Update Header

            </button>

        </form>

    </div>

</div>

<?= $this->endSection() ?>