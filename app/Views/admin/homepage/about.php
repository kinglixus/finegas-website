<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            About Section

        </h4>

        <p class="text-muted">

            Manage homepage About section.

        </p>

    </div>

</div>

<div class="card">

    <div class="card-header">

        <h5 class="card-title">

            About Content

        </h5>

    </div>

    <div class="card-body">

        <form action="<?= base_url('admin/homepage/about-update') ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>
            <div class="mb-3">

                <label class="form-label">

                    Title

                </label>

                <input type="text" name="title" class="form-control" value="<?= esc($about['title'] ?? '') ?>">

            </div>
            <div class="mb-3">

                <label class="form-label">

                    Subtitle

                </label>

                <input type="text" name="subtitle" class="form-control" value="<?= esc($about['subtitle'] ?? '') ?>">

            </div>
            <div class="mb-3">

                <label class="form-label">

                    Description

                </label>

                <textarea name="description" rows="6"
                    class="form-control"><?= esc($about['description'] ?? '') ?></textarea>

            </div>
            <div class="row">

                <div class="col-md-6">

                    <label class="form-label">

                        Current Image

                    </label>

                    <div>

                        <img id="imagePreview" src="<?= !empty($about['image'])
                                                        ? base_url($about['image'])
                                                        : base_url('assets/admin/images/no-image.png') ?>"
                            class="img-thumbnail" style="
                    width:300px;
                    height:200px;
                    object-fit:cover;
                ">
                    </div>

                </div>
                <div class="col-md-6">

                    <label class="form-label">

                        Replace Image

                    </label>

                    <input type="file" name="image" id="image" class="form-control">

                </div>

            </div>
            <div class="row mt-3">

                <div class="col-md-6">

                    <label class="form-label">

                        Button Text

                    </label>

                    <input type="text" name="button_text" class="form-control"
                        value="<?= esc($about['button_text'] ?? '') ?>">

                </div>
                <div class="col-md-6">

                    <label class="form-label">

                        Button URL

                    </label>

                    <input type="text" name="button_url" class="form-control"
                        value="<?= esc($about['button_url'] ?? '') ?>">

                </div>

            </div>
            <div class="mt-3">

                <label class="form-label">

                    Status

                </label>

                <select name="status" class="form-select">

                    <option value="1" <?= ($about['status'] ?? 1) == 1 ? 'selected' : '' ?>>

                        Active

                    </option>

                    <option value="0" <?= ($about['status'] ?? 1) == 0 ? 'selected' : '' ?>>

                        Inactive

                    </option>

                </select>

            </div>
            <hr>

            <button type="submit" class="btn btn-primary">

                <i class="feather-save me-2"></i>

                Save About Section

            </button>

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
                const file =
                    e.target.files[0];

                if (!file) {
                    return;
                }

                const reader =
                    new FileReader();

                reader.onload =
                    function(event) {
                        document
                            .getElementById(
                                'imagePreview'
                            )
                            .src =
                            event.target.result;
                    };

                reader.readAsDataURL(
                    file
                );
            }
        );
</script>


<?= $this->endSection() ?>