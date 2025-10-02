<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Kelas;
use App\Models\User;

class JoinKelas extends Component
{
    public $kode_kelas;
    
    protected $rules = [
        'kode_kelas' => 'required|string|exists:kelas,kode_kelas',
    ];

    public function render()
    {
        return view('livewire.siswa.join-kelas');
    }
    
    public function joinKelas()
    {
        $validated = $this->validate();
        
        // Check if the class exists
        $kelas = Kelas::where('kode_kelas', $validated['kode_kelas'])->first();
        
        if (!$kelas) {
            $this->addError('kode_kelas', 'Kode kelas tidak ditemukan.');
            return;
        }
        
        // Check if the user is already enrolled in this class
        if ($kelas->siswa->contains(auth()->id())) {
            $this->addError('kode_kelas', 'Anda sudah tergabung dalam kelas ini.');
            return;
        }
        
        // Check if the user is the same as the teacher
        if ($kelas->guru_id == auth()->id()) {
            $this->addError('kode_kelas', 'Anda tidak bisa bergabung ke kelas yang Anda buat sendiri.');
            return;
        }
        
        // Add the student to the class
        $kelas->siswa()->attach(auth()->id());
        
        session()->flash('message', 'Berhasil bergabung ke kelas.');
        
        // Reset the form
        $this->reset(['kode_kelas']);
        
        // Redirect to the class list
        return $this->redirectRoute('siswa.kelas.index', navigate: true);
    }
}
