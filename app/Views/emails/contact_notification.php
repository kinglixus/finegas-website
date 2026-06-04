<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>New Contact Form Message</title>
</head>

<body style="margin:0; padding:0; background:#f5f5f5; font-family:Arial, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background:#f5f5f5; padding:30px 0;">
        <tr>
            <td align="center">
                <table width="650" cellpadding="0" cellspacing="0"
                    style="background:#ffffff; border-radius:10px; overflow:hidden;">
                    <tr>
                        <td style="background:#0d6efd; padding:22px 30px; color:#ffffff;">
                            <h2 style="margin:0; font-size:22px;">New Contact Form Message</h2>
                            <p style="margin:8px 0 0;">Fine Gas Website</p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding:30px;">
                            <p style="font-size:15px; color:#333;">
                                A new message has been submitted from the Fine Gas contact form.
                            </p>

                            <table width="100%" cellpadding="8" cellspacing="0"
                                style="border-collapse:collapse; margin-top:20px;">
                                <tr>
                                    <td style="border:1px solid #ddd; font-weight:bold; width:160px;">Message ID</td>
                                    <td style="border:1px solid #ddd;"><?= esc($contact['id'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd; font-weight:bold;">Name</td>
                                    <td style="border:1px solid #ddd;"><?= esc($contact['name'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd; font-weight:bold;">Email</td>
                                    <td style="border:1px solid #ddd;">
                                        <a href="mailto:<?= esc($contact['email'] ?? '') ?>">
                                            <?= esc($contact['email'] ?? '') ?>
                                        </a>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd; font-weight:bold;">Location</td>
                                    <td style="border:1px solid #ddd;">
                                        <?= esc($contact['location'] ?? '') ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd; font-weight:bold;">Subject</td>
                                    <td style="border:1px solid #ddd;"><?= esc($contact['subject'] ?? '') ?></td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd; font-weight:bold; vertical-align:top;">Message
                                    </td>
                                    <td style="border:1px solid #ddd; line-height:1.6;">
                                        <?= nl2br(esc($contact['message'] ?? '')) ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border:1px solid #ddd; font-weight:bold;">IP Address</td>
                                    <td style="border:1px solid #ddd;"><?= esc($contact['ip_address'] ?? '') ?></td>
                                </tr>
                            </table>

                            <p style="margin-top:25px; font-size:14px; color:#555;">
                                You can reply directly to this email to respond to the customer.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td
                            style="background:#f1f1f1; padding:18px 30px; text-align:center; color:#777; font-size:13px;">
                            &copy; <?= date('Y') ?> Fine Gas. Website Contact Notification.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>