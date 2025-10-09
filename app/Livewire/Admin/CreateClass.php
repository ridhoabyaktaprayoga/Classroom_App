<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class CreateClass extends Component
{
    public $nama_kelas;
    public $deskripsi;

    protected $rules = [
        'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas',
        'deskripsi' => 'nullable|string|max:1000',
    ];

    public function store()
    {
        $this->validate();

        Kelas::create([
            'nama_kelas' => $this->nama_kelas,
            'deskripsi' => $this->deskripsi,
            'class_code' => $this->generateUniqueClassCode(),
            'created_by' => Auth::id(),
        ]);

        session()->flash('message', 'Class created successfully.');
        return redirect()->route('admin.classes');
    }

    private function generateUniqueClassCode()
    {
        do {
            $code = Str::random(6);
        } while (Kelas::where('class_code', $code)->exists());

        return $code;
    }

    public function render()
    {
        return view('livewire.admin.create-class')->layout('layouts.admin');
    }
}
