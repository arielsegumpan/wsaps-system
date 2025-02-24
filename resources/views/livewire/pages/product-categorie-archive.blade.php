{{-- <div>
    @dd($productCategories)
</div> --}}

<div>
    <!-- Card Blog -->
    <div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Title -->
        <div class="max-w-2xl mx-auto mb-10 text-center lg:mb-14">
            <h5 class="text-xs font-semibold text-gray-800 uppercase dark:text-white">{{ __('Product Categories') }}</h5>

            <div class="flex items-center py-3 text-sm text-gray-800 before:flex-1 before:border-t before:border-gray-200 before:me-6 after:flex-1 after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-neutral-600 dark:after:border-neutral-600">
                <h1 class="text-2xl font-bold md:text-4xl md:leading-tight dark:text-white">{{ $productCategories->prod_cat_name }}</h1>
            </div>

        </div>
        <!-- End Title -->

        <div class="flex flex-row items-center justify-between align-middle">
        <!-- Sort Menu -->
        <div class="m-1 hs-dropdown [--trigger:hover] relative inline-flex mb-4 md:mb-6">
            <button id="hs-dropdown-hover-event" type="button" class="inline-flex items-center px-4 py-3 text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-lg shadow-sm hs-dropdown-toggle gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-800 dark:border-neutral-700 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">

                <svg class="size-4" width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
                </svg>
                Sort
              <svg class="hs-dropdown-open:rotate-180 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
            </button>

            <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-60 bg-white shadow-md rounded-lg mt-2 dark:bg-neutral-800 dark:border dark:border-neutral-700 dark:divide-neutral-700 after:h-4 after:absolute after:-bottom-4 after:start-0 after:w-full before:h-4 before:absolute before:-top-4 before:start-0 before:w-full" role="menu" aria-orientation="vertical" aria-labelledby="hs-dropdown-hover-event">
              <div class="p-1 space-y-0.5">
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                  Latest
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                  Oldest
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                  Popular
                </a>
                <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-800 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700" href="#">
                  Cheaper
                </a>
              </div>
            </div>
        </div>
        <!-- End Sort menu -->

        <a class="inline-flex items-center gap-x-1.5 text-sm text-gray-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-red-500" href="{{route('page.shop')}}">
            <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
            {{ __('Back to Shop') }}
        </a>

        </div>

        <!-- Grid -->
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

            @foreach ($productCategories->products as $product )

            <!-- Card -->
            <div class="flex flex-col mb-4 bg-white border shadow-sm rounded-xl dark:bg-neutral-900 dark:border-neutral-700 dark:shadow-neutral-700/70">
                <a class="px-5 pt-5" href="{{ route('page.shop.single', $product->prod_slug) }}">
                    <div class="p-4 md:p-5">
                        <span class=" inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-teal-100 text-teal-800 dark:bg-teal-800/30 dark:text-teal-500">
                            {{ $product->prod_sku }}
                        </span>

                        <h3 class="text-lg font-bold text-gray-800 dark:text-white py-1.5">
                            {{ $product->prod_name }}
                        </h3>

                        <p class="text-sm text-gray-500 dark:text-neutral-500">
                            {{ $product->brand->brand_name }}
                        </p>

                        <!-- GROUPS -->
                        <div class="flex flex-row items-center justify-between mt-3 align-middle">
                            <h5 class="font-bold text-gray-500 dark:text-white">
                                ₱ {{ $product->prod_price}} - <span class="inline-flex items-center gap-x-1.5 py-1.5 px-3 rounded-lg text-sm font-bold bg-green-100 text-green-800 dark:bg-green-800/30 dark:text-green-500"> {{ $product->prod_qty }} </span>
                            </h5>


                        </div>
                        <!-- EBD GROUP -->

                    </div>
                    <img class="w-full h-[250px] md:h-[230px] lg:h-[350px] object-cover rounded-b-xl" src="{{ asset(Storage::url($product->productImages[0]->url)) }}" alt="{{ $product->prod_slug }}">
                </a>

                <div class="p-5">
                    <button type="button" class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-center text-white align-middle bg-red-600 border border-transparent rounded-lg gap-x-2 hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                        Add to cart
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
            <!-- End Card -->
            @endforeach()


        </div>
        <!-- End Grid -->
    </div>
    <!-- End Card Blog -->
</div>

