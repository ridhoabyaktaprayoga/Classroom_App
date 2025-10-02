<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Discussion;

class ListDiscussions extends Component
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
            $discussions = Discussion::where('kelas_id', $this->kelasId)
                                   ->with(['user', 'replies'])
                                   ->latest()
                                   ->get();
        } else {
            // For all classes user has access to (for siswa) or created by user (for guru)
            if (auth()->user()->isGuru()) {
                $discussions = Discussion::whereHas('kelas', function($query) {
                    $query->where('guru_id', auth()->id());
                })->with(['user', 'replies'])->latest()->get();
            } else {
                $discussions = Discussion::whereHas('kelas', function($query) {
                    $query->whereHas('siswa', function($subQuery) {
                        $subQuery->where('users.id', auth()->id());
                    });
                })->with(['user', 'replies'])->latest()->get();
            }
        }

        return view('livewire.list-discussions', [
            'discussions' => $discussions
        ]);
    }
}
