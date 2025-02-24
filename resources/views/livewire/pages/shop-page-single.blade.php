<div>

    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-24 mx-auto">
        <!-- Grid -->
        <div class="grid gap-10 lg:grid-cols-2 lg:gap-y-16">

            <div>
                <!-- Slider -->
                @if($product && $product->productImages->isNotEmpty())
                <div data-hs-carousel='{
                        "loadingClasses": "opacity-0",
                        {{-- "isDraggable": true --}}
                        "isAutoPlay": true
                    }' class="relative">

                    <div class="flex space-x-2 lg:flex-row hs-carousel">
                        <!-- Thumbnail Preview -->
                        <div class="flex-none">
                            <div class="flex flex-col overflow-y-auto hs-carousel-pagination max-h-96 gap-y-2
                                [&::-webkit-scrollbar]:w-2 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-track]:bg-gray-100 [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500">

                                @foreach($product->productImages as $image)
                                <div class="hs-carousel-pagination-item shrink-0 border-gray-300 rounded-md overflow-hidden cursor-pointer w-[150px] h-[150px] hs-carousel-active:border-red-500">
                                    <div class="flex justify-center h-full p-2 bg-gray-100 dark:bg-neutral-900">
                                        <img class="object-cover w-auto h-full" src="{{ asset(Storage::url($image->url)) }}" alt="{{ $product->prod_slug }}">
                                    </div>
                                </div>
                                @endforeach

                            </div>
                        </div>

                        <!-- Main Image Display -->
                        <div class="relative overflow-hidden bg-white rounded-lg grow min-h-96 max-h-40">
                            <div class="absolute top-0 bottom-0 flex transition-transform duration-700 opacity-0 hs-carousel-body start-0 flex-nowrap">

                                @foreach($product->productImages as $image)
                                <div class="hs-carousel-slide">
                                    <div class="flex justify-center h-full p-6 bg-gray-100 dark:bg-neutral-900">
                                        <img class="object-cover size-full start-0 rounded-xl" src="{{ asset(Storage::url($image->url)) }}" alt="{{ $product->prod_slug }}">
                                    </div>
                                </div>
                                @endforeach

                            </div>

                            <!-- Previous Button -->
                            <button type="button" class="hs-carousel-prev hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-s-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                                <span class="text-2xl" aria-hidden="true">
                                    <svg class="text-red-500 shrink-0 size-5 disabled:text-red-400 " xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m15 18-6-6 6-6"></path>
                                    </svg>
                                </span>
                                <span class="sr-only">{{ __('Previous') }}</span>
                            </button>

                            <!-- Next Button -->
                            <button type="button" class="hs-carousel-next hs-carousel-disabled:opacity-50 hs-carousel-disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/10 focus:outline-none focus:bg-gray-800/10 rounded-e-lg dark:text-white dark:hover:bg-white/10 dark:focus:bg-white/10">
                                <span class="sr-only">{{ __('Next') }}</span>
                                <span class="text-2xl" aria-hidden="true">
                                    <svg class="text-red-500 disabled:text-red-400 shrink-0 size-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6"></path>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
                @else
                <p class="text-center text-gray-500">{{ __('No images available for this product.') }}</p>
                @endif
                <!-- End Slider -->

            </div>

            <div>
                <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500 mb-4">{{ $product->prod_sku }}</span>
                <h1 class="text-4xl font-bold text-gray-800 dark:text-white">{{ $product->prod_name }}</h1>

                <h6 class="mt-2 text-gray-500 text-md dark:text-neutral-500">{{ $product->brand->brand_name }}</h6>

                <h2 class="text-3xl font-bold text-gray-800 dark:text-white">₱ {{ $product->prod_price }}</h2>

                <div class="flex mt-4 gap-x-2">
                    @forelse ( $product->productCategories as $prodCat)
                    <a href="{{ route('page.shop.category', $prodCat->prod_cat_slug) }}">
                        <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-800/30 dark:text-yellow-500">{{ $prodCat->prod_cat_name }}</span>
                    </a>
                    @empty
                        <h2 class="text-gray-500 dar:text-white">{{ __('No categories') }}</h2>
                    @endforelse
                </div>

                <!-- Input Number -->
                <div class="inline-block px-3 py-2 mt-3 bg-white border border-gray-300 rounded-lg dark:bg-neutral-900 dark:border-neutral-700 md:mt-4" data-hs-input-number="1">
                    <div class="flex items-center gap-x-1.5">
                    <button type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="1">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        </svg>
                    </button>
                    <input class="p-0 w-6 bg-transparent border-0 bg:gray-200 dark:bg-neutral-900 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-white" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="1" data-hs-input-number-input="1">
                    <button type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800" tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                        <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5v14"></path>
                        </svg>
                    </button>
                    </div>
                </div>
                <!-- End Input Number -->


                <div class="mt-5 md:mt-11">
                    <button type="button" class="inline-flex items-center justify-center w-[50%] px-4 py-3 text-sm font-medium text-center text-white align-middle bg-red-600 border border-transparent rounded-lg gap-x-2 hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                       {{ __('Add to cart') }}
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m5 11 4-7"></path>
                            <path d="m19 11-4-7"></path>
                            <path d="M2 11h20"></path>
                            <path d="m3.5 11 1.6 7.4a2 2 0 0 0 2 1.6h9.8c.9 0 1.8-.7 2-1.6l1.7-7.4"></path>
                            <path d="m9 11 1 9"></path>
                            <path d="M4.5 15.5h15"></path>
                            <path d="m15 11-1 9"></path>
                        </svg>
                    </button>
                </div>





            </div>

        </div>
        <!-- End Grid -->


        <div class="mt-5 md:mt-10">

            <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
                <!-- Content -->
                <div class="lg:col-span-2">
                    <div class="py-8 lg:pe-8">
                        <div class="space-y-5 text-gray-500 lg:space-y-8 dark:text-white">
                            <h2 class="text-lg font-bold lg:text-3xl dark:text-white">{{ __('Description') }}</h2>

                            {!! str($product->prod_desc)->sanitizeHtml() !!}
                        </div>
                    </div>
                </div>
                <!-- End Content -->

                <!-- Sidebar -->
                <div class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-neutral-800">
                    <div class="sticky top-0 py-8 start-0 lg:ps-8">

                        <div class="space-y-6">
                            <!-- Media -->
                            <a class="flex items-center group gap-x-6 focus:outline-none" href="#">
                            <div class="grow">
                                <span class="text-sm font-bold text-gray-800 group-hover:text-red-600 group-focus:text-red-600 dark:text-neutral-200 dark:group-hover:text-red-500 dark:group-focus:text-red-500">
                                5 Reasons to Not start a UX Designer Career in 2022/2023
                                </span>
                            </div>

                            <div class="relative overflow-hidden rounded-lg shrink-0 size-20">
                                <img class="absolute top-0 object-cover rounded-lg size-full start-0" src="https://images.unsplash.com/photo-1567016526105-22da7c13161a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Blog Image">
                            </div>
                            </a>
                            <!-- End Media -->

                            <!-- Media -->
                            <a class="flex items-center group gap-x-6 focus:outline-none" href="#">
                            <div class="grow">
                                <span class="text-sm font-bold text-gray-800 group-hover:text-red-600 group-focus:text-red-600 dark:text-neutral-200 dark:group-hover:text-red-500 dark:group-focus:text-red-500">
                                If your UX Portfolio has this 20% Well Done, it Will Give You an 80% Result
                                </span>
                            </div>

                            <div class="relative overflow-hidden rounded-lg shrink-0 size-20">
                                <img class="absolute top-0 object-cover rounded-lg size-full start-0" src="https://images.unsplash.com/photo-1542125387-c71274d94f0a?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Blog Image">
                            </div>
                            </a>
                            <!-- End Media -->

                            <!-- Media -->
                            <a class="flex items-center group gap-x-6 focus:outline-none" href="#">
                            <div class="grow">
                                <span class="text-sm font-bold text-gray-800 group-hover:text-red-600 group-focus:text-red-600 dark:text-neutral-200 dark:group-hover:text-red-500 dark:group-focus:text-red-500">
                                7 Principles of Icon Design
                                </span>
                            </div>

                            <div class="relative overflow-hidden rounded-lg shrink-0 size-20">
                                <img class="absolute top-0 object-cover rounded-lg size-full start-0" src="https://images.unsplash.com/photo-1586232702178-f044c5f4d4b7?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=320&q=80" alt="Blog Image">
                            </div>
                            </a>
                            <!-- End Media -->
                        </div>

                    </div>
                </div>
                <!-- End Sidebar -->
            </div>


        </div>
    </div>
    <!-- End Card Blog -->

</div>
