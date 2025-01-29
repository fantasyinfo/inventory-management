<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Available Stocks') }}
            </h2>
        </div>
    </x-slot>
    <div class="p-6 bg-gray-100 dark:bg-gray-900 min-h-screen">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Available Stocks</h2>

            <input type="text" id="search" placeholder="Search items..."
                class="w-full p-2 mb-4 border border-gray-300 rounded-lg dark:bg-gray-800 dark:text-gray-200 dark:border-gray-600"
                onkeyup="filterItems()">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="stockList">
                @foreach ($merchandises as $item)
                    <div
                        class="p-4 bg-white dark:bg-gray-800 rounded-xl shadow-md flex flex-col justify-between stock-item">
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $item->item_name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">Quantity: <span
                                class="font-bold">{{ $item->qty }}</span></p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <script>
        function filterItems() {
            let input = document.getElementById('search').value.toLowerCase();
            let items = document.querySelectorAll('.stock-item');

            items.forEach(item => {
                let name = item.querySelector('h3').textContent.toLowerCase();
                item.style.display = name.includes(input) ? '' : 'none';
            });
        }
    </script>
</div>
