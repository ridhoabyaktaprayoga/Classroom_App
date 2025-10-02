<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Pengumpulan;
use App\Models\Tugas;

class ListPengumpulan extends Component
{
    public $tugasId;
    public $tugas;
    public $filter = 'all'; // 'all', 'graded', 'ungraded'
    
    public function mount($tugasId)
    {
        $this->tugasId = $tugasId;
        $this->tugas = Tugas::findOrFail($tugasId);
        
        // Ensure the authenticated user is the creator of the class this assignment belongs to
        if ($this->tugas->kelas->guru_id !== auth()->id()) {
            abort(403, 'Anda tidak memiliki akses ke tugas ini.');
        }
    }

    public function render()
    {
        $query = Pengumpulan::where('tugas_id', $this->tugasId)
                           ->with(['siswa']);
        
        switch ($this->filter) {
            case 'graded':
                $query->whereNotNull('nilai');
                break;
            case 'ungraded':
                $query->whereNull('nilai');
                break;
        }
        
        $pengumpulanList = $query->get();
        
        return view('livewire.guru.list-pengumpulan', [
            'pengumpulanList' => $pengumpulanList
        ]);
    }
}
