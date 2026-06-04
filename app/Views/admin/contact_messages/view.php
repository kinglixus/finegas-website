<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">
            View Contact Message
        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/home') ?>">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/contact-messages') ?>">
                        Contact Messages
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    View Message
                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="card-title mb-0">

            Message #<?= esc($message['id']) ?>

        </h5>

        <a href="<?= base_url('admin/contact-messages') ?>" class="btn btn-secondary">

            <i class="feather-arrow-left"></i>
            Back

        </a>

    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Name
                </label>

                <div>
                    <?= esc($message['name']) ?>
                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Email
                </label>

                <div>
                    <?= esc($message['email']) ?>
                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Location
                </label>

                <div>
                    <?= esc($message['location']) ?>
                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Subject
                </label>

                <div>
                    <?= esc($message['subject']) ?>
                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Status
                </label>

                <div>

                    <span class="badge bg-info">

                        <?= ucfirst(
                            esc($message['status'])
                        ) ?>

                    </span>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Read Status
                </label>

                <div>

                    <?php if ($message['is_read']): ?>

                        <span class="badge bg-success">
                            Read
                        </span>

                    <?php else: ?>

                        <span class="badge bg-danger">
                            Unread
                        </span>

                    <?php endif; ?>

                </div>

            </div>

            <div class="col-md-12 mb-3">

                <label class="fw-bold">
                    Message
                </label>

                <div class="border rounded p-3 bg-light" style="white-space: pre-wrap;">

                    <?= esc($message['message']) ?>

                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    IP Address
                </label>

                <div>
                    <?= esc($message['ip_address']) ?>
                </div>

            </div>

            <div class="col-md-6 mb-3">

                <label class="fw-bold">
                    Date Received
                </label>

                <div>

                    <?= date(
                        'd M Y H:i:s',
                        strtotime(
                            $message['created_at']
                        )
                    ) ?>

                </div>

            </div>

            <div class="col-md-12 mb-3">

                <label class="fw-bold">
                    User Agent
                </label>

                <div class="border rounded p-3 bg-light">

                    <?= esc($message['user_agent']) ?>

                </div>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>