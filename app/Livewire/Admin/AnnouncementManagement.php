<?php

namespace App\Livewire\Admin;

use App\Models\Announcement;
use Livewire\Component;
use Livewire\WithPagination;

class AnnouncementManagement extends Component
{
    use WithPagination;

    public $layout = 'layouts.admin';

    public $title;
    public $content;
    public $targetRole = 'all';
    public $startDate;
    public $endDate;
    public $editingId = null;

    public function render()
    {
        $announcements = Announcement::paginate(10);
        return view('livewire.admin.announcement-management', compact('announcements'));
    }

    public function create()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'targetRole' => 'required|in:all,guru,siswa',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after:startDate',
        ]);

        Announcement::create([
            'title' => $this->title,
            'content' => $this->content,
            'target_role' => $this->targetRole,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        $this->resetForm();
        session()->flash('message', 'Announcement created successfully.');
    }

    public function edit($id)
    {
        $announcement = Announcement::find($id);
        $this->editingId = $id;
        $this->title = $announcement->title;
        $this->content = $announcement->content;
        $this->targetRole = $announcement->target_role;
        $this->startDate = $announcement->start_date;
        $this->endDate = $announcement->end_date;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'targetRole' => 'required|in:all,guru,siswa',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after:startDate',
        ]);

        $announcement = Announcement::find($this->editingId);
        $announcement->update([
            'title' => $this->title,
            'content' => $this->content,
            'target_role' => $this->targetRole,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
        ]);

        $this->resetForm();
        session()->flash('message', 'Announcement updated successfully.');
    }

    public function delete($id)
    {
        Announcement::find($id)->delete();
        session()->flash('message', 'Announcement deleted successfully.');
    }

    public function cancelEdit()
    {
        $this->resetForm();
    }

    private function resetForm()
    {
        $this->title = '';
        $this->content = '';
        $this->targetRole = 'all';
        $this->startDate = '';
        $this->endDate = '';
        $this->editingId = null;
    }
}
