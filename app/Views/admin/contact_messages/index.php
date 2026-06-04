<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="page-header">

    <div class="page-header-left">

        <h4 class="page-title">
            Contact Messages
        </h4>

        <div class="page-header-breadcrumb">

            <ol class="breadcrumb">

                <li class="breadcrumb-item">
                    <a href="<?= base_url('admin/home') ?>">
                        Dashboard
                    </a>
                </li>

                <li class="breadcrumb-item active">
                    Contact Messages
                </li>

            </ol>

        </div>

    </div>

</div>

<div class="card">

    <div class="card-header d-flex justify-content-between align-items-center">

        <h5 class="card-title mb-0">
            Contact Form Messages
        </h5>

        <span class="badge bg-primary">
            Total:
            <?= count($messages ?? []) ?>
        </span>

    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-bordered table-striped align-middle" width="100%">

                <thead>

                    <tr>

                        <th>Name</th>

                        <th>Location</th>

                        <th>Subject</th>

                        <th>Read</th>

                        <th>Date</th>

                        <th width="220">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    <?php if (!empty($messages)): ?>

                        <?php foreach ($messages as $message): ?>

                            <tr>

                                <td>
                                    <?= esc($message['name']) ?>
                                </td>

                                <td>
                                    <?= esc($message['location']) ?>
                                </td>

                                <td>
                                    <?= esc($message['subject']) ?>
                                </td>


                                <td>

                                    <?php if ($message['is_read']): ?>

                                        <span class="badge bg-success">
                                            Read
                                        </span>

                                    <?php else: ?>

                                        <span class="badge bg-danger">
                                            Unread
                                        </span>

                                    <?php endif; ?>

                                </td>

                                <td>

                                    <?= date(
                                        'd M Y H:i',
                                        strtotime(
                                            $message['created_at']
                                        )
                                    ) ?>

                                </td>

                                <td>

                                    <div class="d-flex gap-2 flex-wrap">

                                        <a href="<?= base_url('admin/contact-messages/view/' . $message['id']) ?>"
                                            class="btn btn-primary btn-sm">

                                            <i class="feather-eye"></i>

                                        </a>

                                        <?php if (!$message['is_read']): ?>

                                            <a href="<?= base_url('admin/contact-messages/mark-read/' . $message['id']) ?>"
                                                class="btn btn-success btn-sm">

                                                <i class="feather-check"></i>

                                            </a>

                                        <?php else: ?>

                                            <a href="<?= base_url('admin/contact-messages/mark-unread/' . $message['id']) ?>"
                                                class="btn btn-warning btn-sm">

                                                <i class="feather-mail"></i>

                                            </a>

                                        <?php endif; ?>

                                        <a href="<?= base_url('admin/contact-messages/delete/' . $message['id']) ?>"
                                            class="btn btn-danger btn-sm" onclick="return confirm('Delete this message?')">

                                            <i class="feather-trash-2"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="9" class="text-center">

                                No messages found.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>