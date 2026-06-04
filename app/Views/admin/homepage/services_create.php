<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Create Service

        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/home') ?>">

                        Dashboard

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/homepage') ?>">

                        Homepage CMS

                    </a>

                </li>

                <li class="breadcrumb-item">

                    <a href="<?= base_url('admin/homepage/services') ?>">

                        Services

                    </a>

                </li>

                <li class="breadcrumb-item active">

                    Create

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

                        Homepage Service

                    </h5>

                    <p class="text-muted mb-0">

                        Create a new homepage service.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form action="<?= base_url('admin/homepage/services-store') ?>" method="post"
                    enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- TITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Title

                                <span class="text-danger">*</span>

                            </label>

                            <input type="text" name="title" class="form-control" required>

                        </div>

                        <!-- SUBTITLE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Subtitle

                            </label>

                            <input type="text" name="subtitle" class="form-control">

                        </div>

                        <!-- DESCRIPTION -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" rows="6" class="form-control"></textarea>

                        </div>

                        <!-- ICON -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon

                            </label>

                            <input type="text" name="icon" id="icon" class="form-control"
                                placeholder="feather-settings">

                            <small class="text-muted">

                                Examples:
                                feather-settings,
                                feather-award,
                                feather-shield,
                                feather-briefcase

                            </small>

                        </div>

                        <!-- ICON PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon Preview

                            </label>

                            <div class="border rounded p-3 text-center">

                                <i id="iconPreview" class="feather-settings" style="font-size:40px;"></i>

                            </div>

                        </div>

                        <!-- IMAGE -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Service Image

                            </label>

                            <input type="file" name="image" id="image" class="form-control" accept="image/*">

                        </div>

                        <!-- IMAGE PREVIEW -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Image Preview

                            </label>

                            <div>

                                <img id="imagePreview" src="<?= base_url('assets/admin/images/no-image.png') ?>"
                                    class="img-thumbnail" style="
                                        width:300px;
                                        height:180px;
                                        object-fit:cover;
                                    ">

                            </div>

                        </div>

                        <!-- BUTTON TEXT -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Button Text

                            </label>

                            <input type="text" name="button_text" value="Read More" class="form-control">

                        </div>

                        <!-- BUTTON URL -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Button URL

                            </label>

                            <input type="text" name="button_url" class="form-control">

                        </div>

                        <!-- SORT ORDER -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Sort Order

                            </label>

                            <input type="number" name="sort_order" value="1" class="form-control">

                        </div>

                        <!-- STATUS -->

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

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-2"></i>

                            Save Service

                        </button>

                        <a href="<?= base_url('admin/homepage/services') ?>" class="btn btn-light">

                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>

<script>
    /*
|--------------------------------------------------------------------------
| ICON PREVIEW
|--------------------------------------------------------------------------
*/

    $('#icon').on(
        'keyup',
        function() {
            $('#iconPreview')
                .attr(
                    'class',
                    $(this).val()
                );
        }
    );

    /*
    |--------------------------------------------------------------------------
    | IMAGE PREVIEW
    |--------------------------------------------------------------------------
    */

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