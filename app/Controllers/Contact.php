<?php

namespace App\Controllers;

use App\Models\ContactModel;
use App\Models\ContactMessageModel;

class Contact extends BaseController
{
    protected $contactModel;
    protected $contactMessageModel;

    public function __construct()
    {
        $this->contactModel = new ContactModel();
        $this->contactMessageModel = new ContactMessageModel();
    }

    public function index()
    {
        $contactData = $this->contactModel->getContactPageData();

        $data = [
            'title' => ($contactData['page_header']['title'] ?? 'Contact Us') . ' - Fine Gas',
        ];

        $data = array_merge($data, $contactData);

        return view('pages/contact', $data);
    }

    public function submit()
    {
        if (
            $this->request->getHeaderLine('X-Requested-With')
            !== 'XMLHttpRequest'
        ) {
            return $this->response
                ->setStatusCode(403)
                ->setJSON([
                    'status'  => false,
                    'message' => 'Invalid request.'
                ]);
        }

        /*
|--------------------------------------------------------------------------
| HONEYPOT SPAM CHECK
|--------------------------------------------------------------------------
*/

        if (!empty($this->request->getPost('website'))) {

            return $this->response
                ->setJSON([
                    'status'  => false,
                    'message' => 'Spam detected.'
                ]);
        }
        /*
        |--------------------------------------------------------------------------
        | RECAPTCHA VALIDATION
        |--------------------------------------------------------------------------
        */

        $captchaResponse =
            $this->request
            ->getPost('g-recaptcha-response');

        if (empty($captchaResponse)) {

            return $this->response
                ->setJSON([
                    'status'  => false,
                    'message' => 'Please verify that you are not a robot.'
                ]);
        }

        $client =
            \Config\Services::curlrequest();

        $response =
            $client->post(
                'https://www.google.com/recaptcha/api/siteverify',
                [
                    'form_params' => [
                        'secret'   => env('RECAPTCHA_SECRET_KEY'),
                        'response' => $captchaResponse,
                        'remoteip' => $this->request->getIPAddress(),
                    ]
                ]
            );

        $result =
            json_decode(
                $response->getBody(),
                true
            );

        if (empty($result['success'])) {

            return $this->response
                ->setJSON([
                    'status'  => false,
                    'message' => 'Captcha validation failed.'
                ]);
        }



        // VALIDATION RULES
        $rules = [
            'name' => [
                'label' => 'Your Name',
                'rules' => 'required|min_length[2]|max_length[150]',
            ],
            'email' => [
                'label' => 'Your Email',
                'rules' => 'required|valid_email|max_length[150]',
            ],
            'location' => [
                'label' => 'Your Location',
                'rules' => 'required|min_length[2]|max_length[255]',
            ],
            'subject' => [
                'label' => 'Subject',
                'rules' => 'required|min_length[3]|max_length[255]',
            ],
            'message' => [
                'label' => 'Message',
                'rules' => 'required|min_length[10]',
            ],
        ];

        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(422)->setJSON([
                'status'  => false,
                'message' => 'Please correct the highlighted fields.',
                'errors'  => $this->validator->getErrors(),
            ]);
        }

        $name     = trim($this->request->getPost('name'));
        $email    = trim($this->request->getPost('email'));
        $location = trim($this->request->getPost('location'));
        $subject  = trim($this->request->getPost('subject'));
        $message  = trim($this->request->getPost('message'));

        $messageData = [
            'name'       => $name,
            'email'      => $email,
            'location'   => $location,
            'subject'    => $subject,
            'message'    => $message,
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => (string) $this->request->getUserAgent(),
            'status'     => 'new',
            'is_read'    => 0,
        ];

        $this->contactMessageModel->insert($messageData);

        $messageId = $this->contactMessageModel->getInsertID();

        $emailSent = $this->sendContactNotificationEmail([
            'id'         => $messageId,
            'name'       => $name,
            'email'      => $email,
            'location'   => $location,
            'subject'    => $subject,
            'message'    => $message,
            'ip_address' => $messageData['ip_address'],
            'user_agent' => $messageData['user_agent'],
        ]);

        if (!$emailSent) {
            return $this->response->setJSON([
                'status'     => true,
                'email_sent' => false,
                'message'    => 'Thank you. Your message has been received successfully.',
            ]);
        }

        return $this->response->setJSON([
            'status'     => true,
            'email_sent' => true,
            'message'    => 'Thank you. Your message has been sent successfully.',
        ]);
    }

    private function sendContactNotificationEmail(array $data): bool
    {
        $emailService = service('email');

        $recipients = env('contact.emailRecipients');

        if (empty($recipients)) {
            $recipients = 'sales@finegasgh.com,info@finegasgh.com';
        }

        $recipientList = array_filter(array_map('trim', explode(',', $recipients)));

        if (empty($recipientList)) {
            return false;
        }

        $fromEmail = env('contact.emailFrom') ?: 'noreply@finegasgh.com';
        $fromName  = env('contact.emailFromName') ?: 'Fine Gas Website';

        $emailSubject = 'New Contact Form Message: ' . $data['subject'];

        $emailBody = view('emails/contact_notification', [
            'contact' => $data,
        ]);

        $emailService->clear(true);
        $emailService->setMailType('html');
        $emailService->setFrom($fromEmail, $fromName);
        $emailService->setTo($recipientList);
        $emailService->setReplyTo($data['email'], $data['name']);
        $emailService->setSubject($emailSubject);
        $emailService->setMessage($emailBody);

        return $emailService->send(false);
    }
}
