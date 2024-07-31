<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePaginator **/
?>

<x-app-layout meta-description="Meu Blog pessoal da UFC">
    <!-- Posts Section -->
    <section class="w-full md:w-2/3 flex flex-col items-center px-3">

        @foreach ($posts as $post)
            <x-post-item :post="$post"></x-post-item>
        @endforeach

        {{ $posts->onEachSide(2)->links() }}
    </section>
    <x-sidebar/>
</x-app-layout>
