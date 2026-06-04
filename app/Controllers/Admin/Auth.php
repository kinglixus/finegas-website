<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminUserModel;
use Config\Services;

class Auth extends BaseController
{
    protected $adminUserModel;

    public function __construct()
    {
        $this->adminUserModel = new AdminUserModel();
    }


    public function login()
    {
        /*
    |--------------------------------------------------------------------------
    | ALREADY LOGGED IN
    |--------------------------------------------------------------------------
    */

        if (admin_logged_in()) {

            return $this->response->setJSON([

                'status'   => true,

                'redirect' => base_url('admin/home'),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | LOGIN REQUEST
    |--------------------------------------------------------------------------
    */

        if ($this->request->getMethod() === 'POST') {

            /*
        |--------------------------------------------------------------------------
        | AJAX ONLY
        |--------------------------------------------------------------------------
        */

            if (! $this->request->isAJAX()) {

                return $this->response->setJSON([

                    'status'  => false,

                    'message' => 'Invalid request',
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | VALIDATION RULES
        |--------------------------------------------------------------------------
        */

            $rules = [

                'email'    => 'required|valid_email',

                'password' => 'required|min_length[6]',
            ];

            if (! $this->validate($rules)) {

                return $this->response->setJSON([

                    'status' => false,

                    'errors' => $this->validator->getErrors(),
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | INPUTS
        |--------------------------------------------------------------------------
        */

            $email = trim(
                $this->request->getPost('email')
            );

            $password = $this->request->getPost('password');

            /*
        |--------------------------------------------------------------------------
        | CHECK USER EXISTS
        |--------------------------------------------------------------------------
        */

            $existingUser = $this->adminUserModel

                ->where('email', $email)

                ->first();

            /*
        |--------------------------------------------------------------------------
        | ACCOUNT LOCKED
        |--------------------------------------------------------------------------
        */

            if (
                $existingUser &&
                $this->adminUserModel->isLocked($existingUser)
            ) {

                return $this->response->setJSON([

                    'status'  => false,

                    'message' =>
                    'Account locked due to multiple failed login attempts. Please try again later.',
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | VERIFY PASSWORD
        |--------------------------------------------------------------------------
        */

            $user = $this->adminUserModel
                ->verifyPassword(
                    $email,
                    $password
                );

            /*
        |--------------------------------------------------------------------------
        | INVALID LOGIN
        |--------------------------------------------------------------------------
        */

            if (! $user) {

                if ($existingUser) {

                    /*
                |--------------------------------------------------------------------------
                | INCREMENT FAILED ATTEMPTS
                |--------------------------------------------------------------------------
                */

                    $this->adminUserModel
                        ->incrementLoginAttempts(
                            $existingUser['id']
                        );

                    /*
                |--------------------------------------------------------------------------
                | REFRESH USER
                |--------------------------------------------------------------------------
                */

                    $existingUser = $this->adminUserModel
                        ->find($existingUser['id']);

                    /*
                |--------------------------------------------------------------------------
                | ACCOUNT LOCKED AFTER ATTEMPTS
                |--------------------------------------------------------------------------
                */

                    if (
                        $this->adminUserModel
                        ->isLocked($existingUser)
                    ) {

                        return $this->response->setJSON([

                            'status'  => false,

                            'message' =>
                            'Account locked for 15 minutes due to multiple failed login attempts.',
                        ]);
                    }

                    /*
                |--------------------------------------------------------------------------
                | REMAINING ATTEMPTS
                |--------------------------------------------------------------------------
                */

                    $remainingAttempts =
                        5 - (int) $existingUser['login_attempts'];

                    return $this->response->setJSON([

                        'status'  => false,

                        'message' =>
                        "Invalid email or password. {$remainingAttempts} attempts remaining.",
                    ]);
                }

                return $this->response->setJSON([

                    'status'  => false,

                    'message' => 'Invalid email or password',
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | RESET FAILED ATTEMPTS
        |--------------------------------------------------------------------------
        */

            $this->adminUserModel
                ->resetLoginAttempts($user['id']);

            /*
        |--------------------------------------------------------------------------
        | ACCOUNT STATUS
        |--------------------------------------------------------------------------
        */

            if ($user['status'] !== 'active') {

                return $this->response->setJSON([

                    'status'  => false,

                    'message' => 'Your account is inactive',
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | FIRST TIME EMAIL VERIFICATION
        |--------------------------------------------------------------------------
        */

            if ((int) $user['email_verified'] === 0) {

                $code = $this->adminUserModel
                    ->createEmailVerification(
                        $user['id']
                    );

                $this->sendVerificationEmail(
                    $user,
                    $code
                );

                session()->set([

                    'verification_user_id' => $user['id'],

                    'verification_type'    => 'email',
                ]);

                return $this->response->setJSON([

                    'status' => true,

                    'requires_verification' => true,

                    'message' => 'Verification code sent to your email',

                    'redirect' => base_url('verification-sent'),
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | LOGIN OTP VERIFICATION
        |--------------------------------------------------------------------------
        */

            $code = $this->adminUserModel
                ->createLoginVerification(
                    $user['id']
                );

            $this->sendLoginOTPEmail(
                $user,
                $code
            );

            session()->set([

                'verification_user_id' => $user['id'],

                'verification_type'    => 'login',
            ]);

            return $this->response->setJSON([

                'status'                => true,

                'requires_verification' => true,

                'message'               =>
                'Login verification code sent',

                'redirect'              => base_url('verification-sent'),
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | LOGIN VIEW
    |--------------------------------------------------------------------------
    */

        return view('admin/auth/login');
    }

    public function verify()
    {
        /*
    |--------------------------------------------------------------------------
    | GET TOKEN
    |--------------------------------------------------------------------------
    */

        $token = strtoupper(
            trim(
                $this->request->getGet('token')
            )
        );

        if (empty($token)) {

            return redirect()

                ->to(base_url('login'))

                ->with(
                    'error',
                    'Invalid verification link.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | FIND USER BY TOKEN
    |--------------------------------------------------------------------------
    */

        $user = $this->adminUserModel

            ->groupStart()

            ->where(
                'email_verification_code',
                $token
            )

            ->orWhere(
                'login_verification_code',
                $token
            )

            ->groupEnd()

            ->first();

        if (!$user) {

            return redirect()

                ->to(base_url('login'))

                ->with(
                    'error',
                    'Invalid or expired verification link.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | CHECK EXPIRATION
    |--------------------------------------------------------------------------
    */

        $expires = null;

        $type = null;

        /*
    |--------------------------------------------------------------------------
    | EMAIL VERIFICATION
    |--------------------------------------------------------------------------
    */

        if (
            !empty($user['email_verification_code']) &&

            $user['email_verification_code'] === $token
        ) {

            $expires =
                $user['email_verification_expires'];

            $type = 'email';
        }

        /*
    |--------------------------------------------------------------------------
    | LOGIN OTP
    |--------------------------------------------------------------------------
    */ else if (
            !empty($user['login_verification_code']) &&

            $user['login_verification_code'] === $token
        ) {

            $expires =
                $user['login_verification_expires'];

            $type = 'login';
        }

        /*
    |--------------------------------------------------------------------------
    | EXPIRED
    |--------------------------------------------------------------------------
    */

        if (
            !$expires ||

            strtotime($expires) < time()
        ) {

            return redirect()

                ->to(base_url('login'))

                ->with(
                    'error',
                    'Verification link expired.'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | CREATE TEMP SESSION
    |--------------------------------------------------------------------------
    */

        session()->set([

            'verification_user_id' => $user['id'],

            'verification_type' => $type
        ]);

        return view('admin/auth/verify');
    }

    public function verify2fa()
    {
        $session = Services::session();

        if (! $session->get('two_factor_user_id')) {
            return redirect()->to('login');
        }

        if ($this->request->getMethod() === 'POST') {
            // 2FA verification logic here
            return redirect()->to('login');
        }

        return view('admin/auth/verify');
    }

    public function forgotPassword()
    {
        if ($this->request->getMethod() === 'POST') {

            if (! $this->request->isAJAX()) {

                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Invalid request',
                ]);
            }

            $email = trim(
                $this->request->getPost('email')
            );

            /*
        |--------------------------------------------------------------------------
        | VALIDATION
        |--------------------------------------------------------------------------
        */

            $validation = \Config\Services::validation();

            $validation->setRules([

                'email' => [

                    'label' => 'Email Address',

                    'rules' => 'required|valid_email',
                ],
            ]);

            if (! $validation->withRequest($this->request)->run()) {

                return $this->response->setJSON([

                    'status' => false,

                    'errors' => $validation->getErrors(),
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | FIND USER
        |--------------------------------------------------------------------------
        */

            $user = $this->adminUserModel
                ->where('email', $email)
                ->first();

            /*
        |--------------------------------------------------------------------------
        | SECURITY
        |--------------------------------------------------------------------------
        | Do not reveal if email exists
        |--------------------------------------------------------------------------
        */

            if (! $user) {

                return $this->response->setJSON([

                    'status'  => true,

                    'message' => 'If the email exists, a reset link has been sent.',
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | GENERATE TOKEN
        |--------------------------------------------------------------------------
        */

            $token = bin2hex(random_bytes(32));

            $expires = date(
                'Y-m-d H:i:s',
                strtotime('+1 hour')
            );

            /*
        |--------------------------------------------------------------------------
        | SAVE TOKEN
        |--------------------------------------------------------------------------
        */

            $this->adminUserModel->update($user['id'], [

                'reset_token'   => $token,

                'reset_expired' => $expires,
            ]);

            /*
        |--------------------------------------------------------------------------
        | RESET URL
        |--------------------------------------------------------------------------
        */

            $resetUrl = site_url(
                'reset-password/' . $token
            );

            /*
        |--------------------------------------------------------------------------
        | SEND EMAIL
        |--------------------------------------------------------------------------
        */

            $emailService = service('email');

            $emailService->setTo($user['email']);

            $emailService->setSubject(
                'Reset Your Password'
            );

            $emailService->setMessage(

                view('admin/emails/reset_password', [

                    'user'     => $user,

                    'resetUrl' => $resetUrl,

                    'expires'  => $expires,
                ])
            );

            if (! $emailService->send()) {

                log_message(
                    'error',
                    $emailService->printDebugger([
                        'headers',
                    ])
                );

                return $this->response->setJSON([

                    'status'  => false,

                    'message' => 'Unable to send reset email',
                ]);
            }

            return $this->response->setJSON([

                'status'  => true,

                'message' => 'Password reset link sent successfully',
            ]);
        }

        return view('admin/auth/forgotpassword');
    }

    public function resetPassword($token)
    {
        $user = $this->adminUserModel

            ->where('reset_token', $token)

            ->first();

        /*
    |--------------------------------------------------------------------------
    | INVALID TOKEN
    |--------------------------------------------------------------------------
    */

        if (
            ! $user ||

            empty($user['reset_expired']) ||

            strtotime($user['reset_expired']) < time()
        ) {

            return redirect()

                ->to('forgot-password')

                ->with(
                    'error',
                    'Invalid or expired reset token'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | AJAX SUBMIT
    |--------------------------------------------------------------------------
    */

        if ($this->request->getMethod() === 'POST') {

            if (! $this->request->isAJAX()) {

                return $this->response->setJSON([

                    'status'  => false,

                    'message' => 'Invalid request',
                ]);
            }

            $validation = \Config\Services::validation();

            $validation->setRules([

                'password'         => [

                    'label' => 'Password',

                    'rules' =>
                    'required|min_length[8]',
                ],

                'confirm_password' => [

                    'label' => 'Confirm Password',

                    'rules' =>
                    'required|matches[password]',
                ],
            ]);

            if (! $validation->withRequest($this->request)->run()) {

                return $this->response->setJSON([

                    'status' => false,

                    'errors' => $validation->getErrors(),
                ]);
            }

            /*
        |--------------------------------------------------------------------------
        | UPDATE PASSWORD
        |--------------------------------------------------------------------------
        */

            $this->adminUserModel->update($user['id'], [

                'password'      => password_hash(
                    $this->request->getPost('password'),
                    PASSWORD_DEFAULT
                ),

                'reset_token'   => null,

                'reset_expired' => null,
            ]);

            return $this->response->setJSON([

                'status'   => true,

                'message'  => 'Password reset successful',

                'redirect' => site_url('login'),
            ]);
        }

        return view('admin/auth/reset', [

            'token' => $token,
        ]);
    }

    public function logout()
    {
        admin_logout();
        return redirect()->to('login');
    }

    private function setAdminSession(array $user): void
    {
        $session = Services::session();

        /*
    |--------------------------------------------------------------------------
    | GET USER PERMISSIONS
    |--------------------------------------------------------------------------
    */

        $permissions =
            $this->adminUserModel
            ->getUserPermissions(
                $user['id']
            );

        /*
    |--------------------------------------------------------------------------
    | GET ROLE NAME
    |--------------------------------------------------------------------------
    */

        $roleName =
            $this->adminUserModel

            ->select('roles.name')

            ->join(
                'roles',
                'roles.id = admin_users.role_id',
                'left'
            )

            ->where(
                'admin_users.id',
                $user['id']
            )

            ->first();

        /*
    |--------------------------------------------------------------------------
    | SET SESSION DATA
    |--------------------------------------------------------------------------
    */
        $session->set([

            'admin_id' =>
            $user['id'],

            'admin_email' =>
            $user['email'],

            'admin_first_name' =>
            $user['first_name'] ?? '',

            'admin_last_name' =>
            $user['last_name'] ?? '',

            'admin_avatar' =>
            $user['avatar'] ?? '',

            'admin_phone' =>
            $user['phone'] ?? '',

            'admin_status' =>
            $user['status'] ?? '',

            /*
    |--------------------------------------------------------------------------
    | ROLE ID
    |--------------------------------------------------------------------------
    */

            'admin_role' =>
            $user['role_id'] ?? '',

            /*
    |--------------------------------------------------------------------------
    | ROLE NAME
    |--------------------------------------------------------------------------
    */

            'admin_role_name' =>
            $roleName['name'] ?? '',

            /*
    |--------------------------------------------------------------------------
    | FORCE PASSWORD CHANGE
    |--------------------------------------------------------------------------
    */

            'admin_must_change_password' =>

            $user['must_change_password'] ?? 0,

            /*
    |--------------------------------------------------------------------------
    | PERMISSIONS
    |--------------------------------------------------------------------------
    */

            'admin_permissions' =>
            $permissions,

            /*
    |--------------------------------------------------------------------------
    | LOGIN FLAG
    |--------------------------------------------------------------------------
    */

            'is_admin_logged_in' =>
            true
        ]);
        /*
    |--------------------------------------------------------------------------
    | REGENERATE SESSION
    |--------------------------------------------------------------------------
    */

        $session->regenerate();

        /*
    |--------------------------------------------------------------------------
    | UPDATE LAST LOGIN
    |--------------------------------------------------------------------------
    */

        $this->adminUserModel
            ->updateLastLogin(
                $user['id']
            );
    }

    /**
     * Method sendVerificationEmail
     * Sends an account verification email to the specified user with the provided verification code.
     * @param array $user [explicite description]
     * @param string $code [explicite description]
     *
     * @return void
     */
    private function sendVerificationEmail(array $user, string $code)
    {
        $emailService = service('email');

        $verifyUrl = base_url(
            'verification?token=' . $code
        );

        $emailService->setTo($user['email']);

        $emailService->setSubject('Verify Your Account');

        $emailService->setMessage(
            view('admin/emails/verify_account', [
                'fullName'  => $this->adminUserModel->getFullName($user),
                'code'      => $code,
                'verifyUrl' => $verifyUrl,
            ])
        );

        $emailService->send();
    }

    /**
     * Method sendLoginOTPEmail
     * Sends a login OTP email to the user.
     * @param array $user [explicite description]
     * @param string $code [explicite description]
     *
     * @return void
     */
    private function sendLoginOTPEmail(array $user, string $code)
    {
        $emailService = service('email');

        $verifyUrl = base_url(
            'verification?token=' . $code
        );

        $emailService->setTo($user['email']);

        $emailService->setSubject('Login Verification Code');

        $emailService->setMessage(
            view('admin/emails/login_otp', [
                'fullName'  => $this->adminUserModel->getFullName($user),
                'code'      => $code,
                'verifyUrl' => $verifyUrl,
            ])
        );

        $emailService->send();
    }

    public function verifyCode()
    {
        /*
        |--------------------------------------------------------------------------
        | AJAX ONLY
        |--------------------------------------------------------------------------
        */

        if (! $this->request->isAJAX()) {

            return $this->response->setJSON([

                'status'  => false,

                'message' => 'Invalid request',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | INPUT
        |--------------------------------------------------------------------------
        */

        $code = strtoupper(
            trim(
                $this->request->getPost('code')
            )
        );

        $userId = session()->get(
            'verification_user_id'
        );

        $type = session()->get(
            'verification_type'
        );

        /*
        |--------------------------------------------------------------------------
        | SESSION EXPIRED
        |--------------------------------------------------------------------------
        */

        if (! $userId || ! $type) {

            return $this->response->setJSON([

                'status'  => false,

                'message' =>
                'Verification session expired',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VALIDATE CODE LENGTH
        |--------------------------------------------------------------------------
        */

        if (strlen($code) !== 6) {

            return $this->response->setJSON([

                'status' => false,

                'errors' => [

                    'code' =>
                    'Verification code must be 6 characters',
                ],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | GET USER
        |--------------------------------------------------------------------------
        */

        $user = $this->adminUserModel
            ->find($userId);

        if (! $user) {

            return $this->response->setJSON([

                'status'  => false,

                'message' => 'User not found',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | VERIFICATION LOCKED
        |--------------------------------------------------------------------------
        */

        if (
            $this->adminUserModel
            ->isVerificationLocked($user)
        ) {

            return $this->response->setJSON([

                'status'  => false,

                'message' =>
                'Too many failed verification attempts. Please try again later.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | EMAIL VERIFICATION
        |--------------------------------------------------------------------------
        */

        if ($type === 'email') {

            $verified = $this->adminUserModel
                ->verifyEmailCode(
                    $userId,
                    $code
                );
        }

        /*
        |--------------------------------------------------------------------------
        | LOGIN OTP VERIFICATION
        |--------------------------------------------------------------------------
        */ else {

            $verified = $this->adminUserModel
                ->verifyLoginCode(
                    $userId,
                    $code
                );
        }

        /*
        |--------------------------------------------------------------------------
        | INVALID VERIFICATION
        |--------------------------------------------------------------------------
        */

        if (! $verified) {

            /*
            |--------------------------------------------------------------------------
            | INCREMENT FAILED ATTEMPTS
            |--------------------------------------------------------------------------
            */

            $this->adminUserModel
                ->incrementVerificationAttempts(
                    $userId
                );

            /*
            |--------------------------------------------------------------------------
            | REFRESH USER
            |--------------------------------------------------------------------------
            */

            $user = $this->adminUserModel
                ->find($userId);

            /*
            |--------------------------------------------------------------------------
            | LOCKED AFTER FAILURES
            |--------------------------------------------------------------------------
            */

            if (
                $this->adminUserModel
                ->isVerificationLocked($user)
            ) {

                return $this->response->setJSON([

                    'status'  => false,

                    'message' =>
                    'Too many failed attempts. Verification locked for 5 minutes.',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | REMAINING ATTEMPTS
            |--------------------------------------------------------------------------
            */

            $remaining =
                5 - (int) $user['verification_attempts'];

            return $this->response->setJSON([

                'status' => false,

                'errors' => [

                    'code' =>
                    "Invalid or expired verification code. {$remaining} attempts remaining.",
                ],
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | RESET VERIFICATION ATTEMPTS
        |--------------------------------------------------------------------------
        */

        $this->adminUserModel
            ->resetVerificationAttempts(
                $userId
            );

        /*
        |--------------------------------------------------------------------------
        | REFRESH USER
        |--------------------------------------------------------------------------
        */

        $user = $this->adminUserModel
            ->find($userId);




        /*
        |--------------------------------------------------------------------------
        | CREATE LOGIN SESSION
        |--------------------------------------------------------------------------
        */

        $this->setAdminSession($user);

        /*
        |--------------------------------------------------------------------------
        | CLEAN VERIFICATION SESSION
        |--------------------------------------------------------------------------
        */

        session()->remove([

            'verification_user_id',

            'verification_type',

            'last_otp_resend',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SUCCESS RESPONSE
        |--------------------------------------------------------------------------
        */

        return $this->response->setJSON([

            'status'   => true,

            'message'  => 'Verification successful',

            'redirect' => base_url('admin/home'),
        ]);
    }

    // Resend verification code

    public function resendCode()
    {
        if (! $this->request->isAJAX()) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Invalid request',
            ]);
        }

        $userId = session()->get('verification_user_id');

        $type = session()->get('verification_type');

        if (! $userId || ! $type) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Verification session expired',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | RATE LIMIT
        |--------------------------------------------------------------------------
        */

        $lastResend = session()->get('last_otp_resend');

        if ($lastResend && (time() - $lastResend) < 60) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Please wait before requesting another code',
            ]);
        }

        $user = $this->adminUserModel->find($userId);

        if (! $user) {

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'User not found',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | EMAIL VERIFICATION
        |--------------------------------------------------------------------------
        */

        if ($type === 'email') {

            $code = $this->adminUserModel
                ->createEmailVerification($userId);

            $this->sendVerificationEmail($user, $code);
        }

        /*
        |--------------------------------------------------------------------------
        | LOGIN OTP
        |--------------------------------------------------------------------------
    */ else {

            $code = $this->adminUserModel
                ->createLoginVerification($userId);

            $this->sendLoginOTPEmail($user, $code);
        }

        session()->set('last_otp_resend', time());

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'A new verification code has been sent',
        ]);
    }


    // ============================================================
    public function verificationSent()
    {
        /*
    |--------------------------------------------------------------------------
    | VALID VERIFICATION SESSION
    |--------------------------------------------------------------------------
    */

        if (
            !session()->get('verification_user_id')
        ) {

            return redirect()
                ->to(base_url('login'));
        }

        return view(
            'admin/auth/verification_sent'
        );
    }


    // ============================================================
    //CREATE NEW USER EMAIL VERIFICATION VIA LINK
    // ============================================================
    public function verifyEmail($code)
    {
        $user =
            $this->adminUserModel

            ->where(
                'email_verification_code',
                $code
            )

            ->first();

        /*
    |--------------------------------------------------------------------------
    | INVALID CODE
    |--------------------------------------------------------------------------
    */

        if (!$user) {

            return redirect()

                ->to('login')

                ->with(
                    'error',
                    'Invalid verification code'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | EXPIRED
    |--------------------------------------------------------------------------
    */

        if (

            strtotime(
                $user['email_verification_expires']
            ) < time()

        ) {

            return redirect()

                ->to('login')

                ->with(
                    'error',
                    'Verification code expired'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | ALREADY VERIFIED
    |--------------------------------------------------------------------------
    */

        if (
            $user['email_verified']
        ) {

            return redirect()

                ->to('login')

                ->with(
                    'success',
                    'Account already verified'
                );
        }

        /*
    |--------------------------------------------------------------------------
    | VERIFY ACCOUNT
    |--------------------------------------------------------------------------
    */

        $this->adminUserModel
            ->update(
                $user['id'],
                [

                    'email_verified' => 1,

                    'email_verification_code' => null,

                    'email_verification_expires' => null,

                    'verification_attempts' => 0,

                    'verification_locked_until' => null
                ]
            );

        /*
    |--------------------------------------------------------------------------
    | SUCCESS
    |--------------------------------------------------------------------------
    */

        return redirect()

            ->to(base_url('admin'))

            ->with(
                'success',
                'Email verification successful. Please login.'
            );
    }


    public function changeTempPassword()
    {
        /*
    |--------------------------------------------------------------------------
    | CHECK LOGIN
    |--------------------------------------------------------------------------
    */

        if (
            !session('is_admin_logged_in')
        ) {

            return redirect()
                ->to(
                    base_url('admin')
                );
        }

        /*
    |--------------------------------------------------------------------------
    | GET USER
    |--------------------------------------------------------------------------
    */

        $userId =
            session('admin_id');

        $user =
            $this->adminUserModel
            ->find($userId);

        if (!$user) {

            return redirect()
                ->to(
                    base_url('admin')
                );
        }

        /*
    |--------------------------------------------------------------------------
    | PASSWORD ALREADY CHANGED
    |--------------------------------------------------------------------------
    */

        if (
            (int) ($user['must_change_password'] ?? 0) !== 1
        ) {

            return redirect()
                ->to(
                    base_url('admin/home')
                );
        }

        /*
    |--------------------------------------------------------------------------
    | LOAD PAGE
    |--------------------------------------------------------------------------
    */

        if (
            strtolower(
                $this->request
                    ->getMethod()
            ) === 'get'
        ) {

            return view(
                'admin/auth/change_temp_password',
                [

                    'title' =>

                    'Change Temporary Password',

                    'user' => $user
                ]
            );
        }

        /*
    |--------------------------------------------------------------------------
    | AJAX ONLY
    |--------------------------------------------------------------------------
    */

        if (
            !$this->request
                ->isAJAX()
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'message' =>
                    'Invalid request'
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | VALIDATION
    |--------------------------------------------------------------------------
    */

        $rules = [

            'password' =>

            'required|min_length[8]',

            'confirm_password' =>

            'required|matches[password]'
        ];

        if (
            !$this->validate($rules)
        ) {

            return $this->response
                ->setJSON([

                    'status' => false,

                    'errors' =>

                    $this->validator
                        ->getErrors()
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | UPDATE PASSWORD
    |--------------------------------------------------------------------------
    */

        $this->adminUserModel
            ->update($userId, [

                'password' =>

                password_hash(

                    $this->request
                        ->getPost('password'),

                    PASSWORD_DEFAULT
                ),

                'must_change_password' => 0,

                'temp_password_expires' => null
            ]);

        /*
    |--------------------------------------------------------------------------
    | UPDATE SESSION
    |--------------------------------------------------------------------------
    */

        session()->set(

            'admin_must_change_password',

            0
        );

        /*
    |--------------------------------------------------------------------------
    | ACTIVITY LOG
    |--------------------------------------------------------------------------
    */

        activity_log(

            'PASSWORD_CHANGED',

            'AUTH',

            $userId,

            'Temporary password changed'
        );

        /*
    |--------------------------------------------------------------------------
    | RESPONSE
    |--------------------------------------------------------------------------
    */

        return $this->response
            ->setJSON([

                'status' => true,

                'redirect' =>

                base_url(
                    'admin/home'
                ),

                'message' =>

                'Password changed successfully'
            ]);
    }








    // public function changeTempPassword()
    // {
    //     /*
    // |--------------------------------------------------------------------------
    // | CHECK TEMP SESSION
    // |--------------------------------------------------------------------------
    // */

    //     $userId =
    //         session(
    //             'temp_password_user_id'
    //         );

    //     if (!$userId) {

    //         return redirect()
    //             ->to(
    //                 base_url('admin')
    //             );
    //     }

    //     /*
    // |--------------------------------------------------------------------------
    // | FIND USER
    // |--------------------------------------------------------------------------
    // */

    //     $user =
    //         $this->adminUserModel
    //         ->find($userId);

    //     if (!$user) {

    //         return redirect()
    //             ->to(
    //                 base_url('admin')
    //             );
    //     }

    //     /*
    // |--------------------------------------------------------------------------
    // | LOAD PAGE
    // |--------------------------------------------------------------------------
    // */

    //     if (
    //         strtolower(
    //             $this->request
    //                 ->getMethod()
    //         ) === 'get'
    //     ) {

    //         return view(
    //             'admin/auth/change_temp_password',
    //             [

    //                 'title' =>
    //                 'Change Temporary Password',

    //                 'user' => $user
    //             ]
    //         );
    //     }

    //     /*
    // |--------------------------------------------------------------------------
    // | AJAX ONLY
    // |--------------------------------------------------------------------------
    // */

    //     if (
    //         !$this->request
    //             ->isAJAX()
    //     ) {

    //         return $this->response
    //             ->setJSON([

    //                 'status' => false,

    //                 'message' =>
    //                 'Invalid request'
    //             ]);
    //     }

    //     /*
    // |--------------------------------------------------------------------------
    // | VALIDATION
    // |--------------------------------------------------------------------------
    // */

    //     $rules = [

    //         'password' =>

    //         'required|min_length[8]',

    //         'confirm_password' =>

    //         'required|matches[password]'
    //     ];

    //     if (
    //         !$this->validate($rules)
    //     ) {

    //         return $this->response
    //             ->setJSON([

    //                 'status' => false,

    //                 'errors' =>

    //                 $this->validator
    //                     ->getErrors()
    //             ]);
    //     }

    //     /*
    // |--------------------------------------------------------------------------
    // | UPDATE PASSWORD
    // |--------------------------------------------------------------------------
    // */

    //     $this->adminUserModel
    //         ->update($userId, [

    //             'password' =>

    //             password_hash(

    //                 $this->request
    //                     ->getPost('password'),

    //                 PASSWORD_DEFAULT
    //             ),

    //             'must_change_password' => 0,

    //             'temp_password_expires' => null
    //         ]);

    //     /*
    // |--------------------------------------------------------------------------
    // | GENERATE LOGIN VERIFICATION CODE
    // |--------------------------------------------------------------------------
    // */

    //     $verificationCode =

    //         strtoupper(

    //             random_string(
    //                 'alnum',
    //                 6
    //             )
    //         );

    //     /*
    // |--------------------------------------------------------------------------
    // | SAVE LOGIN VERIFICATION
    // |--------------------------------------------------------------------------
    // */

    //     $this->adminUserModel
    //         ->update($userId, [

    //             'login_verification_code' =>

    //             $verificationCode,

    //             'login_verification_expires' =>

    //             date(
    //                 'Y-m-d H:i:s',
    //                 strtotime('+5 minutes')
    //             ),
    //         ]);

    //     /*
    // |--------------------------------------------------------------------------
    // | SEND VERIFICATION EMAIL
    // |--------------------------------------------------------------------------
    // */

    //     $email = service('email');

    //     $email->setTo(
    //         $user['email']
    //     );

    //     $email->setSubject(
    //         'Login Verification Code'
    //     );

    //     $email->setMessage(

    //         view(
    //             'admin/emails/login_verification',
    //             [

    //                 'fullName' =>

    //                 trim(

    //                     ($user['first_name'] ?? '') .
    //                         ' ' .
    //                         ($user['last_name'] ?? '')
    //                 ),

    //                 'code' =>
    //                 $verificationCode,

    //                 'verifyUrl' =>

    //                 base_url(
    //                     'admin/verify-code'
    //                 )
    //             ]
    //         )
    //     );

    //     $email->send();

    //     /*
    // |--------------------------------------------------------------------------
    // | STORE VERIFICATION SESSION
    // |--------------------------------------------------------------------------
    // */

    //     session()->set([

    //         'verification_user_id' =>
    //         $userId,

    //         'verification_type' =>
    //         'login',
    //     ]);

    //     /*
    // |--------------------------------------------------------------------------
    // | REMOVE TEMP SESSION
    // |--------------------------------------------------------------------------
    // */

    //     session()->remove(
    //         'temp_password_user_id'
    //     );

    //     /*
    // |--------------------------------------------------------------------------
    // | ACTIVITY LOG
    // |--------------------------------------------------------------------------
    // */

    //     activity_log(

    //         'PASSWORD_CHANGED',

    //         'AUTH',

    //         $userId,

    //         'Temporary password changed'
    //     );

    //     /*
    // |--------------------------------------------------------------------------
    // | RESPONSE
    // |--------------------------------------------------------------------------
    // */

    //     return $this->response
    //         ->setJSON([

    //             'status' => true,

    //             'redirect' =>

    //             base_url(
    //                 'admin/verify-code'
    //             ),

    //             'message' =>

    //             'Password changed successfully. Verification code sent to email.'
    //         ]);
    // }
}
