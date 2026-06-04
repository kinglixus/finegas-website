<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Reset Password</title>

</head>

<body style="
    font-family: Arial, sans-serif;
    background:#f4f6f9;
    padding:30px;
">

    <div style="
    max-width:600px;
    margin:auto;
    background:#ffffff;
    border-radius:10px;
    padding:30px;
">

        <h2 style="
        color:#395555;
        margin-bottom:20px;
    ">
            Reset Your Password
        </h2>

        <p>

            Hello

            <strong>

                <?= esc(
                    trim(
                        ($user['first_name'] ?? '') . ' ' .
                            ($user['last_name'] ?? '')
                    )
                ) ?>

            </strong>,

        </p>

        <p>

            We received a request to reset your password.

        </p>

        <p>

            Click the button below to continue.

        </p>

        <p style="margin:30px 0;">

            <a href="<?= $resetUrl ?>" style="
            background:#395555;
            color:#ffffff;
            padding:14px 26px;
            text-decoration:none;
            border-radius:6px;
            display:inline-block;
           ">

                Reset Password

            </a>

        </p>

        <p>

            This link expires in
            <strong>1 hour</strong>.

        </p>

        <hr style="
        margin:30px 0;
        border-color:#eee;
    ">

        <p style="
        font-size:13px;
        color:#888;
    ">

            If you did not request this reset,
            please ignore this email.

        </p>

    </div>

</body>

</html>