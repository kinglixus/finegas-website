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
        $data = [
            'title' => 'Testimonials - Fine Gas',
        ];
        $data = array_merge($data, $this->testimonialModel->getTestimonialPageData());
        return view('pages/testimonial', $data);
    }
}
