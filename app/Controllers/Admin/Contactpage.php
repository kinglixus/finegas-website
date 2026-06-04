<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ContactModel;

class Contactpage extends BaseController
{
    protected $contactModel;

    public function __construct()
    {
        $this->contactModel =
            new ContactModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Contact Page CMS',

            'page_header' =>
            $this->contactModel
                ->getSection(
                    'page_header'
                ),

            'contact_intro' =>
            $this->contactModel
                ->getSection(
                    'contact_intro'
                ),

            'contact_info' =>
            $this->contactModel
                ->getSectionItems(
                    'contact_info'
                )
        ];

        return view(
            'admin/contactpage/index',
            $data
        );
    }

    public function pageHeader()
    {
        $pageHeader =
            $this->contactModel
            ->getSection(
                'page_header'
            );

        return view(
            'admin/contactpage/page_header',
            [
                'title'      => 'Page Header',
                'pageHeader' => $pageHeader
            ]
        );
    }

    public function updatePageHeader()
    {
        $pageHeader =
            $this->contactModel
            ->getSection(
                'page_header'
            );

        if (!$pageHeader) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Page Header not found.'
                );
        }

        $this->contactModel
            ->update(
                $pageHeader['id'],
                [

                    'title' =>
                    $this->request
                        ->getPost('title'),

                    'subtitle' =>
                    $this->request
                        ->getPost('subtitle'),

                    'description' =>
                    $this->request
                        ->getPost('description'),

                    'status' =>
                    $this->request
                        ->getPost('status')
                ]
            );

        activity_log(
            'CONTACT_PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Contact page header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Page Header updated successfully.'
            );
    }

    public function contactIntro()
    {
        $contactIntro =
            $this->contactModel
            ->getSection(
                'contact_intro'
            );

        return view(
            'admin/contactpage/contact_intro',
            [
                'title'        => 'Contact Intro',
                'contactIntro' => $contactIntro
            ]
        );
    }

    public function updateContactIntro()
    {
        $contactIntro =
            $this->contactModel
            ->getSection(
                'contact_intro'
            );

        if (!$contactIntro) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Contact Intro not found.'
                );
        }

        $this->contactModel
            ->update(
                $contactIntro['id'],
                [

                    'title' =>
                    $this->request
                        ->getPost('title'),

                    'subtitle' =>
                    $this->request
                        ->getPost('subtitle'),

                    'description' =>
                    $this->request
                        ->getPost('description'),

                    'status' =>
                    $this->request
                        ->getPost('status')
                ]
            );

        activity_log(
            'CONTACT_INTRO_UPDATED',
            'CMS',
            session('admin_id'),
            'Contact intro updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Contact Intro updated successfully.'
            );
    }

    public function contactInfo()
    {
        $data = [

            'title' => 'Contact Information',

            'contactInfo' =>

            $this->contactModel

                ->where(
                    'section_name',
                    'contact_info'
                )

                ->where(
                    'section_type',
                    'item'
                )

                ->orderBy(
                    'sort_order',
                    'ASC'
                )

                ->findAll()
        ];

        return view(
            'admin/contactpage/contact_info',
            $data
        );
    }


    public function createContactInfo()
    {
        return view(
            'admin/contactpage/contact_info_create',
            [
                'title' => 'Create Contact Information'
            ]
        );
    }


    public function storeContactInfo()
    {
        $this->contactModel
            ->insert([

                'section_name' =>
                'contact_info',

                'section_type' =>
                'item',

                'title' =>
                $this->request
                    ->getPost(
                        'title'
                    ),

                'description' =>
                $this->request
                    ->getPost(
                        'description'
                    ),

                'icon' =>
                $this->request
                    ->getPost(
                        'icon'
                    ),

                'sort_order' =>
                $this->request
                    ->getPost(
                        'sort_order'
                    ),

                'status' =>
                $this->request
                    ->getPost(
                        'status'
                    )
            ]);

        activity_log(
            'CONTACT_INFO_CREATED',
            'CMS',
            session('admin_id'),
            'Contact information created'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/contactpage/contact-info'
                )
            )
            ->with(
                'success',
                'Contact information created successfully.'
            );
    }

    public function editContactInfo($id)
    {
        $contactInfo =
            $this->contactModel
            ->find($id);

        if (!$contactInfo) {
            return redirect()
                ->to(
                    base_url(
                        'admin/contactpage/contact-info'
                    )
                )
                ->with(
                    'error',
                    'Contact information not found.'
                );
        }

        return view(
            'admin/contactpage/contact_info_edit',
            [
                'title'       => 'Edit Contact Information',
                'contactInfo' => $contactInfo
            ]
        );
    }


    public function updateContactInfo($id)
    {
        $contactInfo =
            $this->contactModel
            ->find($id);

        if (!$contactInfo) {
            return redirect()
                ->to(
                    base_url(
                        'admin/contactpage/contact-info'
                    )
                )
                ->with(
                    'error',
                    'Contact information not found.'
                );
        }

        $this->contactModel
            ->update(
                $id,
                [

                    'title' =>
                    $this->request
                        ->getPost('title'),

                    'description' =>
                    $this->request
                        ->getPost('description'),

                    'icon' =>
                    $this->request
                        ->getPost('icon'),

                    'sort_order' =>
                    $this->request
                        ->getPost('sort_order'),

                    'status' =>
                    $this->request
                        ->getPost('status')
                ]
            );

        activity_log(
            'CONTACT_INFO_UPDATED',
            'CMS',
            session('admin_id'),
            'Contact information updated'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/contactpage/contact-info'
                )
            )
            ->with(
                'success',
                'Contact information updated successfully.'
            );
    }

    public function deleteContactInfo($id)
    {
        $contactInfo =
            $this->contactModel
            ->find($id);

        if (!$contactInfo) {
            return $this->response
                ->setJSON([
                    'status' => false
                ]);
        }

        $this->contactModel
            ->delete($id);

        activity_log(
            'CONTACT_INFO_DELETED',
            'CMS',
            session('admin_id'),
            'Contact information deleted'
        );

        return $this->response
            ->setJSON([
                'status' => true
            ]);
    }
}
