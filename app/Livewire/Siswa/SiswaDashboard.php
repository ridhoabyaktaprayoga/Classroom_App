<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Kelas;

class SiswaDashboard extends Component
{
    public function render()
    {
        $kelasSiswa = Kelas::whereHas('siswa', function($query) {
            $query->where('users.id', auth()->id());
        })->count();

        $announcements = \App\Models\Announcement::where(function($query) {
            $query->where('target_role', 'all')
                  ->orWhere('target_role', 'siswa');
        })->where(function($query) {
            $query->whereNull('start_date')
                  ->orWhere('start_date', '<=', now());
        })->where(function($query) {
            $query->whereNull('end_date')
                  ->orWhere('end_date', '>=', now());
        })->get();

        return view('livewire.siswa.siswa-dashboard', [
            'kelasSiswa' => $kelasSiswa,
            'announcements' => $announcements,
        ]);
    }
}
