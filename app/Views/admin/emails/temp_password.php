<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>
        Temporary Login Password
    </title>

</head>

<body style="
    margin:0;
    padding:30px;
    background:#f4f6f9;
    font-family:Arial,sans-serif;
">

    <div style="
        max-width:600px;
        margin:auto;
        background:#ffffff;
        border-radius:10px;
        overflow:hidden;
        box-shadow:0 2px 10px rgba(0,0,0,0.08);
    ">

        <!-- ===================================================== -->
        <!-- HEADER -->
        <!-- ===================================================== -->

        <div style="
            background:#1e293b;
            padding:30px;
            text-align:center;
            color:#ffffff;
        ">

            <h2 style="
                margin:0;
                font-size:24px;
            ">
                Temporary Password
            </h2>

        </div>

        <!-- ===================================================== -->
        <!-- BODY -->
        <!-- ===================================================== -->

        <div style="
            padding:35px;
            color:#333333;
        ">

            <p style="
                font-size:16px;
                margin-top:0;
            ">

                Hello
                <strong>

                    <?= esc($fullName) ?>

                </strong>,

            </p>

            <p style="
                line-height:1.7;
            ">

                An administrator has generated a temporary login password for your account.

            </p>

            <!-- ===================================================== -->
            <!-- TEMP PASSWORD -->
            <!-- ===================================================== -->

            <div style="
                margin:30px 0;
                padding:25px;
                background:#f8fafc;
                border:1px dashed #cbd5e1;
                border-radius:10px;
                text-align:center;
            ">

                <div style="
                    font-size:14px;
                    color:#64748b;
                    margin-bottom:10px;
                ">
                    TEMPORARY PASSWORD
                </div>

                <div style="
                    font-size:32px;
                    font-weight:bold;
                    letter-spacing:4px;
                    color:#0f172a;
                ">

                    <?= esc($tempPassword) ?>

                </div>

            </div>

            <!-- ===================================================== -->
            <!-- EXPIRATION -->
            <!-- ===================================================== -->

            <div style="
                padding:15px;
                background:#fff7ed;
                border-left:4px solid #f97316;
                border-radius:6px;
                margin-bottom:25px;
            ">

                <strong>
                    Important:
                </strong>

                This password expires in

                <strong>
                    30 minutes
                </strong>.

                Expiration time:

                <strong>

                    <?= date(
                        'M d, Y h:i A',
                        strtotime($expiresAt)
                    ) ?>

                </strong>

            </div>

            <!-- ===================================================== -->
            <!-- LOGIN BUTTON -->
            <!-- ===================================================== -->

            <div style="
                text-align:center;
                margin:35px 0;
            ">

                <a href="<?= base_url('admin') ?>" style="
                        display:inline-block;
                        background:#2563eb;
                        color:#ffffff;
                        text-decoration:none;
                        padding:14px 28px;
                        border-radius:8px;
                        font-weight:bold;
                    ">

                    Login Now

                </a>

            </div>

            <!-- ===================================================== -->
            <!-- SECURITY -->
            <!-- ===================================================== -->

            <p style="
                line-height:1.7;
                color:#475569;
            ">

                For security reasons, you will be required to change this temporary password immediately after login.

            </p>

            <p style="
                line-height:1.7;
                color:#475569;
            ">

                If you did not expect this email, please contact your administrator immediately.

            </p>

        </div>

        <!-- ===================================================== -->
        <!-- FOOTER -->
        <!-- ===================================================== -->

        <div style="
            background:#f8fafc;
            padding:20px;
            text-align:center;
            color:#94a3b8;
            font-size:13px;
        ">

            © <?= date('Y') ?>

            Fine Gas Systems, Inc. All rights reserved.

        </div>

    </div>

</body>

</html>