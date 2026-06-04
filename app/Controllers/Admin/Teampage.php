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

            'page_header' =>
            $this->teamModel
                ->getSection(
                    'page_header'
                ),

            'team_header' =>
            $this->teamModel
                ->getSection(
                    'team_header'
                ),

            'team_members' =>
            $this->teamModel
                ->getSectionItems(
                    'team_members'
                )
        ];

        return view(
            'admin/teampage/index',
            $data
        );
    }

    public function pageHeader()
    {
        $pageHeader =
            $this->teamModel
            ->getSection(
                'page_header'
            );

        return view(
            'admin/teampage/page_header',
            [
                'title'      => 'Page Header',
                'pageHeader' => $pageHeader
            ]
        );
    }
    public function updatePageHeader()
    {
        $pageHeader =
            $this->teamModel
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

            'status' =>
            $this->request
                ->getPost('status')
        ];

        // Banner Image Upload

        $image =
            $this->request
            ->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $newName =
                $image->getRandomName();

            $uploadPath =
                FCPATH . 'uploads/team';

            // Create directory if it doesn't exist

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $image->move(
                $uploadPath,
                $newName
            );

            $data['image'] =
                'uploads/team/' . $newName;
        }

        $this->teamModel
            ->update(
                $pageHeader['id'],
                $data
            );

        activity_log(
            'TEAM_PAGE_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Team page header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Page Header updated successfully.'
            );
    }
    public function teamHeader()
    {
        $teamHeader =
            $this->teamModel
            ->getSection(
                'team_header'
            );

        return view(
            'admin/teampage/team_header',
            [
                'title'      => 'Team Header',
                'teamHeader' => $teamHeader
            ]
        );
    }

    public function updateTeamHeader()
    {
        $teamHeader =
            $this->teamModel
            ->getSection(
                'team_header'
            );

        if (!$teamHeader) {

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Team Header not found.'
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

            'status' =>
            $this->request
                ->getPost('status')
        ];

        // Header Image Upload

        $image =
            $this->request
            ->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $newName =
                $image->getRandomName();

            $uploadPath =
                FCPATH . 'uploads/team';

            // Create directory if it doesn't exist

            if (!is_dir($uploadPath)) {

                mkdir(
                    $uploadPath,
                    0777,
                    true
                );
            }

            $image->move(
                $uploadPath,
                $newName
            );

            $data['image'] =
                'uploads/team/' . $newName;
        }

        $this->teamModel
            ->update(
                $teamHeader['id'],
                $data
            );

        activity_log(
            'TEAM_HEADER_UPDATED',
            'CMS',
            session('admin_id'),
            'Team header updated'
        );

        return redirect()
            ->back()
            ->with(
                'success',
                'Team Header updated successfully.'
            );
    }
    public function members()
    {
        $data = [

            'title' => 'Team Members',

            'members' =>

            $this->teamModel

                ->where(
                    'section_name',
                    'team_members'
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
            'admin/teampage/members',
            $data
        );
    }

    public function createMember()
    {
        return view(
            'admin/teampage/members_create',
            [
                'title' => 'Create Team Member'
            ]
        );
    }

    public function storeMember()
    {
        $image = $this->request->getFile('image');

        $imagePath = null;

        if ($image && $image->isValid()) {
            $newName =
                $image->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/team',
                $newName
            );

            $imagePath =
                'uploads/team/' .
                $newName;
        }

        $socialLinks = [

            'facebook' =>
            $this->request
                ->getPost('facebook'),

            'twitter' =>
            $this->request
                ->getPost('twitter'),

            'linkedin' =>
            $this->request
                ->getPost('linkedin'),

            'instagram' =>
            $this->request
                ->getPost('instagram')
        ];

        $this->teamModel
            ->insert([

                'section_name' =>
                'team_members',

                'section_type' =>
                'item',

                'title' =>
                $this->request
                    ->getPost('title'),

                'subtitle' =>
                $this->request
                    ->getPost('subtitle'),

                'description' =>
                $this->request
                    ->getPost('description'),

                'image' =>
                $imagePath,

                'extra_data' =>
                json_encode(
                    $socialLinks
                ),

                'sort_order' =>
                $this->request
                    ->getPost('sort_order'),

                'status' =>
                $this->request
                    ->getPost('status')
            ]);

        activity_log(
            'TEAM_MEMBER_CREATED',
            'CMS',
            session('admin_id'),
            'Team member created'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/teampage/members'
                )
            )
            ->with(
                'success',
                'Team member created successfully.'
            );
    }

    public function editMember($id)
    {
        $member =
            $this->teamModel
            ->find($id);

        if (!$member) {
            return redirect()
                ->to(
                    base_url(
                        'admin/teampage/members'
                    )
                )
                ->with(
                    'error',
                    'Team member not found.'
                );
        }

        $member['extra_data'] =
            !empty($member['extra_data'])
            ? json_decode(
                $member['extra_data'],
                true
            )
            : [];

        return view(
            'admin/teampage/members_edit',
            [
                'title'  => 'Edit Team Member',
                'member' => $member
            ]
        );
    }

    public function updateMember($id)
    {
        $member =
            $this->teamModel
            ->find($id);

        if (!$member) {
            return redirect()
                ->back()
                ->with(
                    'error',
                    'Team member not found.'
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

            'sort_order' =>
            $this->request
                ->getPost('sort_order'),

            'status' =>
            $this->request
                ->getPost('status'),

            'extra_data' =>
            json_encode([

                'facebook' =>
                $this->request->getPost('facebook'),

                'twitter' =>
                $this->request->getPost('twitter'),

                'linkedin' =>
                $this->request->getPost('linkedin'),

                'instagram' =>
                $this->request->getPost('instagram')
            ])
        ];

        $image =
            $this->request
            ->getFile('image');

        if ($image && $image->isValid()) {
            $newName =
                $image->getRandomName();

            $image->move(
                FCPATH .
                    'uploads/team',
                $newName
            );

            $data['image'] =
                'uploads/team/' .
                $newName;
        }

        $this->teamModel
            ->update(
                $id,
                $data
            );

        activity_log(
            'TEAM_MEMBER_UPDATED',
            'CMS',
            session('admin_id'),
            'Team member updated'
        );

        return redirect()
            ->to(
                base_url(
                    'admin/teampage/members'
                )
            )
            ->with(
                'success',
                'Team member updated successfully.'
            );
    }

    public function deleteMember($id)
    {
        $member =
            $this->teamModel
            ->find($id);

        if (!$member) {
            return $this->response
                ->setJSON([
                    'status' => false
                ]);
        }

        $this->teamModel
            ->delete($id);

        activity_log(
            'TEAM_MEMBER_DELETED',
            'CMS',
            session('admin_id'),
            'Team member deleted'
        );

        return $this->response
            ->setJSON([
                'status' => true
            ]);
    }
}
