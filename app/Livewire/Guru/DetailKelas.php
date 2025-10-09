<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Kelas;

class DetailKelas extends Component
{
    public $kelas;
    public $kelasId;
    public $activeTab = 'materi';
    public $tugas;
    public $siswa;

    public $removingSiswaId = null;

    public function mount($id)
    {
        $this->kelasId = $id;
        $this->kelas = Kelas::with(['materi', 'tugas', 'siswa'])->findOrFail($id);

        // Check if the teacher has access to this class (either created it or joined it)
        $hasAccess = $this->kelas->guru_id === auth()->id() ||
                    $this->kelas->teachers()->where('teacher_id', auth()->id())->exists();

        if (!$hasAccess) {
            abort(403, 'You do not have access to this class.');
        }

        $this->tugas = $this->kelas->tugas;
        $this->siswa = $this->kelas->siswa;
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function deleteTugas($id)
    {
        $tugas = $this->kelas->tugas->find($id);
        if ($tugas) {
            $tugas->pengumpulan()->delete();
            $tugas->delete();
            $this->tugas = $this->kelas->tugas; // Refresh
        }
    }

    public function removeSiswa($siswaId)
    {
        $this->kelas->siswa()->detach($siswaId);
        $this->siswa = $this->kelas->siswa; // Refresh
    }

    public function render()
    {
        return view('livewire.guru.detail-kelas');
    }
}
