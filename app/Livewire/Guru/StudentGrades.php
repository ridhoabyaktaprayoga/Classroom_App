<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Pengumpulan;
use App\Models\Kelas;

class StudentGrades extends Component
{
    public $kelasId;
    public $siswaId;
    public $kelas;
    public $siswa;
    public $pengumpulans;

    public function mount($kelasId, $siswaId)
    {
        $this->kelasId = $kelasId;
        $this->siswaId = $siswaId;

        $this->kelas = Kelas::where('guru_id', auth()->id())->findOrFail($kelasId);
        $this->siswa = $this->kelas->siswa()->where('users.id', $siswaId)->firstOrFail();
        $this->pengumpulans = Pengumpulan::where('siswa_id', $siswaId)
                                         ->whereHas('tugas', function($query) use ($kelasId) {
                                             $query->where('kelas_id', $kelasId);
                                         })
                                         ->with('tugas')
                                         ->get();
    }

    public function render()
    {
        return view('livewire.guru.student-grades');
    }
}
