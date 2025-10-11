<?php

namespace App\Livewire\Guru;

use App\Models\Kelas;
use App\Models\Subject;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class SelectSubject extends Component
{
    public Kelas $kelas;
    public $selectedSubjects = [];

    public function mount(Kelas $kelas)
    {
        $this->kelas = $kelas;
        // Pre-select subjects the teacher has already chosen
        $this->selectedSubjects = $kelas->teachers()
            ->where('teacher_id', Auth::id())
            ->pluck('subject_id')
            ->toArray();
    }

    public function selectSubject($subjectId)
    {
        if (in_array($subjectId, $this->selectedSubjects)) {
            $this->selectedSubjects = array_diff($this->selectedSubjects, [$subjectId]);
        } else {
            $this->selectedSubjects[] = $subjectId;
        }
    }

    public function saveSelection()
    {
        if (empty($this->selectedSubjects)) {
            session()->flash('error', 'Please select at least one subject.');
            return;
        }

        // Check if any selected subject is already assigned to another teacher
        foreach ($this->selectedSubjects as $subjectId) {
            if ($this->kelas->teachers()->where('subject_id', $subjectId)->where('teacher_id', '!=', Auth::id())->exists()) {
                session()->flash('error', 'One or more selected subjects are already assigned to another teacher.');
                return;
            }
        }

        // Remove existing selections for this teacher and class
        $this->kelas->teachers()->detach(Auth::id());

        // Add new selections
        foreach ($this->selectedSubjects as $subjectId) {
            $this->kelas->teachers()->attach(Auth::id(), [
                'subject_id' => $subjectId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        session()->flash('message', 'Subjects selected successfully! You can now post materials and assignments.');
        return redirect()->route('guru.kelas.index');
    }

    public function render()
    {
        $subjects = $this->kelas->subjects;
        return view('livewire.guru.select-subject', ['subjects' => $subjects])->layout('components.layouts.app');
    }
}
