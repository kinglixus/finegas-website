<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\SafetyModel;

class Safetypage extends BaseController
{
    protected $safetyModel;

    public function __construct()
    {
        $this->safetyModel = new SafetyModel();
    }

    public function index()
    {
        $data = [
            'title'             => 'Safety Tips CMS',
            'page_header'       => $this->safetyModel->getSection('page_header'),
            'safety_header'     => $this->safetyModel->getSection('safety_header'),
            'safety_tips'       => $this->safetyModel->getSectionItems('safety_tips'),
            'emergency_header'  => $this->safetyModel->getSection('emergency_header'),
            'emergency_contact' => $this->safetyModel->getSection('emergency_contact'),
        ];

        return view('admin/safetypage/index', $data);
    }

    public function pageHeader()
    {
        $data = [
            'title'       => 'Safety Page Header',
            'page_header' => $this->safetyModel->getSection('page_header'),
        ];

        return view('admin/safetypage/page_header', $data);
    }

    public function updatePageHeader()
    {
        $pageHeader = $this->safetyModel
            ->where('section_name', 'page_header')
            ->where('section_type', 'section')
            ->first();

        if (!$pageHeader) {
            return redirect()
                ->back()
                ->with('error', 'Page Header not found.');
        }

        $extraData = [
            'breadcrumbs' => [
                [
                    'label' => 'Home',
                    'url'   => '/',
                ],
                [
                    'label' => $this->request->getPost('title') ?: 'Safety Tips',
                    'url'   => null,
                ],
            ],
        ];

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'extra_data'  => json_encode($extraData),
            'status'      => $this->request->getPost('status'),
        ];

        $image = $this->request->getFile('image');

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {
            $imagePath = $this->uploadImage(
                $image,
                'page_headers',
                $pageHeader['image'] ?? null
            );

            if (!empty($imagePath)) {
                $data['image'] = $imagePath;
            }
        }

        $this->safetyModel->update($pageHeader['id'], $data);

        activity_log(
            'SAFETY_PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Safety page header updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Page Header updated successfully.');
    }

    public function safetyHeader()
    {
        $data = [
            'title'         => 'Safety Tips Header',
            'safety_header' => $this->safetyModel->getSection('safety_header'),
        ];

        return view('admin/safetypage/safety_header', $data);
    }

    public function updateSafetyHeader()
    {
        $safetyHeader = $this->safetyModel
            ->where('section_name', 'safety_header')
            ->where('section_type', 'section')
            ->first();

        if (!$safetyHeader) {
            return redirect()
                ->back()
                ->with('error', 'Safety Header not found.');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];

        $this->safetyModel->update($safetyHeader['id'], $data);

        activity_log(
            'SAFETY_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Safety tips header updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Safety Header updated successfully.');
    }

    public function safetyTips()
    {
        $data = [
            'title'       => 'Safety Tips',
            'safety_tips' => $this->safetyModel
                ->where('section_name', 'safety_tips')
                ->where('section_type', 'item')
                ->orderBy('sort_order', 'ASC')
                ->findAll(),
        ];

        return view('admin/safetypage/safety_tips', $data);
    }

    public function createSafetyTip()
    {
        $data = [
            'title' => 'Add Safety Tip',
        ];

        return view('admin/safetypage/create_safety_tip', $data);
    }

    public function storeSafetyTip()
    {
        $extraData = [
            'animation_delay' => $this->request->getPost('animation_delay') ?: '0.1s',
        ];

        $data = [
            'section_name' => 'safety_tips',
            'section_type' => 'item',
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'description'  => $this->request->getPost('description'),
            'icon'         => $this->request->getPost('icon') ?: 'fa fa-check-circle',
            'button_text'  => $this->request->getPost('button_text'),
            'button_url'   => $this->request->getPost('button_url'),
            'extra_data'   => json_encode($extraData),
            'sort_order'   => $this->request->getPost('sort_order') ?: 0,
            'status'       => $this->request->getPost('status'),
        ];

        $this->safetyModel->insert($data);

        activity_log(
            'SAFETY_TIP_CREATED',
            'CMS',
            session('admin_id'),
            'Safety tip created'
        );

        return redirect()
            ->to(base_url('admin/safetypage/safety-tips'))
            ->with('success', 'Safety Tip created successfully.');
    }

    public function editSafetyTip($id)
    {
        $safetyTip = $this->safetyModel->find($id);

        if (!$safetyTip) {
            return redirect()
                ->to(base_url('admin/safetypage/safety-tips'))
                ->with('error', 'Safety Tip not found.');
        }

        if (!empty($safetyTip['extra_data'])) {
            $decoded = json_decode($safetyTip['extra_data'], true);
            $safetyTip['extra_data'] = is_array($decoded) ? $decoded : [];
        } else {
            $safetyTip['extra_data'] = [];
        }

        $data = [
            'title'      => 'Edit Safety Tip',
            'safety_tip' => $safetyTip,
        ];

        return view('admin/safetypage/edit_safety_tip', $data);
    }

    public function updateSafetyTip($id)
    {
        $safetyTip = $this->safetyModel->find($id);

        if (!$safetyTip) {
            return redirect()
                ->to(base_url('admin/safetypage/safety-tips'))
                ->with('error', 'Safety Tip not found.');
        }

        $extraData = [
            'animation_delay' => $this->request->getPost('animation_delay') ?: '0.1s',
        ];

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon') ?: 'fa fa-check-circle',
            'button_text' => $this->request->getPost('button_text'),
            'button_url'  => $this->request->getPost('button_url'),
            'extra_data'  => json_encode($extraData),
            'sort_order'  => $this->request->getPost('sort_order') ?: 0,
            'status'      => $this->request->getPost('status'),
        ];

        $this->safetyModel->update($id, $data);

        activity_log(
            'SAFETY_TIP_UPDATED',
            'CMS',
            session('admin_id'),
            'Safety tip updated'
        );

        return redirect()
            ->to(base_url('admin/safetypage/safety-tips'))
            ->with('success', 'Safety Tip updated successfully.');
    }

    public function deleteSafetyTip($id)
    {
        $safetyTip = $this->safetyModel->find($id);

        if (!$safetyTip) {
            return $this->response
                ->setJSON([
                    'status'  => false,
                    'message' => 'Safety Tip not found.',
                ]);
        }

        $this->safetyModel->delete($id);

        activity_log(
            'SAFETY_TIP_DELETED',
            'CMS',
            session('admin_id'),
            'Safety tip deleted'
        );

        return $this->response
            ->setJSON([
                'status'  => true,
                'message' => 'Safety Tip deleted successfully.',
            ]);
    }

    public function emergencyHeader()
    {
        $data = [
            'title'            => 'Emergency Header',
            'emergency_header' => $this->safetyModel->getSection('emergency_header'),
        ];

        return view('admin/safetypage/emergency_header', $data);
    }

    public function updateEmergencyHeader()
    {
        $emergencyHeader = $this->safetyModel
            ->where('section_name', 'emergency_header')
            ->where('section_type', 'section')
            ->first();

        if (!$emergencyHeader) {
            return redirect()
                ->back()
                ->with('error', 'Emergency Header not found.');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];

        $this->safetyModel->update($emergencyHeader['id'], $data);

        activity_log(
            'EMERGENCY_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Emergency header updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Emergency Header updated successfully.');
    }

    public function emergencyContact()
    {
        $emergencyContact = $this->safetyModel->getSection('emergency_contact');

        $data = [
            'title'             => 'Emergency Contact',
            'emergency_contact' => $emergencyContact,
        ];

        return view('admin/safetypage/emergency_contact', $data);
    }

    public function updateEmergencyContact()
    {
        $emergencyContact = $this->safetyModel
            ->where('section_name', 'emergency_contact')
            ->where('section_type', 'section')
            ->first();

        if (!$emergencyContact) {
            return redirect()
                ->back()
                ->with('error', 'Emergency Contact not found.');
        }

        $contacts = [
            [
                'label'       => $this->request->getPost('contact_label_1'),
                'number'      => $this->request->getPost('contact_number_1'),
                'heading_tag' => $this->request->getPost('heading_tag_1') ?: 'h2',
            ],
            [
                'label'       => $this->request->getPost('contact_label_2'),
                'number'      => $this->request->getPost('contact_number_2'),
                'heading_tag' => $this->request->getPost('heading_tag_2') ?: 'h4',
            ],
            [
                'label'       => $this->request->getPost('contact_label_3'),
                'number'      => $this->request->getPost('contact_number_3'),
                'heading_tag' => $this->request->getPost('heading_tag_3') ?: 'h4',
            ],
        ];

        $extraData = [
            'contacts'       => $contacts,
            'box_background' => $this->request->getPost('box_background') ?: '#395555',
            'box_text_color' => $this->request->getPost('box_text_color') ?: '#ffffff',
        ];

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'icon'        => $this->request->getPost('icon') ?: 'fa fa-phone-alt',
            'button_text' => $this->request->getPost('button_text'),
            'button_url'  => $this->request->getPost('button_url'),
            'extra_data'  => json_encode($extraData),
            'status'      => $this->request->getPost('status'),
        ];

        $this->safetyModel->update($emergencyContact['id'], $data);

        activity_log(
            'EMERGENCY_CONTACT_UPDATED',
            'CMS',
            session('admin_id'),
            'Emergency contact updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Emergency Contact updated successfully.');
    }

    private function uploadImage($image, string $folder, ?string $oldImage = null): ?string
    {
        $allowedTypes = [
            'image/jpg',
            'image/jpeg',
            'image/png',
            'image/webp',
        ];

        if (!in_array($image->getMimeType(), $allowedTypes, true)) {
            return null;
        }

        $folder = trim($folder, '/');

        $uploadPath = FCPATH . 'uploads/' . $folder;

        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        if (
            !empty($oldImage) &&
            file_exists(FCPATH . $oldImage)
        ) {
            unlink(FCPATH . $oldImage);
        }

        $newName = $image->getRandomName();

        $image->move($uploadPath, $newName);

        return 'uploads/' . $folder . '/' . $newName;
    }
}
