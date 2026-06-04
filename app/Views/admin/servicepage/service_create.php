<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Create Service

        </h4>

    </div>

</div>

<div class="card">

    <div class="card-body">

        <form action="<?= base_url('admin/servicepage/store-service') ?>" method="post" enctype="multipart/form-data">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon

                    </label>

                    <input type="text" name="icon" id="icon" class="form-control">

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="6" class="form-control"></textarea>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Service Image

                    </label>

                    <input type="file" name="image" id="image" class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Preview

                    </label>

                    <img id="imagePreview" src="<?= base_url('assets/admin/images/no-image.png') ?>"
                        class="img-thumbnail" style="width:250px;height:150px;object-fit:cover;">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Button Text

                    </label>

                    <input type="text" name="button_text" class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Button URL

                    </label>

                    <input type="text" name="button_url" class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" value="1" class="form-control">

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1">

                            Active

                        </option>

                        <option value="0">

                            Inactive

                        </option>

                    </select>

                </div>

            </div>

            <hr>

            <button type="submit" class="btn btn-primary">

                Save Service

            </button>

            <a href="<?= base_url('admin/servicepage/services') ?>" class="btn btn-light">

                Cancel

            </a>

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

                if (!file) return;

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

                reader.readAsDataURL(file);
            }
        );
</script>

<?= $this->endSection() ?>