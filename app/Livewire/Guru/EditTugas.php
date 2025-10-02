<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Tugas;

class EditTugas extends Component
{
    public $tugasId;
    public $kelasId;
    public $judul;
    public $deskripsi;
    public $deadline;

    public function mount($tugasId)
    {
        $tugas = Tugas::findOrFail($tugasId);
        // Ensure belongs to user's class
        if ($tugas->kelas->guru_id !== auth()->id()) {
            abort(403);
        }

        $this->tugasId = $tugasId;
        $this->kelasId = $tugas->kelas_id;
        $this->judul = $tugas->judul;
        $this->deskripsi = $tugas->deskripsi;
        $this->deadline = $tugas->deadline ? $tugas->deadline->format('Y-m-d\TH:i') : null;
    }

    public function updateTugas()
    {
        $this->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'deadline' => 'nullable|date',
        ]);

        $tugas = Tugas::findOrFail($this->tugasId);
        $tugas->update([
            'judul' => $this->judul,
            'deskripsi' => $this->deskripsi,
            'deadline' => $this->deadline,
        ]);

        session()->flash('message', 'Tugas berhasil diupdate.');

        return redirect()->route('guru.kelas.show', $this->kelasId);
    }

    public function render()
    {
        return view('livewire.guru.edit-tugas');
    }
}
