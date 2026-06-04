<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">

            Homepage CMS

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

                <li class="breadcrumb-item active">

                    Create Section

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

                        Create Homepage Section

                    </h5>

                    <p class="text-muted mb-0">

                        Manage homepage sliders, statistics,
                        services and content blocks.

                    </p>

                </div>

            </div>

            <div class="card-body">

                <form id="homepageForm" enctype="multipart/form-data">

                    <?= csrf_field() ?>

                    <div class="row">

                        <!-- Section Name -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Section Name

                                <span class="text-danger">*</span>

                            </label>

                            <select name="section_name" class="form-select">

                                <option value="">

                                    Select Section

                                </option>

                                <option value="slider">

                                    Slider

                                </option>

                                <option value="statistics">

                                    Statistics

                                </option>

                                <option value="about">

                                    About

                                </option>

                                <option value="services_header">

                                    Services Header

                                </option>

                                <option value="services">

                                    Services

                                </option>

                                <option value="choose_us">

                                    Why Choose Us

                                </option>

                            </select>

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Section Type -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Section Type

                            </label>

                            <select name="section_type" class="form-select">

                                <option value="section">

                                    Section

                                </option>

                                <option value="item">

                                    Item

                                </option>

                            </select>

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Title -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Title

                            </label>

                            <input type="text" name="title" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Subtitle -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Subtitle

                            </label>

                            <input type="text" name="subtitle" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Description -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Description

                            </label>

                            <textarea name="description" rows="5" class="form-control"></textarea>

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Image -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Image

                            </label>

                            <input type="file" name="image" id="image" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Preview -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Preview

                            </label>

                            <div>

                                <img id="imagePreview" src="<?= base_url('assets/admin/images/no-image.png') ?>"
                                    class="img-thumbnail" style="
                                        width: 150px;
                                        height: 150px;
                                        object-fit: cover;
                                    ">

                            </div>

                        </div>

                        <!-- Icon -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Icon

                            </label>

                            <input type="text" name="icon" placeholder="feather-award" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Sort Order -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Sort Order

                            </label>

                            <input type="number" name="sort_order" value="0" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Button Text -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Button Text

                            </label>

                            <input type="text" name="button_text" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Button URL -->

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Button URL

                            </label>

                            <input type="text" name="button_url" class="form-control">

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Extra Data -->

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Extra Data (JSON)

                            </label>

                            <textarea name="extra_data" rows="4" class="form-control"
                                placeholder='{"counter":"5000","unit":"+"}'></textarea>

                            <div class="invalid-feedback"></div>

                        </div>

                        <!-- Status -->

                        <div class="col-md-6 mb-4">

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

                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-primary">

                            <i class="feather-save me-1"></i>

                            Save Section

                        </button>

                        <a href="<?= base_url('admin/homepage') ?>" class="btn btn-light">

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
    $('#image').on(
        'change',
        function() {
            const file =
                this.files[0];

            if (file) {
                $('#imagePreview')
                    .attr(
                        'src',
                        URL.createObjectURL(file)
                    );
            }
        }
    );
</script>

<?= $this->endSection() ?>