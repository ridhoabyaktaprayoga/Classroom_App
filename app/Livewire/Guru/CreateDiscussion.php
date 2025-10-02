<?php

namespace App\Livewire\Guru;

use Livewire\Component;
use App\Models\Discussion;
use App\Models\Kelas;

class CreateDiscussion extends Component
{
    public $kelas_id;
    public $title;
    public $content;
    
    protected $rules = [
        'kelas_id' => 'required|exists:kelas,id',
        'title' => 'required|string|max:255',
        'content' => 'required|string',
    ];

    public function render()
    {
        $kelasList = Kelas::where('guru_id', auth()->id())->get();
        return view('livewire.guru.create-discussion', [
            'kelasList' => $kelasList
        ]);
    }
    
    public function createDiscussion()
    {
        $validated = $this->validate();
        
        Discussion::create([
            'kelas_id' => $validated['kelas_id'],
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);
        
        session()->flash('message', 'Diskusi berhasil dibuat.');
        
        // Reset form
        $this->reset(['kelas_id', 'title', 'content']);
        
        // Redirect to kelas detail
        return $this->redirectRoute('guru.kelas.show', ['id' => $validated['kelas_id']], navigate: true);
    }
}
