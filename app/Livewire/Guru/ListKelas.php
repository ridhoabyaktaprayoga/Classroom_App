<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Tugas;
use Illuminate\Support\Facades\Auth;

class ListKelas extends Component
{
    public $showLeaveModal = false;
    public $leavingClass = null;
    public $leaveWarning = '';

    public function render()
    {
        // Get classes where teacher has joined and selected subjects
        $kelasList = Kelas::whereHas('teachers', function($query) {
            $query->where('teacher_id', Auth::id());
        })->with(['teachers' => function($query) {
            $query->where('teacher_id', Auth::id());
        }])->get();

        return view('livewire.guru.list-kelas', [
            'kelasList' => $kelasList
        ]);
    }

    public function confirmLeaveClass($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $this->leavingClass = $kelas;

        // Check for active content - since materi and tugas don't have guru_id,
        // we check if the teacher has any subject assignments in this class
        $hasContent = $kelas->teachers()
            ->where('teacher_id', Auth::id())
            ->exists();

        if ($hasContent) {
            $this->leaveWarning = "You are assigned to teach subjects in this class. Leaving will remove your teaching assignments. Are you sure you want to continue?";
        } else {
            $this->leaveWarning = 'Are you sure you want to leave this class?';
        }

        $this->showLeaveModal = true;
    }

    public function leaveClass()
    {
        if (!$this->leavingClass) return;

        // Remove teacher from this class (remove all subject assignments)
        $this->leavingClass->teachers()->detach(Auth::id());

        session()->flash('message', 'You have successfully left the class.');
        $this->showLeaveModal = false;
        $this->leavingClass = null;
        $this->leaveWarning = '';
    }

    public function cancelLeave()
    {
        $this->showLeaveModal = false;
        $this->leavingClass = null;
        $this->leaveWarning = '';
    }
}
