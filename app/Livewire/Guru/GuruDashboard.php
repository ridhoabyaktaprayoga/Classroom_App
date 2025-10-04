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

        $announcements = \App\Models\Announcement::where(function($query) {
            $query->where('target_role', 'all')
                  ->orWhere('target_role', 'guru');
        })->where(function($query) {
            $query->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
        })->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
        })->get();

        return view('livewire.guru.guru-dashboard', [
            'totalKelas' => $totalKelas,
            'totalSiswa' => $totalSiswa,
            'announcements' => $announcements,
        ]);
    }
}
