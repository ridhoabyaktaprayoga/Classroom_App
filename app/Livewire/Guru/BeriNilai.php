<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Pengumpulan;
use App\Notifications\AssignmentGradedNotification;

class BeriNilai extends Component
{
    public $pengumpulanId;
    public $pengumpulan;
    public $nilai;
    public $komentar;
    
    public function mount($pengumpulanId)
    {
        $this->pengumpulanId = $pengumpulanId;
        $this->pengumpulan = Pengumpulan::with(['siswa', 'tugas'])->findOrFail($pengumpulanId);
        
        // Ensure the authenticated user is the creator of the class this submission belongs to
        if ($this->pengumpulan->tugas->kelas->guru_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke pengumpulan ini.');
        }
        
        $this->nilai = $this->pengumpulan->nilai;
        $this->komentar = $this->pengumpulan->komentar;
    }

    protected $rules = [
        'nilai' => 'required|numeric|min:0|max:100',
        'komentar' => 'nullable|string|max:1000',
    ];

    public function render()
    {
        return view('livewire.guru.beri-nilai');
    }
    
    public function beriNilai()
    {
        $validated = $this->validate();
        
        $this->pengumpulan->update([
            'nilai' => $validated['nilai'],
            'komentar' => $validated['komentar'],
        ]);
        
        // Send notification to the student about the grade
        $this->pengumpulan->siswa->notify(new AssignmentGradedNotification($this->pengumpulan));
        
        session()->flash('message', 'Nilai berhasil diberikan.');
        
        // Redirect back to the pengumpulan list for this assignment
        return $this->redirectRoute('guru.tugas.pengumpulan', ['tugasId' => $this->pengumpulan->tugas_id], navigate: true);
    }
}
