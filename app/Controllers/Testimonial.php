<?php

namespace App\Controllers;

use App\Models\TestimonialModel;

class Testimonial extends BaseController
{
    protected $testimonialModel;

    public function __construct()
    {
        $this->testimonialModel = new TestimonialModel();
    }

    public function index()
    {
        $testimonialData = $this->testimonialModel->getTestimonialPageData();

        $data = [
            'title' => ($testimonialData['page_header']['title'] ?? 'Testimonials') . ' - Fine Gas',
        ];

        $data = array_merge($data, $testimonialData);

        return view('pages/testimonial', $data);
    }
}
