<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Tugas;
use App\Models\Pengumpulan;

class SubmitTugas extends Component
{
    use WithFileUploads;
    
    public $tugasId;
    public $tugas;
    public $file_path;
    public $teks_jawaban;
    public $file;
    
    public function mount($tugasId)
    {
        $this->tugasId = $tugasId;
        $this->tugas = Tugas::findOrFail($tugasId);
        
        // Check if user is enrolled in the class
        if (!$this->tugas->kelas->siswa->contains(auth()->id())) {
            abort(403, 'Anda tidak terdaftar di kelas ini.');
        }
        
        // Check if deadline has passed
        if ($this->tugas->deadline->isPast()) {
            session()->flash('error', 'Deadline tugas telah berlalu. Tidak dapat mengumpulkan tugas.');
        }
    }

    protected $rules = [
        'file' => 'nullable|file|mimes:pdf,doc,docx,zip|max:5120', // 5MB max
        'teks_jawaban' => 'nullable|string|max:10000',
    ];

    public function render()
    {
        // Check if user has already submitted this assignment
        $existingSubmission = Pengumpulan::where('tugas_id', $this->tugasId)
                                         ->where('siswa_id', auth()->id())
                                         ->first();
        
        return view('livewire.siswa.submit-tugas', [
            'existingSubmission' => $existingSubmission
        ]);
    }
    
    public function submitTugas()
    {
        // Check if deadline has passed
        if ($this->tugas->deadline->isPast()) {
            session()->flash('error', 'Deadline tugas telah berlalu. Tidak dapat mengumpulkan tugas.');
            return;
        }
        
        $validated = $this->validate();
        
        // Check if user has already submitted this assignment
        $existingSubmission = Pengumpulan::where('tugas_id', $this->tugasId)
                                         ->where('siswa_id', auth()->id())
                                         ->first();
        
        if ($existingSubmission) {
            // Update existing submission
            if ($this->file) {
                // Delete old file if exists
                if ($existingSubmission->file_path) {
                    \Storage::disk('public')->delete($existingSubmission->file_path);
                }
                
                $filePath = $this->file->store('pengumpulan', 'public');
                $existingSubmission->update([
                    'file_path' => $filePath,
                    'teks_jawaban' => $validated['teks_jawaban'],
                    'submitted_at' => now(),
                ]);
            } else {
                $existingSubmission->update([
                    'teks_jawaban' => $validated['teks_jawaban'],
                    'submitted_at' => now(),
                ]);
            }
        } else {
            // Create new submission
            $filePath = null;
            if ($this->file) {
                $filePath = $this->file->store('pengumpulan', 'public');
            }
            
            Pengumpulan::create([
                'tugas_id' => $this->tugasId,
                'siswa_id' => auth()->id(),
                'file_path' => $filePath,
                'teks_jawaban' => $validated['teks_jawaban'],
                'submitted_at' => now(),
            ]);
        }
        
        session()->flash('message', 'Tugas berhasil dikumpulkan.');
        $this->reset(['file', 'teks_jawaban']);
    }
}
