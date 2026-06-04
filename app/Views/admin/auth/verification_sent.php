<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Email Sent</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <style>
        body {

            background:
                linear-gradient(135deg,
                    #395555,
                    #1e3c72);

            min-height: 100vh;

            display: flex;

            align-items: center;

            justify-content: center;
        }

        .card-box {

            max-width: 500px;

            width: 100%;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-lg-5">

                <div class="card shadow-lg border-0 card-box">

                    <div class="card-body text-center p-5">

                        <div class="mb-4">

                            <i class="fa fa-envelope-circle-check
                                  text-success" style="font-size:70px;"></i>

                        </div>

                        <h3 class="fw-bold mb-3">

                            Verification Email Sent

                        </h3>

                        <p class="text-muted mb-4">

                            A verification code has been sent
                            to your email address.

                            Please check your inbox and click
                            the verification button in the email.

                        </p>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <script>
        /*
    |--------------------------------------------------------------------------
    | AUTO CLOSE TAB AFTER 10 SECONDS
    |--------------------------------------------------------------------------
    */

        let seconds = 5;

        const countdownElement =
            document.getElementById(
                'countdown'
            );

        const interval = setInterval(() => {
            seconds--;

            if (countdownElement) {
                countdownElement.innerText =
                    seconds;
            }

            if (seconds <= 0) {
                clearInterval(interval);

                /*
                |--------------------------------------------------------------------------
                | CLOSE TAB
                |--------------------------------------------------------------------------
                */

                window.close();

                /*
                |--------------------------------------------------------------------------
                | FALLBACK
                |--------------------------------------------------------------------------
                */

                window.location.href =
                    'about:blank';
            }

        }, 500);
    </script>
</body>

</html>