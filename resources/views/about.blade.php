<x-app-layout meta-title="About UFC Blog - About Us" :meta-description="'Lorem ipsum'">
    <section class="w-full flex flex-col items-center px-3">

        <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="#" class="hover:opacity-75 w-full">
                <img src="/storage/{{ $widget->image }}"
                class="w-full">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
                <h1 class="text-3xl font-bold hover:text-gray-700 pb-4">
                    {{ $widget->title }}
                </h1>
                <div>
                    {!! $widget->content !!}
                </div>
        </article>
    </section>
</x-app-layout>
