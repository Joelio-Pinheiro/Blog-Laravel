<div class="mt-6">
    <livewire:comment-create :post="$post" class="mt-2" />
    @foreach ($comments as $comment)
        <livewire:comment-item :comment="$comment" wire:key="comment-{{$comment->id}}"/>
    @endforeach

</div>
