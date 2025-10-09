<?php

namespace App\Livewire\Guru;

use App\Models\Kelas;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class JoinClass extends Component
{
    public $class_code;
    public $joinedClass = null;

    protected $rules = [
        'class_code' => 'required|string|size:6',
    ];

    public function joinClass()
    {
        $this->validate();

        $kelas = Kelas::where('class_code', strtoupper($this->class_code))->first();

        if (!$kelas) {
            session()->flash('error', 'Class code not found.');
            return;
        }

        // Check if teacher is already joined to this class
        if ($kelas->teachers()->where('teacher_id', Auth::id())->exists()) {
            session()->flash('error', 'You are already joined to this class.');
            return;
        }

        // Join the class (this will be recorded in teacher_subject table when subjects are selected)
        $this->joinedClass = $kelas;
        session()->flash('success', 'Class found! Please select subjects to complete joining.');
    }

    public function render()
    {
        return view('livewire.guru.join-class')->layout('layouts.app');
    }
}
