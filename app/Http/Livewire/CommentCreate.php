<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class CommentCreate extends Component
{
    public Post $post;

    public function mount(Post $post) {
        $this->post = $post;
    }

    public string $comment = '';

    public function render()
    {
        return view('livewire.comment-create');
    }

    public function createComment()
    {
        $user = auth()->user();
        if (!$user) {
            return $this->redirect('/login');
        }

        dd(Comment::create([
            'comment' => $this->comment,
            'post_id' => $this->post->id,
            'user_id' => $user->id,
        ]));

    }
}
