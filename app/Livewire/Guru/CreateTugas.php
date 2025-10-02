<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Tugas;
use App\Models\Kelas;
use App\Notifications\NewAssignmentNotification;
use App\Models\User;

class CreateTugas extends Component
{
    public $kelas_id;
    public $judul;
    public $deskripsi;
    public $deadline;
    
    protected $rules = [
        'kelas_id' => 'required|exists:kelas,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'deadline' => 'required|date|after:now',
    ];

    public function render()
    {
        $kelasList = Kelas::where('guru_id', auth()->id())->get();
        return view('livewire.guru.create-tugas', [
            'kelasList' => $kelasList
        ]);
    }
    
    public function createTugas()
    {
        $validated = $this->validate();
        
        $tugas = Tugas::create([
            'kelas_id' => $validated['kelas_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'deadline' => $validated['deadline'],
        ]);
        
        // Send notification to all students in the class
        $kelas = Kelas::find($validated['kelas_id']);
        $students = $kelas->siswa;
        
        foreach ($students as $student) {
            $student->notify(new NewAssignmentNotification($tugas));
        }
        
        session()->flash('message', 'Tugas berhasil dibuat.');
        
        // Reset form
        $this->reset(['kelas_id', 'judul', 'deskripsi', 'deadline']);
        
        // Redirect to kelas detail
        return $this->redirectRoute('guru.kelas.show', ['id' => $validated['kelas_id']], navigate: true);
    }
}
