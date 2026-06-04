<?= $this->extend('admin/layout') ?>

<?= $this->section('content') ?>

<div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-4 gap-3">

    <div>

        <h2 class="fw-bold mb-1 text-dark">
            Welcome Back,
            <?= esc(session('admin_first_name')) ?>
        </h2>

        <p class="text-muted mb-0">
            Here's an overview of your Fine Gas System today.
        </p>

    </div>

    <div class="d-flex align-items-center gap-2 flex-wrap">

        <span class="badge bg-soft-success text-success px-3 py-2 fs-12 fw-semibold">
            <?= date('l, d M Y') ?>
        </span>

        <a href="<?= base_url('admin/users') ?>" class="btn btn-primary d-flex align-items-center gap-2"
            style="background-color:#395555;border-color:#395555;">

            <i class="feather-users"></i>
            <span>Manage Users</span>

        </a>

    </div>

</div>

<!-- ===================================================== -->
<!-- STATS -->
<!-- ===================================================== -->

<div class="row g-4 mb-4">

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm h-100 dashboard-stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="text-muted fw-medium mb-2">
                            Total Users
                        </div>

                        <h2 class="fw-bold mb-2">
                            <?= number_format($totalUsers ?? 0) ?>
                        </h2>

                        <div class="small text-success fw-semibold">
                            <i class="feather-trending-up me-1"></i>
                            System users
                        </div>

                    </div>

                    <div class="dashboard-icon-box" style="background:#395555;">

                        <i class="feather-users"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm h-100 dashboard-stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="text-muted fw-medium mb-2">
                            Active Users
                        </div>

                        <h2 class="fw-bold mb-2 text-success">
                            <?= number_format($activeUsers ?? 0) ?>
                        </h2>

                        <div class="small text-success fw-semibold">
                            <i class="feather-check-circle me-1"></i>
                            Active accounts
                        </div>

                    </div>

                    <div class="dashboard-icon-box bg-success">

                        <i class="feather-user-check"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm h-100 dashboard-stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="text-muted fw-medium mb-2">
                            Inactive Users
                        </div>

                        <h2 class="fw-bold mb-2 text-warning">
                            <?= number_format($inactiveUsers ?? 0) ?>
                        </h2>

                        <div class="small text-warning fw-semibold">
                            <i class="feather-alert-circle me-1"></i>
                            Disabled accounts
                        </div>

                    </div>

                    <div class="dashboard-icon-box bg-warning">

                        <i class="feather-user-x"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <div class="col-md-6 col-xl-3">

        <div class="card border-0 shadow-sm h-100 dashboard-stat-card">

            <div class="card-body">

                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="text-muted fw-medium mb-2">
                            Contact Messages
                        </div>

                        <h2 class="fw-bold mb-2 text-danger">
                            <?= number_format($unreadMessages ?? 0) ?>
                        </h2>

                        <div class="small text-danger fw-semibold">
                            <i class="feather-mail me-1"></i>
                            <?= number_format($unreadMessages ?? 0) ?> Unread Messages
                        </div>

                    </div>

                    <a href="<?= base_url('admin/contact-messages') ?>" class="text-decoration-none">

                        <div class="dashboard-icon-box bg-danger">

                            <i class="feather-mail"></i>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>

</div>

<!-- ===================================================== -->
<!-- QUICK ACTIONS -->
<!-- ===================================================== -->

<div class="row g-4 mb-4">

    <div class="col-xl-8">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-transparent border-0 pt-4 px-4">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Quick Actions
                        </h5>

                        <p class="text-muted small mb-0">
                            Quickly access important sections.
                        </p>

                    </div>

                </div>

            </div>

            <div class="card-body pt-2 px-4 pb-4">

                <div class="row g-3">

                    <div class="col-md-4">

                        <a href="<?= base_url('admin/users') ?>" class="text-decoration-none">

                            <div class="quick-action-card">

                                <div class="quick-action-icon bg-primary">
                                    <i class="feather-users"></i>
                                </div>

                                <h6 class="fw-bold mb-1 text-dark">
                                    Users
                                </h6>

                                <p class="text-muted small mb-0">
                                    Manage system users.
                                </p>

                            </div>

                        </a>

                    </div>

                    <div class="col-md-4">

                        <a href="<?= base_url('admin/profile') ?>" class="text-decoration-none">

                            <div class="quick-action-card">

                                <div class="quick-action-icon bg-success">
                                    <i class="feather-user"></i>
                                </div>

                                <h6 class="fw-bold mb-1 text-dark">
                                    Profile
                                </h6>

                                <p class="text-muted small mb-0">
                                    Manage your profile.
                                </p>

                            </div>

                        </a>

                    </div>

                    <div class="col-md-4">

                        <a href="<?= base_url('admin/account-settings') ?>" class="text-decoration-none">

                            <div class="quick-action-card">

                                <div class="quick-action-icon bg-warning">
                                    <i class="feather-settings"></i>
                                </div>

                                <h6 class="fw-bold mb-1 text-dark">
                                    Settings
                                </h6>

                                <p class="text-muted small mb-0">
                                    Security & preferences.
                                </p>

                            </div>

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="col-xl-4">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-transparent border-0 pt-4 px-4">

                <div class="d-flex align-items-center justify-content-between">

                    <div>

                        <h5 class="fw-bold mb-1">
                            Calendar
                        </h5>

                        <p class="text-muted small mb-0">
                            Current month overview.
                        </p>

                    </div>

                    <div class="dashboard-icon-box bg-primary">

                        <i class="feather-calendar"></i>

                    </div>

                </div>

            </div>

            <div class="card-body pt-2 px-3 pb-4">

                <div id="dashboardCalendar"></div>

            </div>

        </div>

    </div>

</div>

</div>

<style>
    .dashboard-stat-card {

        transition: all 0.25s ease;

        border-radius: 18px;
    }

    .dashboard-stat-card:hover {

        transform: translateY(-4px);

        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08) !important;
    }

    .dashboard-icon-box {

        width: 62px;

        height: 62px;

        border-radius: 18px;

        display: flex;

        align-items: center;

        justify-content: center;

        color: #fff;

        font-size: 24px;
    }

    .quick-action-card {

        border: 1px solid #eef1f5;

        border-radius: 18px;

        padding: 24px;

        transition: all 0.25s ease;

        background: #fff;

        height: 100%;
    }

    .quick-action-card:hover {

        transform: translateY(-3px);

        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.06);

        border-color: #395555;
    }

    .quick-action-icon {

        width: 55px;

        height: 55px;

        border-radius: 16px;

        display: flex;

        align-items: center;

        justify-content: center;

        color: white;

        font-size: 22px;

        margin-bottom: 18px;
    }

    /*
|--------------------------------------------------------------------------
| CALENDAR
|--------------------------------------------------------------------------
*/

    #dashboardCalendar {

        background: #fff;

        border-radius: 16px;

        overflow: hidden;
    }

    .fc {

        font-family: inherit;
    }

    .fc .fc-toolbar-title {

        font-size: 16px;

        font-weight: 700;

        color: #395555;
    }

    .fc .fc-button {

        background: #395555 !important;

        border: none !important;

        box-shadow: none !important;

        padding: 4px 10px !important;

        font-size: 13px !important;
    }

    .fc .fc-button:hover {

        background: #2f4444 !important;
    }

    .fc .fc-daygrid-day-number {

        color: #333;

        font-weight: 500;
    }

    .fc-theme-standard td,
    .fc-theme-standard th {

        border-color: #f1f1f1;
    }

    .fc-theme-standard .fc-scrollgrid {

        border-radius: 14px;

        overflow: hidden;

        border: 1px solid #f1f1f1;
    }

    .fc .fc-daygrid-body-natural .fc-daygrid-day-events {

        margin-bottom: 0 !important;
    }

    .fc .fc-daygrid-day-frame {

        min-height: 48px;

        padding: 4px 2px;
    }

    .fc .fc-scrollgrid-section-body table,
    .fc .fc-scrollgrid-section-header table {

        margin-bottom: 0 !important;
    }

    .fc td,
    .fc th {

        padding: 0 !important;
    }

    .fc .fc-daygrid-day-top {

        justify-content: center;

        padding-top: 6px;
    }

    @media (max-width: 767px) {
        .quick-action-card {

            padding: 18px;
        }
    }
</style>


<script>
    document.addEventListener(
        'DOMContentLoaded',

        function() {
            const calendarEl =
                document.getElementById(
                    'dashboardCalendar'
                );

            if (!calendarEl) {
                return;
            }

            const calendar =
                new FullCalendar.Calendar(

                    calendarEl,

                    {
                        initialView: 'dayGridMonth',

                        height: 320,

                        fixedWeekCount: false,

                        showNonCurrentDates: false,

                        headerToolbar: {
                            left: 'prev,next',

                            center: 'title',

                            right: ''
                        }
                    }
                );

            calendar.render();
        }
    );
</script>

<?= $this->endSection() ?>