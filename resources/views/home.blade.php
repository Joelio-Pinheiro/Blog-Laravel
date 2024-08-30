<?php
/** @var $posts \Illuminate\Pagination\LengthAwarePaginator **/
?>

<x-app-layout meta-title="Blog UFC" meta-description="Meu Blog pessoal da UFC">
    <div class="container max-w-6xl mx-auto py-6">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

            {{-- Latest post --}}
            <div class="col-span-3 sm:col-span-2">
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Latest Post
                </h2>

                <x-post-item :post="$latestPost" />
            </div>

            {{-- Popular 3 Post --}}
            <div>
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Popular Posts
                </h2>
                <div>
                    @foreach ($popularPosts as $post)
                        <div class="grid grid-cols-4 gap-2 pt-2">
                            <a href="{{ route('view', $post) }}" class="pt-1">
                                <img src="{{ $post->getThumbnail() }}" alt="{{ $post->title }}">
                            </a>
                            <div class="col-span-3">
                                <a href="{{ route('view', $post) }}">
                                    <h3 class="text-sm font-semibold uppercase whitespace-nowrap truncate">
                                        {{ $post->title }}
                                    </h3>
                                </a>
                                <div class="flex gap-3 mb-2">
                                    @foreach ($post->categories as $category)
                                        <a href="{{ route('by-category', $category) }}"
                                            class="bg-blue-500 text-white p-1 rounded text-sm font-bold uppercase">
                                            {{ $category->title }}
                                        </a>
                                    @endforeach
                                </div>
                                <div class="text-xs">
                                    {{ $post->shortBody(20) }}
                                </div>
                                <a href={{ $post->slug }} class="text-sm text-gray-800 hover:text-black">Continue
                                    Reading <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Recommended posts --}}
            <div class="col-span-3 mb-4">
                <h2 class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                    Recommended Posts
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach ($recommendedPosts as $post)
                        <x-post-item :post="$post" :showAuthor="false" />
                    @endforeach
                </div>
            </div>

            {{-- Latest Categories --}}
            @foreach ($categories as $category)
                <div class="col-span-3">
                    <h2
                        class="text-lg sm:text-xl font-bold text-blue-500 uppercase pb-1 border-b-2 border-blue-500 mb-3">
                        <a href="{{route('by-category', $category)}}">
                            Category "{{ $category->title }}" <i class="fas fa-arrow-right"></i>
                        </a>
                    </h2>
                    <div class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @foreach ($category->publishedPosts()->limit(3)->get() as $post)
                                <x-post-item :post="$post" :show-author="false" />
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</x-app-layout>
