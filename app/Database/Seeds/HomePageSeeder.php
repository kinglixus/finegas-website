<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class HomePageSeeder extends Seeder
{
    public function run()
    {
        /*
        |--------------------------------------------------------------------------
        | Sliders
        |--------------------------------------------------------------------------
        */
        $this->db->table('home_sliders')->insertBatch([
            [
                'title'       => 'Reliable LPG Cylinder Distribution Services',
                'description' => 'Fine Gas Ghana provides safe, fast, and reliable LPG cylinder distribution services for homes, restaurants, and businesses across Tema and surrounding communities.',
                'image'       => 'public/assets/img/carousel-1.jpg',
                'button_text' => 'Read More',
                'button_url'  => '#',
                'sort_order'  => 1,
                'status'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Safe & Certified Gas Cylinder Solutions',
                'description' => 'We are committed to delivering high-quality LPG cylinders with safety, reliability, and customer satisfaction as our top priorities.',
                'image'       => 'public/assets/img/carousel-2.jpg',
                'button_text' => 'Read More',
                'button_url'  => '#',
                'sort_order'  => 2,
                'status'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'title'       => 'Trusted Energy Partner For Homes & Businesses',
                'description' => 'From LPG cylinder refilling to fast delivery services, Fine Gas Ghana provides dependable energy solutions tailored to meet your everyday needs.',
                'image'       => 'public/assets/img/carousel-3.jpg',
                'button_text' => 'Read More',
                'button_url'  => '#',
                'sort_order'  => 3,
                'status'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Statistics
        |--------------------------------------------------------------------------
        */
        $this->db->table('home_statistics')->insertBatch([
            [
                'icon'        => 'fa fa-users',
                'number'      => 3453,
                'title'       => 'Happy Customers',
                'description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit',
                'sort_order'  => 1,
                'status'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'icon'        => 'fa fa-check',
                'number'      => 4234,
                'title'       => 'Project Done',
                'description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit',
                'sort_order'  => 2,
                'status'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'icon'        => 'fa fa-award',
                'number'      => 3123,
                'title'       => 'Awards Win',
                'description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit',
                'sort_order'  => 3,
                'status'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
            [
                'icon'        => 'fa fa-users-cog',
                'number'      => 1831,
                'title'       => 'Expert Workers',
                'description' => 'Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit',
                'sort_order'  => 4,
                'status'      => 1,
                'created_at'  => date('Y-m-d H:i:s'),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | About Section
        |--------------------------------------------------------------------------
        */
        $this->db->table('home_about')->insert([
            'section_label' => 'About Us',
            'title'         => 'Your Trusted LPG Cylinder Distribution Partner',
            'description'   => 'FINE GAS is a leading LPG cylinder distribution company committed to delivering safe, reliable, and convenient gas solutions to homes and businesses across Ghana.',
            'image'         => 'public/assets/img/about.jpg',
            'button_text'   => 'Explore More',
            'button_url'    => '/about',
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        $aboutId = $this->db->insertID();

        $this->db->table('home_about_points')->insertBatch([
            [
                'about_id'   => $aboutId,
                'point_text' => 'Certified filling plant with GSA-approved cylinders',
                'icon'       => 'fa fa-check-circle',
                'sort_order' => 1,
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'about_id'   => $aboutId,
                'point_text' => 'Door-to-door delivery eliminating long queues',
                'icon'       => 'fa fa-check-circle',
                'sort_order' => 2,
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'about_id'   => $aboutId,
                'point_text' => "Aligned with Ghana's Cylinder Recirculation Model (CRM)",
                'icon'       => 'fa fa-check-circle',
                'sort_order' => 3,
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
            [
                'about_id'   => $aboutId,
                'point_text' => 'Accurate measurement & transparent pricing',
                'icon'       => 'fa fa-check-circle',
                'sort_order' => 4,
                'status'     => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Services
        |--------------------------------------------------------------------------
        */
        $servicesSectionTitle = 'We Are Pioneers In The World Of Renewable Energy';

        $this->db->table('services')->insertBatch([
            [
                'section_label' => 'Our Services',
                'section_title' => $servicesSectionTitle,
                'title'         => 'Solar Panels',
                'description'   => 'Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.',
                'image'         => 'public/assets/img/img-600x400-1.jpg',
                'icon'          => 'fa fa-solar-panel',
                'button_text'   => 'Read More',
                'button_url'    => '#',
                'sort_order'    => 1,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'section_label' => 'Our Services',
                'section_title' => $servicesSectionTitle,
                'title'         => 'Wind Turbines',
                'description'   => 'Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.',
                'image'         => 'public/assets/img/img-600x400-2.jpg',
                'icon'          => 'fa fa-wind',
                'button_text'   => 'Read More',
                'button_url'    => '#',
                'sort_order'    => 2,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'section_label' => 'Our Services',
                'section_title' => $servicesSectionTitle,
                'title'         => 'Hydropower Plants',
                'description'   => 'Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.',
                'image'         => 'public/assets/img/img-600x400-3.jpg',
                'icon'          => 'fa fa-lightbulb',
                'button_text'   => 'Read More',
                'button_url'    => '#',
                'sort_order'    => 3,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'section_label' => 'Our Services',
                'section_title' => $servicesSectionTitle,
                'title'         => 'Solar Panels',
                'description'   => 'Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.',
                'image'         => 'public/assets/img/img-600x400-4.jpg',
                'icon'          => 'fa fa-solar-panel',
                'button_text'   => 'Read More',
                'button_url'    => '#',
                'sort_order'    => 4,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'section_label' => 'Our Services',
                'section_title' => $servicesSectionTitle,
                'title'         => 'Wind Turbines',
                'description'   => 'Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.',
                'image'         => 'public/assets/img/img-600x400-5.jpg',
                'icon'          => 'fa fa-wind',
                'button_text'   => 'Read More',
                'button_url'    => '#',
                'sort_order'    => 5,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
            [
                'section_label' => 'Our Services',
                'section_title' => $servicesSectionTitle,
                'title'         => 'Hydropower Plants',
                'description'   => 'Stet stet justo dolor sed duo. Ut clita sea sit ipsum diam lorem diam.',
                'image'         => 'public/assets/img/img-600x400-6.jpg',
                'icon'          => 'fa fa-lightbulb',
                'button_text'   => 'Read More',
                'button_url'    => '#',
                'sort_order'    => 6,
                'status'        => 1,
                'created_at'    => date('Y-m-d H:i:s'),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Why Choose Us
        |--------------------------------------------------------------------------
        */
        $this->db->table('home_choose_us')->insert([
            'section_label' => 'Why Choose Fine Gas',
            'title'         => 'Reliable LPG Cylinder Distribution Services For Homes & Businesses',
            'description'   => 'Fine Gas provides safe, reliable, and efficient LPG cylinder distribution services across Tema and surrounding areas. We are committed to delivering quality gas solutions for households, restaurants, shops, industries, and commercial facilities with fast delivery and trusted customer support.',
            'image'         => 'public/assets/img/feature.jpg',
            'image_alt'     => 'Fine Gas Cylinder Distribution',
            'status'        => 1,
            'created_at'    => date('Y-m-d H:i:s'),
        ]);

        $chooseUsId = $this->db->insertID();

        $this->db->table('home_choose_us_items')->insertBatch([
            [
                'choose_us_id' => $chooseUsId,
                'icon'         => 'fa fa-shield-alt',
                'small_title'  => 'Safe & Certified',
                'main_title'   => 'Gas Cylinders',
                'sort_order'   => 1,
                'status'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'choose_us_id' => $chooseUsId,
                'icon'         => 'fa fa-truck',
                'small_title'  => 'Fast & Reliable',
                'main_title'   => 'Delivery Service',
                'sort_order'   => 2,
                'status'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'choose_us_id' => $chooseUsId,
                'icon'         => 'fa fa-users',
                'small_title'  => 'Professional',
                'main_title'   => 'Support Team',
                'sort_order'   => 3,
                'status'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            ],
            [
                'choose_us_id' => $chooseUsId,
                'icon'         => 'fa fa-headset',
                'small_title'  => '24/7 Customer',
                'main_title'   => 'Support',
                'sort_order'   => 4,
                'status'       => 1,
                'created_at'   => date('Y-m-d H:i:s'),
            ],
        ]);
    }
}
