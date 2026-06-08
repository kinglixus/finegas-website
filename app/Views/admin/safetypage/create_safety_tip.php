<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Add Safety Tip

        </h4>

        <p class="text-muted mb-0">

            Create a new safety tip card.

        </p>

    </div>

    <a href="<?= base_url('admin/safetypage/safety-tips') ?>" class="btn btn-light">

        Back

    </a>

</div>

<div class="card">

    <div class="card-body">

        <form action="<?= base_url('admin/safetypage/store-safety-tip') ?>" method="post">

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

                    <input type="text" name="icon" id="icon" class="form-control" value="fa fa-check-circle">

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="5" class="form-control" required></textarea>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Animation Delay

                    </label>

                    <input type="text" name="animation_delay" class="form-control" value="0.1s">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" class="form-control" value="0">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" selected>

                            Active

                        </option>

                        <option value="0">

                            Inactive

                        </option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Icon Preview

                    </label>

                    <div class="border rounded p-3 text-center">

                        <i id="iconPreview" class="fa fa-check-circle text-primary" style="font-size:40px;"></i>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="feather-save me-2"></i>

                Save Safety Tip

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