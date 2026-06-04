<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family: Arial, sans-serif; background:#f4f6f9; padding:30px;">

    <div style="max-width:600px;margin:auto;background:#fff;padding:30px;border-radius:10px;">

        <h2 style="margin-bottom:20px;">
            Verify Your Account
        </h2>

        <p>Hello <?= esc($fullName) ?>,</p>

        <p>
            Your verification code is:
        </p>

        <p>
            This code expires in <strong>5 minutes</strong>.
        </p>

        <p style="margin-top:30px;">
            Click below to verify your account:
        </p>

        <p>
            <a href="<?= $verifyUrl ?>" style="
      background:#395555;
      color:#fff;
      padding:12px 24px;
      text-decoration:none;
      border-radius:6px;
      display:inline-block;
   "> Verify Now

            </a>
        </p>

    </div>

</body>

</html>