<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use Livewire\Component;

class EditClass extends Component
{
    public Kelas $kelas;
    public $nama_kelas;
    public $deskripsi;

    protected $rules = [
        'nama_kelas' => 'required|string|max:255',
        'deskripsi' => 'nullable|string|max:1000',
    ];

    public function mount(Kelas $kelas)
    {
        $this->kelas = $kelas;
        $this->nama_kelas = $kelas->nama_kelas;
        $this->deskripsi = $kelas->deskripsi;
    }

    public function update()
    {
        $this->validate([
            'nama_kelas' => 'required|string|max:255|unique:kelas,nama_kelas,' . $this->kelas->id,
        ]);

        $this->kelas->update([
            'nama_kelas' => $this->nama_kelas,
            'deskripsi' => $this->deskripsi,
        ]);

        session()->flash('message', 'Class updated successfully.');
        return redirect()->route('admin.classes');
    }

    public function render()
    {
        return view('livewire.admin.edit-class')->layout('layouts.admin');
    }
}
