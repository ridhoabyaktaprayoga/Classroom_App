<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Kelas;

class ListKelas extends Component
{
    public function render()
    {
        $kelasList = Kelas::where('guru_id', auth()->id())->get();

        return view('livewire.guru.list-kelas', [
            'kelasList' => $kelasList
        ]);
    }

    public function deleteKelas($id)
    {
        $kelas = Kelas::where('guru_id', auth()->id())->findOrFail($id);

        // Cleanup related data
        $kelas->materi()->forceDelete();
        $kelas->tugas()->each(function ($tugas) {
            $tugas->pengumpulan()->delete(); // soft delete submissions
            $tugas->forceDelete();
        });
        $kelas->discussions()->forceDelete();
        $kelas->siswa()->detach();

        // Hard delete the class
        $kelas->forceDelete();
    }
}
