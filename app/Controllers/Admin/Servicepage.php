<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Servicepage extends BaseController
{
    protected $serviceModel;

    public function __construct()
    {
        $this->serviceModel =
            new ServiceModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Services Page CMS',

            'page_header' =>
            $this->serviceModel
                ->getSection(
                    'page_header'
                ),

            'service_header' =>
            $this->serviceModel
                ->getSection(
                    'service_header'
                ),

            'services' =>
            $this->serviceModel
                ->getSectionItems(
                    'services'
                )
        ];

        return view(
            'admin/servicepage/index',
            $data
        );
    }


    public function pageHeader()
    {
        $pageHeader = $this->serviceModel
            ->getSection(
                'page_header'
            );

        return view(
            'admin/servicepage/page_header',
            [
                'title'      => 'Page Header',
                'pageHeader' => $pageHeader
            ]
        );
    }

    public function updatePageHeader()
    {
        $pageHeader = $this->serviceModel
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

        $this->serviceModel
            ->update(
                $pageHeader['id'],
                [

                    'title' =>
                    $this->request
                        ->getPost(
                            'title'
                        ),

                    'subtitle' =>
                    $this->request
                        ->getPost(
                            'subtitle'
                        ),

                    'description' =>
                    $this->request
                        ->getPost(
                            'description'
                        ),

                    'status' =>
                    $this->request
                        ->getPost(
                            'status'
                        )
                ]
            );

        activity_log(
            'SERVICE_PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Service page header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Page Header updated successfully.'
            );
    }


    public function serviceHeader()
    {
        $serviceHeader = $this->serviceModel
            ->getSection(
                'service_header'
            );

        return view(
            'admin/servicepage/service_header',
            [
                'title'         => 'Service Header',
                'serviceHeader' => $serviceHeader
            ]
        );
    }


    public function updateServiceHeader()
    {
        $serviceHeader = $this->serviceModel
            ->getSection(
                'service_header'
            );

        if (!$serviceHeader) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Service Header not found.'
                );
        }

        $this->serviceModel
            ->update(
                $serviceHeader['id'],
                [

                    'title' =>
                    $this->request
                        ->getPost(
                            'title'
                        ),

                    'subtitle' =>
                    $this->request
                        ->getPost(
                            'subtitle'
                        ),

                    'description' =>
                    $this->request
                        ->getPost(
                            'description'
                        ),

                    'status' =>
                    $this->request
                        ->getPost(
                            'status'
                        )
                ]
            );

        activity_log(
            'SERVICE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Service header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Service Header updated successfully.'
            );
    }

    public function services()
    {
        $data = [

            'title' => 'Services',

            'services' =>

            $this->serviceModel

                ->where(
                    'section_name',
                    'services'
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
            'admin/servicepage/services',
            $data
        );
    }


    public function createService()
    {
        return view(
            'admin/servicepage/service_create',
            [
                'title' => 'Create Service'
            ]
        );
    }


    public function storeService()
    {
        $image =
            $this->request
            ->getFile('image');

        $imagePath = null;

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {

            $newName =
                $image->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/services',
                $newName
            );

            $imagePath =
                'uploads/services/' .
                $newName;
        }

        $this->serviceModel
            ->insert([

                'section_name' =>
                'services',

                'section_type' =>
                'item',

                'title' =>
                $this->request->getPost('title'),

                'description' =>
                $this->request->getPost('description'),

                'image' =>
                $imagePath,

                'icon' =>
                $this->request->getPost('icon'),

                'button_text' =>
                $this->request->getPost('button_text'),

                'button_url' =>
                $this->request->getPost('button_url'),

                'sort_order' =>
                $this->request->getPost('sort_order'),

                'status' =>
                $this->request->getPost('status')
            ]);

        activity_log(
            'SERVICE_CREATED',
            'CMS',
            session('admin_id'),
            'Service page service created'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/servicepage/services'
                )
            )
            ->with(
                'success',
                'Service created successfully.'
            );
    }

    public function editService($id)
    {
        $service = $this->serviceModel
            ->find($id);

        if (!$service) {
            return redirect()
                ->to(
                    base_url(
                        'admin/servicepage/services'
                    )
                )
                ->with(
                    'error',
                    'Service not found.'
                );
        }

        return view(
            'admin/servicepage/service_edit',
            [
                'title'   => 'Edit Service',
                'service' => $service
            ]
        );
    }

    public function updateService($id)
    {
        $service = $this->serviceModel
            ->find($id);

        if (!$service) {
            return redirect()
                ->to(
                    base_url(
                        'admin/servicepage/services'
                    )
                )
                ->with(
                    'error',
                    'Service not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost('title'),

            'description' =>
            $this->request
                ->getPost('description'),

            'icon' =>
            $this->request
                ->getPost('icon'),

            'button_text' =>
            $this->request
                ->getPost('button_text'),

            'button_url' =>
            $this->request
                ->getPost('button_url'),

            'sort_order' =>
            $this->request
                ->getPost('sort_order'),

            'status' =>
            $this->request
                ->getPost('status')
        ];

        /*
    |--------------------------------------------------------------------------
    | IMAGE REPLACEMENT
    |--------------------------------------------------------------------------
    */

        $image =
            $this->request
            ->getFile('image');

        if (
            $image &&
            $image->isValid() &&
            !$image->hasMoved()
        ) {
            if (
                !empty($service['image'])
                &&
                file_exists(
                    FCPATH .
                        $service['image']
                )
            ) {
                unlink(
                    FCPATH .
                        $service['image']
                );
            }

            $newName =
                $image
                ->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/services',
                $newName
            );

            $data['image'] =
                'uploads/services/' .
                $newName;
        }

        $this->serviceModel
            ->update(
                $id,
                $data
            );

        activity_log(
            'SERVICE_UPDATED',
            'CMS',
            session('admin_id'),
            'Service page service updated'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/servicepage/services'
                )
            )
            ->with(
                'success',
                'Service updated successfully.'
            );
    }

    public function deleteService($id)
    {
        $service = $this->serviceModel
            ->find($id);

        if (!$service) {
            return $this->response
                ->setJSON([
                    'status' => false
                ]);
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE IMAGE
    |--------------------------------------------------------------------------
    */

        if (
            !empty($service['image'])
            &&
            file_exists(
                FCPATH .
                    $service['image']
            )
        ) {
            unlink(
                FCPATH .
                    $service['image']
            );
        }

        /*
    |--------------------------------------------------------------------------
    | DELETE RECORD
    |--------------------------------------------------------------------------
    */

        $this->serviceModel
            ->delete($id);

        activity_log(
            'SERVICE_DELETED',
            'CMS',
            session('admin_id'),
            'Service page service deleted'
        );

        return $this->response
            ->setJSON([
                'status' => true
            ]);
    }
}
