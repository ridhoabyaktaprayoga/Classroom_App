<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Kelas;
use Illuminate\Support\Str;

class CreateKelas extends Component
{
    public $nama_kelas;
    public $deskripsi;
    
    protected $rules = [
        'nama_kelas' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
    ];

    public function render()
    {
        return view('livewire.guru.create-kelas');
    }
    
    public function createKelas()
    {
        $validated = $this->validate();
        
        // Generate unique kode_kelas (6 digit)
        do {
            $kode_kelas = strtoupper(Str::random(6));
        } while (Kelas::where('kode_kelas', $kode_kelas)->exists());
        
        Kelas::create([
            'nama_kelas' => $validated['nama_kelas'],
            'kode_kelas' => $kode_kelas,
            'deskripsi' => $validated['deskripsi'] ?? null,
            'guru_id' => auth()->id(),
        ]);
        
        session()->flash('message', 'Kelas berhasil dibuat.');
        
        // Reset form
        $this->reset(['nama_kelas', 'deskripsi']);
        
        // Redirect to kelas list
        return $this->redirectRoute('guru.kelas.index', navigate: true);
    }
}
