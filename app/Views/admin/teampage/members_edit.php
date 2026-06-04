<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Edit Team Member

        </h4>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title mb-0">

            Team Member Information

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/teampage/update-member/' . $member['id']) ?>" method="post"
            enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <!-- MEMBER NAME -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Member Name

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($member['title']) ?>" required>

                </div>

                <!-- POSITION -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Position

                    </label>

                    <input type="text" name="subtitle" class="form-control" value="<?= esc($member['subtitle']) ?>">

                </div>

                <!-- CURRENT PHOTO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Current Photo

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= !empty($member['image'])
                                                        ? base_url($member['image'])
                                                        : base_url('assets/admin/images/no-image.png') ?>" class="img-thumbnail" style="
                                width:120px;
                                height:120px;
                                object-fit:cover;
                                border-radius:50%;
                            ">

                    </div>

                </div>

                <!-- CHANGE PHOTO -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Change Photo

                    </label>

                    <input type="file" name="image" id="image" class="form-control" accept="image/*">

                </div>

                <!-- FACEBOOK -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Facebook URL

                    </label>

                    <input type="url" name="facebook" class="form-control"
                        value="<?= esc($member['extra_data']['facebook'] ?? '') ?>">

                </div>

                <!-- TWITTER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Twitter URL

                    </label>

                    <input type="url" name="twitter" class="form-control"
                        value="<?= esc($member['extra_data']['twitter'] ?? '') ?>">

                </div>

                <!-- LINKEDIN -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        LinkedIn URL

                    </label>

                    <input type="url" name="linkedin" class="form-control"
                        value="<?= esc($member['extra_data']['linkedin'] ?? '') ?>">

                </div>

                <!-- INSTAGRAM -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Instagram URL

                    </label>

                    <input type="url" name="instagram" class="form-control"
                        value="<?= esc($member['extra_data']['instagram'] ?? '') ?>">

                </div>

                <!-- BIOGRAPHY -->

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Biography

                    </label>

                    <textarea name="description" rows="5"
                        class="form-control"><?= esc($member['description']) ?></textarea>

                </div>

                <!-- SORT ORDER -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" class="form-control" value="<?= $member['sort_order'] ?>">

                </div>

                <!-- STATUS -->

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= $member['status'] == 1 ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= $member['status'] == 0 ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <div class="d-flex gap-2">

                <button type="submit" class="btn btn-primary">

                    <i class="feather-save me-2"></i>

                    Update Member

                </button>

                <a href="<?= base_url('admin/teampage/members') ?>" class="btn btn-light">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    document
        .getElementById('image')
        .addEventListener(
            'change',
            function(e) {
                const file = e.target.files[0];

                if (!file) {
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(event) {
                    document
                        .getElementById('imagePreview')
                        .src =
                        event.target.result;
                };

                reader.readAsDataURL(file);
            }
        );
</script>

<?= $this->endSection() ?>