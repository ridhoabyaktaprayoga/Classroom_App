<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Kelas;
use App\Models\User;

class GuruDashboard extends Component
{
    public function render()
    {
        $totalKelas = Kelas::where('guru_id', auth()->id())->count();
        $totalSiswa = User::where('role', 'siswa')->count();

        return view('livewire.guru.guru-dashboard', [
            'totalKelas' => $totalKelas,
            'totalSiswa' => $totalSiswa,
        ]);
    }
}
