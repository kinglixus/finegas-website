<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\TeamModel;

class Teampage extends BaseController
{
    protected $teamModel;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Team Page CMS',

            'page_header' => $this->teamModel
                ->getSection('page_header'),

            'team_header' => $this->teamModel
                ->getSection('team_header'),

            'team_members' => $this->teamModel
                ->getSectionItems('team_members'),
        ];

        return view('admin/teampage/index', $data);
    }

    public function pageHeader()
    {
        $pageHeader = $this->teamModel
            ->getSection('page_header');

        return view('admin/teampage/page_header', [
            'title'      => 'Page Header',
            'pageHeader' => $pageHeader,
        ]);
    }

    public function updatePageHeader()
    {
        $pageHeader = $this->teamModel
            ->getSection('page_header');

        if (!$pageHeader) {
            return redirect()
                ->back()
                ->with('error', 'Page Header not found.');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imagePath = $this->uploadImage(
                $image,
                'page_headers',
                $pageHeader['image'] ?? null
            );

            if (!empty($imagePath)) {
                $data['image'] = $imagePath;
            }
        }

        $this->teamModel->update($pageHeader['id'], $data);

        activity_log(
            'TEAM_PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Team page header updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Page Header updated successfully.');
    }

    public function teamHeader()
    {
        $teamHeader = $this->teamModel
            ->getSection('team_header');

        return view('admin/teampage/team_header', [
            'title'      => 'Team Header',
            'teamHeader' => $teamHeader,
        ]);
    }

    public function updateTeamHeader()
    {
        $teamHeader = $this->teamModel
            ->getSection('team_header');

        if (!$teamHeader) {
            return redirect()
                ->back()
                ->with('error', 'Team Header not found.');
        }

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'status'      => $this->request->getPost('status'),
        ];

        $this->teamModel->update($teamHeader['id'], $data);

        activity_log(
            'TEAM_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Team header updated'
        );

        return redirect()
            ->back()
            ->with('success', 'Team Header updated successfully.');
    }

    public function teamMembers()
    {
        $data = [
            'title' => 'Team Members',

            'teamMembers' => $this->teamModel
                ->where('section_name', 'team_members')
                ->where('section_type', 'item')
                ->orderBy('sort_order', 'ASC')
                ->findAll(),
        ];

        return view('admin/teampage/team_members', $data);
    }

    public function createTeamMember()
    {
        return view('admin/teampage/team_member_create', [
            'title' => 'Create Team Member',
        ]);
    }

    public function storeTeamMember()
    {
        $image = $this->request->getFile('image');

        $imagePath = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imagePath = $this->uploadImage($image, 'team');
        }

        $socialLinks = [
            'social_links' => [
                [
                    'icon' => 'fab fa-facebook-f',
                    'url'  => $this->request->getPost('facebook_url'),
                ],
                [
                    'icon' => 'fab fa-twitter',
                    'url'  => $this->request->getPost('twitter_url'),
                ],
                [
                    'icon' => 'fab fa-instagram',
                    'url'  => $this->request->getPost('instagram_url'),
                ],
            ],
        ];

        $this->teamModel->insert([
            'section_name' => 'team_members',
            'section_type' => 'item',
            'title'        => $this->request->getPost('title'),
            'subtitle'     => $this->request->getPost('subtitle'),
            'description'  => $this->request->getPost('description'),
            'image'        => $imagePath,
            'extra_data'   => json_encode($socialLinks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'sort_order'   => $this->request->getPost('sort_order'),
            'status'       => $this->request->getPost('status'),
        ]);

        activity_log(
            'TEAM_MEMBER_CREATED',
            'CMS',
            session('admin_id'),
            'Team member created'
        );

        return redirect()
            ->to(base_url('admin/teampage/team-members'))
            ->with('success', 'Team member created successfully.');
    }

    public function editTeamMember($id)
    {
        $teamMember = $this->teamModel->find($id);

        if (!$teamMember) {
            return redirect()
                ->to(base_url('admin/teampage/team-members'))
                ->with('error', 'Team member not found.');
        }

        if (!empty($teamMember['extra_data'])) {
            $decoded = json_decode($teamMember['extra_data'], true);
            $teamMember['extra_data'] = is_array($decoded) ? $decoded : [];
        } else {
            $teamMember['extra_data'] = [];
        }

        return view('admin/teampage/team_member_edit', [
            'title'      => 'Edit Team Member',
            'teamMember' => $teamMember,
        ]);
    }

    public function updateTeamMember($id)
    {
        $teamMember = $this->teamModel->find($id);

        if (!$teamMember) {
            return redirect()
                ->to(base_url('admin/teampage/team-members'))
                ->with('error', 'Team member not found.');
        }

        $socialLinks = [
            'social_links' => [
                [
                    'icon' => 'fab fa-facebook-f',
                    'url'  => $this->request->getPost('facebook_url'),
                ],
                [
                    'icon' => 'fab fa-twitter',
                    'url'  => $this->request->getPost('twitter_url'),
                ],
                [
                    'icon' => 'fab fa-instagram',
                    'url'  => $this->request->getPost('instagram_url'),
                ],
            ],
        ];

        $data = [
            'title'       => $this->request->getPost('title'),
            'subtitle'    => $this->request->getPost('subtitle'),
            'description' => $this->request->getPost('description'),
            'extra_data'  => json_encode($socialLinks, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'sort_order'  => $this->request->getPost('sort_order'),
            'status'      => $this->request->getPost('status'),
        ];

        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imagePath = $this->uploadImage(
                $image,
                'team',
                $teamMember['image'] ?? null
            );

            if (!empty($imagePath)) {
                $data['image'] = $imagePath;
            }
        }

        $this->teamModel->update($id, $data);

        activity_log(
            'TEAM_MEMBER_UPDATED',
            'CMS',
            session('admin_id'),
            'Team member updated'
        );

        return redirect()
            ->to(base_url('admin/teampage/team-members'))
            ->with('success', 'Team member updated successfully.');
    }

    public function deleteTeamMember($id)
    {
        $teamMember = $this->teamModel->find($id);

        if (!$teamMember) {
            return $this->response->setJSON([
                'status' => false,
            ]);
        }

        if (
            !empty($teamMember['image']) &&
            file_exists(FCPATH . $teamMember['image'])
        ) {
            unlink(FCPATH . $teamMember['image']);
        }

        $this->teamModel->delete($id);

        activity_log(
            'TEAM_MEMBER_DELETED',
            'CMS',
            session('admin_id'),
            'Team member deleted'
        );

        return $this->response->setJSON([
            'status' => true,
        ]);
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
