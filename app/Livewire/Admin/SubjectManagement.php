<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;

class SubjectManagement extends Component
{
    use WithPagination;

    public Kelas $kelas;
    public $subject_id;
    public $name;
    public $isModalOpen = false;
    public $isEditing = false;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:subjects,name,NULL,id,class_id,' . $this->kelas->id,
        ];
    }

    public function mount(Kelas $kelas)
    {
        $this->kelas = $kelas;
    }

    public function render()
    {
        $subjects = Subject::where('class_id', $this->kelas->id)->paginate(10);
        return view('livewire.admin.subject-management', ['subjects' => $subjects])->layout('layouts.admin');
    }

    public function create()
    {
        $this->reset(['name', 'subject_id', 'isEditing']);
        $this->isModalOpen = true;
    }

    public function cancel()
    {
        $this->isModalOpen = false;
        $this->reset(['name', 'subject_id', 'isEditing']);
    }

    public function store()
    {
        $this->validate();

        $this->kelas->subjects()->create(['name' => $this->name]);

        session()->flash('message', 'Subject created successfully.');
        $this->isModalOpen = false;
        $this->reset(['name']);
    }

    public function edit(Subject $subject)
    {
        $this->subject_id = $subject->id;
        $this->name = $subject->name;
        $this->isEditing = true;
        $this->isModalOpen = true;
    }

    public function update()
    {
        $this->validate();

        $subject = Subject::find($this->subject_id);
        $subject->update(['name' => $this->name]);

        session()->flash('message', 'Subject updated successfully.');
        $this->isModalOpen = false;
        $this->reset(['name', 'subject_id', 'isEditing']);
    }

    public function delete(Subject $subject)
    {
        $subject->delete();
        session()->flash('message', 'Subject deleted successfully.');
    }
}
