<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<input type="text" name="title" class="form-control" value="<?= esc($servicesHeader['title'] ?? '') ?>">

<input type="text" name="subtitle" class="form-control" value="<?= esc($servicesHeader['subtitle'] ?? '') ?>">
<textarea name="description" rows="6" class="form-control"><?= esc($servicesHeader['description'] ?? '') ?></textarea>

<select name="status" class="form-select">

    <option value="1" <?= ($servicesHeader['status'] ?? 1) == 1 ? 'selected' : '' ?>>

        Active

    </option>

    <option value="0" <?= ($servicesHeader['status'] ?? 1) == 0 ? 'selected' : '' ?>>

        Inactive

    </option>

</select>

<button type="submit" class="btn btn-primary">

    <i class="feather-save me-2"></i>

    Save Services Header

</button>
<?= $this->endSection() ?>