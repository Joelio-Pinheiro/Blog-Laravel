<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class UpvoteDownvote extends Component
{
    public Post $post;

    public function mount(Post $post) {
        $this->post = $post;
    }

    public function render()
    {
        $upvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
        ->where('is_upvote', '=', true)
        ->count();

        $downvotes = \App\Models\UpvoteDownvote::where('post_id', '=', $this->post->id)
        ->where('is_upvote', '=', false)
        ->count();

        return view('livewire.upvote-downvote', compact('upvotes', 'downvotes'));
    }

    public function upvoteDownvote($upvote = true){

        /** @var \App\Models\User $user */
        $user = request()->user();

        if (!$user) {
            return $this->redirect('login');
        }

        if (!$user->hasVerifiedEmail()) {
            return $this->redirect(route('verification.notice'));
        }

        // $upvoteDownvote = \App\Models\
    }
}
