<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TestimonialModel;

class Testimonialpage extends BaseController
{
    protected $testimonialModel;

    public function __construct()
    {
        $this->testimonialModel =
            new TestimonialModel();
    }

    public function index()
    {
        $data = [

            'title' => 'Testimonials CMS',

            'page_header' =>
            $this->testimonialModel
                ->getSection(
                    'page_header'
                ),

            'testimonial_header' =>
            $this->testimonialModel
                ->getSection(
                    'testimonial_header'
                ),

            'testimonials' =>
            $this->testimonialModel
                ->getSectionItems(
                    'testimonials'
                )
        ];

        return view(
            'admin/testimonialpage/index',
            $data
        );
    }

    public function pageHeader()
    {
        $pageHeader =
            $this->testimonialModel
            ->getSection(
                'page_header'
            );

        return view(
            'admin/testimonialpage/page_header',
            [
                'title'      => 'Page Header',
                'pageHeader' => $pageHeader
            ]
        );
    }

    public function updatePageHeader()
    {
        $pageHeader =
            $this->testimonialModel
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

        $this->testimonialModel
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
            'TESTIMONIAL_PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Testimonial page header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Page Header updated successfully.'
            );
    }

    public function testimonialHeader()
    {
        $testimonialHeader =
            $this->testimonialModel
            ->getSection(
                'testimonial_header'
            );

        return view(
            'admin/testimonialpage/testimonial_header',
            [
                'title'             => 'Testimonial Header',
                'testimonialHeader' => $testimonialHeader
            ]
        );
    }

    public function updateTestimonialHeader()
    {
        $testimonialHeader =
            $this->testimonialModel
            ->getSection(
                'testimonial_header'
            );

        if (!$testimonialHeader) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Testimonial Header not found.'
                );
        }

        $this->testimonialModel
            ->update(
                $testimonialHeader['id'],
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
            'TESTIMONIAL_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Testimonial header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Testimonial Header updated successfully.'
            );
    }

    public function testimonials()
    {
        $data = [

            'title' => 'Testimonials',

            'testimonials' =>

            $this->testimonialModel

                ->where(
                    'section_name',
                    'testimonials'
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
            'admin/testimonialpage/testimonial',
            $data
        );
    }


    public function createTestimonial()
    {
        return view(
            'admin/testimonialpage/testimonials_create',
            [
                'title' => 'Create Testimonial'
            ]
        );
    }

    public function storeTestimonial()
    {
        $image = $this->request->getFile('image');

        $imagePath = null;

        if ($image && $image->isValid()) {

            $newName = $image->getRandomName();

            $image->move(
                FCPATH . 'uploads/testimonials',
                $newName
            );

            $imagePath =
                'uploads/testimonials/' .
                $newName;
        }

        $this->testimonialModel->insert([

            'section_name' => 'testimonials',

            'section_type' => 'item',

            'title' =>
            $this->request
                ->getPost('title'),

            'subtitle' =>
            $this->request
                ->getPost('subtitle'),

            'description' =>
            $this->request
                ->getPost('description'),

            'image' => $imagePath,

            'icon' =>
            $this->request
                ->getPost('icon'),

            'sort_order' =>
            $this->request
                ->getPost('sort_order'),

            'status' =>
            $this->request
                ->getPost('status')
        ]);

        activity_log(
            'TESTIMONIAL_CREATED',
            'CMS',
            session('admin_id'),
            'Testimonial created'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/testimonialpage/testimonial'
                )
            )
            ->with(
                'success',
                'Testimonial created successfully.'
            );
    }

    public function editTestimonial($id)
    {
        $testimonial =
            $this->testimonialModel
            ->find($id);

        if (!$testimonial) {
            return redirect()
                ->to(
                    base_url(
                        'admin/testimonialpage/testimonials'
                    )
                )
                ->with(
                    'error',
                    'Testimonial not found.'
                );
        }

        return view(
            'admin/testimonialpage/testimonials_edit',
            [
                'title'       => 'Edit Testimonial',
                'testimonial' => $testimonial
            ]
        );
    }

    public function updateTestimonial($id)
    {
        $testimonial =
            $this->testimonialModel
            ->find($id);

        if (!$testimonial) {
            return redirect()
                ->to(
                    base_url(
                        'admin/testimonialpage/testimonial'
                    )
                )
                ->with(
                    'error',
                    'Testimonial not found.'
                );
        }

        $data = [

            'title' =>
            $this->request
                ->getPost('title'),

            'subtitle' =>
            $this->request
                ->getPost('subtitle'),

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
        ];

        $image =
            $this->request
            ->getFile('image');

        if ($image && $image->isValid()) {
            $newName =
                $image->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/testimonials',
                $newName
            );

            $data['image'] =
                'uploads/testimonials/' .
                $newName;
        }

        $this->testimonialModel
            ->update(
                $id,
                $data
            );

        activity_log(
            'TESTIMONIAL_UPDATED',
            'CMS',
            session('admin_id'),
            'Testimonial updated'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/testimonialpage/testimonial'
                )
            )
            ->with(
                'success',
                'Testimonial updated successfully.'
            );
    }

    public function deleteTestimonial($id)
    {
        $testimonial =
            $this->testimonialModel
            ->find($id);

        if (!$testimonial) {
            return $this->response
                ->setJSON([
                    'status' => false
                ]);
        }

        $this->testimonialModel
            ->delete($id);

        activity_log(
            'TESTIMONIAL_DELETED',
            'CMS',
            session('admin_id'),
            'Testimonial deleted'
        );

        return $this->response
            ->setJSON([
                'status' => true
            ]);
    }
}