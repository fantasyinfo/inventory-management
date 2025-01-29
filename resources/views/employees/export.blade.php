<x-app-layout>

    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden p-6 my-3">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Export Merchandise Issue Reports</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('employees.export') }}" method="POST">
            @csrf
            <label class="text-gray-800 dark:text-gray-200">From Date</label>
            <input type="date" name="from_date" id="from_date"
                class="border p-2 w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 mb-3"
                required>

            <label class="text-gray-800 dark:text-gray-200">To Date</label>
            <input type="date" name="to_date"  id="to_date"
                class="border p-2 w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 mb-3"
                required>

            <label class="text-gray-800 dark:text-gray-200">Select Format</label>
            <select name="format"
                class="border p-2 w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 mb-3"
                required>
                <option value="csv">CSV</option>
                <option value="xlsx">Excel</option>
            </select>

            <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md w-full">
                Export File
            </button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#from_date", {
            dateFormat: "d-m-Y",

        });
        flatpickr("#to_date", {
            dateFormat: "d-m-Y",
  
        });
    </script>
</x-app-layout>
