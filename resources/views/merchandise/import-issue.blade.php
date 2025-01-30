<x-app-layout>

    <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 p-6 shadow-md rounded-md mt-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Upload Issued Merchandise Data</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @can('bulk upload issue merchandise')
            <form action="{{ route('merchandise.issue.import') }}" method="POST" enctype="multipart/form-data"
                onsubmit="startUpload()">
                @csrf
                <input type="file" name="file"
                    class="border p-2 w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">

                <div id="progress-container" class="hidden mt-3 bg-gray-300 dark:bg-gray-600 rounded-md h-2 w-full">
                    <div id="progress-bar" class="bg-blue-500 h-2 rounded-md" style="width: 0%;"></div>
                </div>

                <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md w-full">
                    Upload File
                </button>
            </form>
        @endcan

        <div class="flex justify-between items-center mt-5">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-6">Sample CSV Format</h3>
            <a target="_blank" href="{{ url('/csv/merchandise.csv') }}" download
                class="flex items-center gap-2 px-4 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4v12m0 0l-3-3m3 3l3-3M4 16h16" />
                </svg>
                Download Sample CSV File
            </a>

        </div>
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <!-- Header Section -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                        Merchandise Data Upload Preview
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Review your bulk merchandise data before uploading
                    </p>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                        
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    EMP ID (emp_id)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    (Merchandise) SKU (sku)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Qty (qty)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Issue Date (issue_date)
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ 'EMP#001' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ 'SKU #0001' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ '2' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                    {{ '15-01-2025' }}
                                </td>
                            </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function startUpload() {
            document.getElementById('progress-container').classList.remove('hidden');
            let progressBar = document.getElementById('progress-bar');
            let width = 0;
            let interval = setInterval(() => {
                if (width >= 100) {
                    clearInterval(interval);
                } else {
                    width += 10;
                    progressBar.style.width = width + "%";
                }
            }, 500);
        }
    </script>
</x-app-layout>
