<?php

namespace App\Livewire\Admin;

use App\Models\Kelas;
use App\Models\Materi;
use App\Models\Tugas;
use Livewire\Component;
use Livewire\WithPagination;

class ClassManagement extends Component
{
    use WithPagination;

    public $layout = 'layouts.admin';

    public function render()
    {
        $kelas = Kelas::with('guru')->paginate(10);
        $materi = Materi::with('kelas')->paginate(10);
        $tugas = Tugas::with('kelas')->paginate(10);

        return view('livewire.admin.class-management', compact('kelas', 'materi', 'tugas'));
    }

    public function deleteKelas(Kelas $kelas)
    {
        $kelas->delete();
        session()->flash('message', 'Class deleted successfully.');
    }

    public function deleteMateri(Materi $materi)
    {
        $materi->delete();
        session()->flash('message', 'Material deleted successfully.');
    }

    public function deleteTugas(Tugas $tugas)
    {
        $tugas->delete();
        session()->flash('message', 'Assignment deleted successfully.');
    }
}
