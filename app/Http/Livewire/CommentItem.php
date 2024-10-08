<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class CommentItem extends Component
{
    public Comment $comment;

    public bool $editing = false;

    public bool $reply = false;

    protected $listeners = [
        'cancelEditing' => 'cancelEditing',
        'commentUpdated' => 'commentUpdated',
        'commentCreated' => 'commentCreated',
        'cancelReply' => 'cancelReply',
    ];

    public function mount(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.comment-item');
    }
    public function deleteComment()
    {
        $user = auth()->user();
        if (!$user) {
            return $this->redirect('/login');
        }
        if ($this->comment->user_id != $user->id) {
            return response('You are not allowed to perform this action', 403);
        }

        $id = $this->comment->id;
        $this->comment->delete();
        $this->emitUp('commentDeleted', $id);
    }
    public function startComment()
    {
        $this->editing = true;
    }

    public function cancelEditing()
    {
        $this->editing = false;
    }

    public function commentUpdated()
    {
        $this->editing = false;
    }

    public function startReply()
    {
        $this->reply = true;
    }
    public function cancelReply()
    {
        $this->reply = false;
    }
    public function commentCreated()
    {
        $this->reply = false;
    }
}
