<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Materi;
use App\Models\Kelas;

class UploadMateri extends Component
{
    use WithFileUploads;
    
    public $kelas_id;
    public $judul;
    public $deskripsi;
    public $file;
    
    protected $rules = [
        'kelas_id' => 'required|exists:kelas,id',
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'file' => 'required|file|mimes:pdf,ppt,pptx,doc,docx|max:10240', // 10MB max
    ];

    public function render()
    {
        $kelasList = Kelas::where('guru_id', auth()->id())->get();
        return view('livewire.guru.upload-materi', [
            'kelasList' => $kelasList
        ]);
    }
    
    public function uploadMateri()
    {
        $validated = $this->validate();
        
        // Store the file
        $filePath = $this->file->store('materi', 'public');
        
        // Create the materi
        Materi::create([
            'kelas_id' => $validated['kelas_id'],
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'file_path' => $filePath,
        ]);
        
        session()->flash('message', 'Materi berhasil diunggah.');
        
        // Reset form
        $this->reset(['kelas_id', 'judul', 'deskripsi', 'file']);
        
        // Redirect to kelas detail
        return $this->redirectRoute('guru.kelas.show', ['id' => $validated['kelas_id']], navigate: true);
    }
}
