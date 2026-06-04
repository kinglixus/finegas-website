<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>
        Password Changed
    </title>

</head>

<body style="font-family:Arial,sans-serif;">

    <h2>
        Password Changed Successfully
    </h2>

    <p>

        Hello

        <?= esc($user['first_name']) ?>,

    </p>

    <p>

        Your account password was changed successfully.

    </p>

    <p>

        <strong>Date:</strong>

        <?= esc($changed_at) ?>

    </p>

    <p>

        <strong>IP Address:</strong>

        <?= esc($ip_address) ?>

    </p>

    <p>

        If you did not perform this action,
        please contact the administrator immediately.

    </p>

    <br>

    <p>

        Fine Gas System

    </p>

</body>

</html>