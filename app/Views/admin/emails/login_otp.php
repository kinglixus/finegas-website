<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
</head>

<body style="font-family:Arial;background:#f4f6f9;padding:30px;">

    <div style="
    max-width:600px;
    margin:auto;
    background:#fff;
    padding:30px;
    border-radius:10px;
">

        <h2>Login Verification</h2>

        <p>Hello <?= esc($fullName) ?>,</p>

        <p>
            Use the verification code below to complete your login:
        </p>

        <div style="
        font-size:32px;
        font-weight:bold;
        letter-spacing:8px;
        background:#f8f9fa;
        padding:20px;
        text-align:center;
        border-radius:8px;
        margin:20px 0;
    ">
            <?= esc($code) ?>
        </div>

        <p>
            This code expires in 5 minutes.
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