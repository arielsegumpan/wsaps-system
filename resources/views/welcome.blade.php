<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">

        <livewire:layout.navigation />

        <main class="dark:bg-neutral-800">
            <!-- Slider -->
            <div class="px-4 py-10 sm:px-6 lg:px-8">
                <div data-hs-carousel='{
                    "loadingClasses": "opacity-0"
                }' class="relative">
                <div class="hs-carousel relative overflow-hidden w-full h-[30rem] md:h-[calc(100vh-106px)]  bg-gray-100 rounded-2xl dark:bg-neutral-800">
                    <div class="absolute top-0 bottom-0 flex transition-transform duration-700 opacity-0 hs-carousel-body start-0 flex-nowrap">
                    <!-- Item -->
                    <div class="hs-carousel-slide">
                        <div class="h-[30rem] md:h-[calc(100vh-106px)]  flex flex-col bg-[url('https://images.unsplash.com/photo-1615615228002-890bb61cac6e?q=80&w=1920&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-cover bg-center bg-no-repeat">
                        <div class="w-2/3 pb-5 mt-auto md:max-w-lg ps-5 md:ps-10 md:pb-10">
                            <span class="block text-white">Nike React</span>
                            <span class="block text-xl text-white md:text-3xl">Rewriting sport's playbook for billions of athletes</span>
                            <div class="mt-5">
                            <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-black bg-white border border-transparent gap-x-2 rounded-xl hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" href="#">
                                Read Case Studies
                            </a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="hs-carousel-slide">
                        <div class="h-[30rem] md:h-[calc(100vh-106px)]  flex flex-col bg-[url('https://images.unsplash.com/photo-1612287230202-1ff1d85d1bdf?q=80&w=1920&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-cover bg-center bg-no-repeat">
                        <div class="w-2/3 pb-5 mt-auto md:max-w-lg ps-5 md:ps-10 md:pb-10">
                            <span class="block text-white">CoolApps</span>
                            <span class="block text-xl text-white md:text-3xl">From mobile apps to gaming consoles</span>
                            <div class="mt-5">
                            <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-black bg-white border border-transparent gap-x-2 rounded-xl hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" href="#">
                                Read Case Studies
                            </a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- End Item -->

                    <!-- Item -->
                    <div class="hs-carousel-slide">
                        <div class="h-[30rem] md:h-[calc(100vh-106px)]  flex flex-col bg-[url('https://images.unsplash.com/photo-1629666451094-8908989cae90?q=80&w=1920&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')] bg-cover bg-center bg-no-repeat">
                        <div class="w-2/3 pb-5 mt-auto md:max-w-lg ps-5 md:ps-10 md:pb-10">
                            <span class="block text-white">Grumpy</span>
                            <span class="block text-xl text-white md:text-3xl">Bringing Art to everything</span>
                            <div class="mt-5">
                            <a class="inline-flex items-center px-3 py-2 text-sm font-medium text-black bg-white border border-transparent gap-x-2 rounded-xl hover:bg-gray-100 focus:outline-none focus:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none" href="#">
                                Read Case Studies
                            </a>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- End Item -->
                    </div>
                </div>

                <!-- Arrows -->
                <button type="button" class="absolute inset-y-0 inline-flex items-center justify-center w-12 h-full text-black hs-carousel-prev hs-carousel-disabled:opacity-50 disabled:pointer-events-none start-0 hover:bg-white/20 rounded-s-2xl focus:outline-none focus:bg-white/20">
                    <span class="text-2xl" aria-hidden="true">
                    <svg class="shrink-0 size-3.5 md:size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"></path>
                    </svg>
                    </span>
                    <span class="sr-only">Previous</span>
                </button>

                <button type="button" class="absolute inset-y-0 inline-flex items-center justify-center w-12 h-full text-black hs-carousel-next hs-carousel-disabled:opacity-50 disabled:pointer-events-none end-0 hover:bg-white/20 rounded-e-2xl focus:outline-none focus:bg-white/20">
                    <span class="sr-only">Next</span>
                    <span class="text-2xl" aria-hidden="true">
                    <svg class="shrink-0 size-3.5 md:size-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"></path>
                    </svg>
                    </span>
                </button>
                <!-- End Arrows -->
                </div>
            </div>
            <!-- End Slider -->


            <!-- Card Grid -->
            <div class="grid grid-cols-2 gap-4 py-12 sm:gap-6 md:gap-8 lg:gap-12">
                <!-- Card -->
                <a class="flex flex-col group focus:outline-none" href="#">
                <div class="overflow-hidden bg-gray-100 aspect-w-16 aspect-h-12 rounded-2xl dark:bg-neutral-800">
                    <img class="object-cover transition-transform duration-500 ease-in-out group-hover:scale-105 group-focus:scale-105 rounded-2xl" src="https://images.unsplash.com/photo-1575052814086-f385e2e2ad1b?q=80&w=560&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Blog Image">
                </div>

                <div class="pt-4">
                    <h3 class="relative inline-block font-medium text-lg text-black before:absolute before:bottom-0.5 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                    eYoga
                    </h3>
                    <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    A revamped and dynamic approach to yoga analytics
                    </p>

                    <div class="flex flex-wrap gap-2 mt-3">
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Discovery
                    </span>
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Brand Guidelines
                    </span>
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Yoga
                    </span>
                    </div>
                </div>
                </a>
                <!-- End Card -->

                <!-- Card -->
                <a class="flex flex-col group focus:outline-none" href="#">
                <div class="overflow-hidden bg-gray-100 aspect-w-16 aspect-h-12 rounded-2xl dark:bg-neutral-800">
                    <img class="object-cover transition-transform duration-500 ease-in-out group-hover:scale-105 group-focus:scale-105 rounded-2xl" src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?q=80&w=560&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Blog Image">
                </div>

                <div class="pt-4">
                    <h3 class="relative inline-block font-medium text-lg text-black before:absolute before:bottom-0.5 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                    Nike React
                    </h3>
                    <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    Rewriting sport's playbook for billions of athletes
                    </p>

                    <div class="flex flex-wrap gap-2 mt-3">
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Brand Strategy
                    </span>
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Visual Identity
                    </span>
                    </div>
                </div>
                </a>
                <!-- End Card -->

                <!-- Card -->
                <a class="flex flex-col group focus:outline-none" href="#">
                <div class="overflow-hidden bg-gray-100 aspect-w-16 aspect-h-12 rounded-2xl dark:bg-neutral-800">
                    <img class="object-cover transition-transform duration-500 ease-in-out group-hover:scale-105 group-focus:scale-105 rounded-2xl" src="https://images.unsplash.com/photo-1649999920973-ab6bfd0c0017?q=80&w=560&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Blog Image">
                </div>

                <div class="pt-4">
                    <h3 class="relative inline-block font-medium text-lg text-black before:absolute before:bottom-0.5 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                    Day Spa
                    </h3>
                    <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    Designing a new cocktail can
                    </p>

                    <div class="flex flex-wrap gap-2 mt-3">
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Brand Strategy
                    </span>
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Visual Identity
                    </span>
                    </div>
                </div>
                </a>
                <!-- End Card -->

                <!-- Card -->
                <a class="flex flex-col group focus:outline-none" href="#">
                <div class="overflow-hidden bg-gray-100 aspect-w-16 aspect-h-12 rounded-2xl dark:bg-neutral-800">
                    <img class="object-cover transition-transform duration-500 ease-in-out group-hover:scale-105 group-focus:scale-105 rounded-2xl" src="https://images.unsplash.com/photo-1528291954423-c0c71c12baeb?q=80&w=560&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Blog Image">
                </div>

                <div class="pt-4">
                    <h3 class="relative inline-block font-medium text-lg text-black before:absolute before:bottom-0.5 before:start-0 before:-z-[1] before:w-full before:h-1 before:bg-lime-400 before:transition before:origin-left before:scale-x-0 group-hover:before:scale-x-100 dark:text-white">
                    Diamond Dynamics
                    </h3>
                    <p class="mt-1 text-gray-600 dark:text-neutral-400">
                    From cutting-edge equipment to stylish apparel
                    </p>

                    <div class="flex flex-wrap gap-2 mt-3">
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Sports Gear
                    </span>
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Equipment
                    </span>
                    <span class="py-1.5 px-3 bg-white text-gray-600 border border-gray-200 text-xs sm:text-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400">
                        Discovery
                    </span>
                    </div>
                </div>
                </a>
                <!-- End Card -->
            </div>
            <!-- End Card Grid -->
        </main>
    </body>
</html>
