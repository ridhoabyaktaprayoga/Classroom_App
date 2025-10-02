<?php

namespace App\Livewire\Siswa;

use Livewire\Component;
use App\Models\Kelas;

class ListKelasYangDiikuti extends Component
{
    public function render()
    {
        $kelasList = Kelas::whereHas('siswa', function($query) {
            $query->where('users.id', auth()->id());
        })->with(['guru', 'materi', 'tugas'])->get();

        return view('livewire.siswa.list-kelas-yang-diikuti', [
            'kelasList' => $kelasList
        ]);
    }
}
