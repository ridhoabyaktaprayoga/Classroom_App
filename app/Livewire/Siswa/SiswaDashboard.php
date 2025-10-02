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

        return view('livewire.siswa.siswa-dashboard', [
            'kelasSiswa' => $kelasSiswa,
        ]);
    }
}
