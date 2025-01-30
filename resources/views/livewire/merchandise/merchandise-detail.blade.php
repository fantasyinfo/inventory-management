<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Merchandise Details') }}
            </h2>
        </div>
    </x-slot>
    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden p-6 my-3">
        <div class="flex items-center space-x-4">

            <div class="mt-2">
                @if ($merchandise['item_image'])
                    <img src="{{ asset('storage/' . $merchandise['item_image']) }}"
                        class="w-24 h-24 rounded-lg border border-gray-300">
                @else
                    <img src="{{ asset('storage/merchandise_images/product-default.png') }}"
                        class="w-24 h-24 rounded-lg border border-gray-300">
                @endif
            </div>

            <!-- User Info -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                    {{ ucwords($merchandise['item_name']) }}
                </h2>

            </div>
        </div>

        <!-- Info Section -->
        <div class="mt-6 space-y-4 ">
            <!-- Item Name -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 14a4 4 0 1 0-8 0 4 4 0 0 0 8 0z"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <span class="font-semibold">Item Name:</span> {{ ucwords($merchandise['item_name']) }}
                </p>
            </div>



            <!-- Supplier Name -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 20h.01M12 20c4 0 7-3 7-7 0-1.93-.78-3.68-2.05-4.95M12 20c-4 0-7-3-7-7 0-1.93.78-3.68-2.05-4.95M12 4c1.104 0 2-.896 2-2s-.896 2-2 2-2 .896-2 2z">
                    </path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <span class="font-semibold">Supplier Name:</span> {{ $merchandise['supplier_name'] }}
                </p>
            </div>

            <!-- Brand/Make -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-red-500 dark:text-red-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <span class="font-semibold">Brand/Make:</span> {{ $merchandise['brand_make'] }}
                </p>
            </div>

            <!-- Quantity -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-purple-500 dark:text-purple-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h11m-6 0V3m0 7v11m6-11h5"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <span class="font-semibold">Quantity:</span> {{ $merchandise['qty'] }}
                </p>
            </div>

            <!-- Cost Per Item -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-teal-500 dark:text-teal-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8c1.5-2 6-2 6 0 0 2-4 2-6 0zm0 0c-1.5-2-6-2-6 0 0 2 4 2 6 0z"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <span class="font-semibold">Cost Per Item:</span> {{ $merchandise['cost_per_item'] }}
                </p>
            </div>

            <!-- Plant Location -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-blue-500 dark:text-blue-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 20c4 0 7-3 7-7 0-3.9-3.6-7-7-7s-7 3.1-7 7 3.6 7 7 7z"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <span class="font-semibold">Plant Location:</span> {{ $merchandise['plant_location'] }}
                </p>
            </div>

            <!-- Store Number -->
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16m-7 4h7"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">
                    <span class="font-semibold">Store Number:</span> {{ $merchandise['store_number'] }}
                </p>
            </div>

            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 16l-4-4m0 0l4-4m-4 4h16"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">Date of Purchase:
                    {{ date('F j, Y', strtotime($merchandise['date_of_purchase'])) }}</p>
            </div>

            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M12 20h.01M12 20c4 0 7-3 7-7 0-1.93-.78-3.68-2.05-4.95M12 20c-4 0-7-3-7-7 0-1.93.78-3.68 2.05-4.95M12 4c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z">
                    </path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">Last Updated:
                    {{ date('F j, Y', strtotime($merchandise['updated_at'])) }}</p>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="mt-6 flex justify-between">

            <a href="{{ route('merchandise') }}" wire:navigate
                class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
                Back
            </a>
        </div>
    </div>


</div>
