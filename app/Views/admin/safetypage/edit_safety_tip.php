<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-4">

    <div>

        <h4 class="mb-1">

            Edit Safety Tip

        </h4>

        <p class="text-muted mb-0">

            Update safety tip card.

        </p>

    </div>

    <a href="<?= base_url('admin/safetypage/safety-tips') ?>" class="btn btn-light">

        Back

    </a>

</div>

<div class="card">

    <div class="card-body">

        <form action="<?= base_url('admin/safetypage/update-safety-tip/' . $safety_tip['id']) ?>" method="post">

            <?= csrf_field() ?>

            <div class="row">

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Title

                    </label>

                    <input type="text" name="title" class="form-control" value="<?= esc($safety_tip['title'] ?? '') ?>"
                        required>

                </div>

                <div class="col-md-6 mb-3">

                    <label class="form-label">

                        Icon

                    </label>

                    <input type="text" name="icon" id="icon" class="form-control"
                        value="<?= esc($safety_tip['icon'] ?? 'fa fa-check-circle') ?>">

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Description

                    </label>

                    <textarea name="description" rows="5" class="form-control"
                        required><?= esc($safety_tip['description'] ?? '') ?></textarea>

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Animation Delay

                    </label>

                    <input type="text" name="animation_delay" class="form-control"
                        value="<?= esc($safety_tip['extra_data']['animation_delay'] ?? '0.1s') ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Sort Order

                    </label>

                    <input type="number" name="sort_order" class="form-control"
                        value="<?= esc($safety_tip['sort_order'] ?? 0) ?>">

                </div>

                <div class="col-md-4 mb-3">

                    <label class="form-label">

                        Status

                    </label>

                    <select name="status" class="form-select">

                        <option value="1" <?= (($safety_tip['status'] ?? 1) == 1) ? 'selected' : '' ?>>

                            Active

                        </option>

                        <option value="0" <?= (($safety_tip['status'] ?? 1) == 0) ? 'selected' : '' ?>>

                            Inactive

                        </option>

                    </select>

                </div>

                <div class="col-md-12 mb-3">

                    <label class="form-label">

                        Icon Preview

                    </label>

                    <div class="border rounded p-3 text-center">

                        <i id="iconPreview" class="<?= esc($safety_tip['icon'] ?? 'fa fa-check-circle') ?> text-primary"
                            style="font-size:40px;"></i>

                    </div>

                </div>

            </div>

            <button type="submit" class="btn btn-primary">

                <i class="feather-save me-2"></i>

                Update Safety Tip

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