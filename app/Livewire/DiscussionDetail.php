<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Discussion;
use App\Models\DiscussionReply;

class DiscussionDetail extends Component
{
    public $discussion;
    public $discussionId;
    public $replyContent;
    
    public function mount($id)
    {
        $this->discussionId = $id;
        $this->discussion = Discussion::with(['user', 'replies.user'])->findOrFail($id);
        
        // Check if user has access to this discussion
        $hasAccess = false;
        
        if (auth()->user()->isGuru() && $this->discussion->kelas->guru_id == auth()->id()) {
            $hasAccess = true;
        } elseif (auth()->user()->isSiswa() && $this->discussion->kelas->siswa->contains(auth()->id())) {
            $hasAccess = true;
        }
        
        if (!$hasAccess) {
            abort(403, 'Anda tidak memiliki akses ke diskusi ini.');
        }
    }
    
    protected $rules = [
        'replyContent' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.discussion-detail');
    }
    
    public function addReply()
    {
        $validated = $this->validate();
        
        DiscussionReply::create([
            'discussion_id' => $this->discussionId,
            'user_id' => auth()->id(),
            'content' => $validated['replyContent'],
        ]);
        
        // Reset the reply content
        $this->replyContent = '';
        
        // Refresh the discussion data
        $this->discussion = Discussion::with(['user', 'replies.user'])->findOrFail($this->discussionId);
    }
}
