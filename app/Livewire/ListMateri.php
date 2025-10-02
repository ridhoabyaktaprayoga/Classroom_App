<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Materi;

class ListMateri extends Component
{
    public $kelasId;

    public function mount($kelasId = null)
    {
        $this->kelasId = $kelasId;
    }

    public function render()
    {
        if ($this->kelasId) {
            // For a specific class
            $materiList = Materi::where('kelas_id', $this->kelasId)->get();
        } else {
            // For all classes user has access to (for siswa) or created by user (for guru)
            if (auth()->user()->isGuru()) {
                $materiList = Materi::whereHas('kelas', function($query) {
                    $query->where('guru_id', auth()->id());
                })->get();
            } else {
                $materiList = Materi::whereHas('kelas', function($query) {
                    $query->whereHas('siswa', function($subQuery) {
                        $subQuery->where('user_id', auth()->id());
                    });
                })->get();
            }
        }
        
        return view('livewire.list-materi', [
            'materiList' => $materiList
        ]);
    }
}
