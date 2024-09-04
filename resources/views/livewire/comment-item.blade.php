<div class="flex mb-4 gap-3 w-full">
    <div class="w-12 h-12 flex items-center justify-center bg-gray-200 rounded-full">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
        </svg>
    </div>
    <div class="w-full">
        <div>
            <a href="#" class="text-indigo-600 font-semibold">
                {{ $comment->user->name }}
            </a>
            - <span class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        @if ($editing)
            <livewire:comment-create :commentModel="$comment" />
        @else
            <div class="text-gray-700">
                {{ $comment->comment }}
            </div>
        @endif
        <div>
            <a wire:click.prevent='startReply' href="#" class="text-indigo-600 text-sm mr-3">Reply</a>

            @if (\Illuminate\Support\Facades\Auth::id() == $comment->user_id)
                <a wire:click.prevent="startComment" href="#" class="text-blue-600 text-sm mr-3">Edit</a>
                <a wire:click.prevent="deleteComment" href="#" class="text-red-600 text-sm">Delete</a>
            @endif
        </div>
        @if ($reply)
            <livewire:comment-create :post="$comment->post" :parent-comment="$comment"/>
        @endif

        {{$comment->comments}}
    </div>

</div>
