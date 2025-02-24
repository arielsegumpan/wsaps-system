
<div>
    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-32 mx-auto">

        <!-- Title -->
        <div class="max-w-2xl mx-auto mb-10 text-center lg:mb-14">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">Read our latest blog</h2>
            <p class="mt-1 text-gray-600 dark:text-neutral-400">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laudantium possimus repellendus ipsum.</p>
        </div>
        <!-- End Title -->



        <!-- Grid -->
        <div class="grid gap-6 lg:grid-cols-2">
            @forelse ($posts as $post )

            <!-- Card -->
            <a class="relative block group rounded-xl focus:outline-none" href="{{ route('page.blog.single', $post->slug) }}">
                <div class="shrink-0 relative rounded-xl overflow-hidden w-full h-[350px] before:absolute before:inset-x-0 before:z-[1] before:size-full before:bg-gradient-to-t before:from-gray-900/70">
                <img class="absolute top-0 object-cover size-full start-0" src="{{ asset(Storage::url($post->featured_img)) }}" alt="{{ $post->slug }}">
                </div>

                <div class="absolute inset-x-0 top-0 z-10">
                <div class="flex flex-col h-full p-4 sm:p-6">
                    <!-- Avatar -->
                    <div class="flex items-center">
                    <div class="shrink-0">
                        <img class="size-[46px] border-2 border-white rounded-full" src="https://images.unsplash.com/photo-1669837401587-f9a4cfe3126e?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80" alt="Avatar">
                    </div>
                    <div class="ms-2.5 sm:ms-4">
                        <h4 class="font-semibold text-white">
                        Gloria
                        </h4>
                        <p class="text-xs text-white/80">
                        Jan 09, 2021
                        </p>
                    </div>
                    </div>
                    <!-- End Avatar -->
                </div>
                </div>

                <div class="absolute inset-x-0 bottom-0 z-10">
                <div class="flex flex-col h-full p-4 sm:p-6">
                    <h3 class="text-lg font-semibold text-white sm:text-3xl group-hover:text-white/80 group-focus:text-white/80">
                        {{ $post->title }}
                    </h3>
                    <p class="mt-2 text-white/80">
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">{{ $post->blogCategory->cat_name }}</span>
                    </p>


                </div>
                </div>
            </a>
            <!-- End Card -->

            @empty
                <div class="relative flex-col block col-span-2 text-center">

                    <svg class="mx-auto mb-4 text-gray-500 size-10 dark:text-red-500" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                    </svg>

                    <h2 class="mx-auto text-gray-500 dark:text-white">
                        {{ __('No posts displayed') }}
                    </h2>
                </div>
            @endforelse

        </div>
        <!-- End Grid -->
    </div>
    <!-- End Card Blog -->
</div>
