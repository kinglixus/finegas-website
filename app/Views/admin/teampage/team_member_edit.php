<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<?php
$member = $teamMember ?? $team_member ?? [];
$extraData = $member['extra_data'] ?? [];

if (is_string($extraData)) {
    $decoded = json_decode($extraData, true);
    $extraData = is_array($decoded) ? $decoded : [];
}

$socialLinks = $extraData['social_links'] ?? [];
?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Edit Team Member

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/teampage') ?>">

                        Team Page CMS

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/teampage/team-members') ?>">

                        Team Members

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Edit

                </li>

            </ol>

        </div>

    </div>

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

<?php if (session()->getFlashdata('errors')): ?>

    <div class="alert alert-danger">

        <ul class="mb-0">

            <?php foreach (session()->getFlashdata('errors') as $error): ?>

                <li><?= esc($error) ?></li>

            <?php endforeach; ?>

        </ul>

    </div>

<?php endif; ?>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Edit Team Member

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/teampage/update-team-member/' . ($member['id'] ?? '')) ?>" method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Member Name

                    </label>

                    <input type="text" name="title" class="form-control"
                        value="<?= esc(old('title') ?? ($member['title'] ?? '')) ?>" required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Position / Role

                    </label>

                    <input type="text" name="subtitle" class="form-control"
                        value="<?= esc(old('subtitle') ?? ($member['subtitle'] ?? '')) ?>" required>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Short Bio / Description

                    </label>

                    <textarea name="description" rows="5"
                        class="form-control"><?= esc(old('description') ?? ($member['description'] ?? '')) ?></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Current Photo

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= !empty($member['image'])
                                                        ? base_url($member['image'])
                                                        : base_url('assets/img/team-1.jpg') ?>" class="img-thumbnail"
                            style="width:140px;height:140px;object-fit:cover;border-radius:50%;"
                            alt="<?= esc($member['title'] ?? 'Team Member') ?>">

                    </div>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Change Photo

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                    <small class="text-muted">

                        Recommended size: 600 x 600 or square image.

                    </small>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Facebook URL

                    </label>

                    <input type="text" name="facebook" class="form-control"
                        value="<?= esc(old('facebook') ?? ($socialLinks['facebook'] ?? '')) ?>"
                        placeholder="https://facebook.com/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Twitter / X URL

                    </label>

                    <input type="text" name="twitter" class="form-control"
                        value="<?= esc(old('twitter') ?? ($socialLinks['twitter'] ?? '')) ?>"
                        placeholder="https://twitter.com/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        LinkedIn URL

                    </label>

                    <input type="text" name="linkedin" class="form-control"
                        value="<?= esc(old('linkedin') ?? ($socialLinks['linkedin'] ?? '')) ?>"
                        placeholder="https://linkedin.com/in/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Instagram URL

                    </label>

                    <input type="text" name="instagram" class="form-control"
                        value="<?= esc(old('instagram') ?? ($socialLinks['instagram'] ?? '')) ?>"
                        placeholder="https://instagram.com/...">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" class="form-control"
                        value="<?= esc(old('sort_order') ?? ($member['sort_order'] ?? 0)) ?>">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= ((old('status') ?? ($member['status'] ?? 1)) == 1) ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= ((old('status') ?? ($member['status'] ?? 1)) == 0) ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">

                    <i class="feather-save me-2"></i>

                    Update Team Member

                </button>

                <a href="<?= base_url('admin/teampage/team-members') ?>" class="btn btn-light">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (!file) {
            return;
        }

        const reader = new FileReader();

        reader.onload = function(event) {
            document.getElementById('imagePreview').src = event.target.result;
        };

        reader.readAsDataURL(file);
    });
</script>

<?= $this->endSection() ?>