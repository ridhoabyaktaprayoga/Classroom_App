<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Kelas;

class DetailKelasForSiswa extends Component
{
    public $kelas;
    public $kelasId;
    public $activeTab = 'materi';
    public $tugas;

    public function mount($id)
    {
        $this->kelasId = $id;
        $this->kelas = Kelas::whereHas('siswa', function($query) {
            $query->where('users.id', auth()->id());
        })->with(['materi', 'tugas', 'guru'])->findOrFail($id);
        $this->tugas = $this->kelas->tugas;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.siswa.detail-kelas-for-siswa');
    }
}
