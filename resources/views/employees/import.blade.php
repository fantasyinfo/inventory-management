<x-app-layout>




    <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 p-6 shadow-md rounded-md mt-10">
        <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">Upload Employee Data</h2>

        @if (session('success'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('employees.import') }}" method="POST" enctype="multipart/form-data"
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

        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mt-6">Sample CSV Format</h3>
        <a target="_blank" class="bg-green-600 px-3 py-2" href="{{url('/csv/employee.csv')}}" download >Download Sample CSV File</a>
        <div class="container mx-auto px-4 py-8">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <!-- Header Section -->
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-white">
                        Employee Data Upload Preview
                    </h2>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                        Review your bulk employee data before uploading
                    </p>
                </div>

                <!-- Table Section -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Emp ID (emp_id)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Department (department)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Full Name (full_name)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Company Contractor (company_contractor)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Category (category)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Date of Joining (date_of_joining)
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300  tracking-wider">
                                    Plant Location (plant_location)
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach ($employees ?? [] as $employee)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $employee->emp_id ?? '1001' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $employee->department ?? 'HR' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $employee->full_name ?? 'John Doe' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $employee->company_contractor ?? 'Company A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ ($employee->category ?? 'Permanent') === 'Permanent'
                                                ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                                : 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' }}">
                                            {{ $employee->category ?? 'Permanent' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $employee->date_of_joining ?? '15-01-2025' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        {{ $employee->plant_location ?? 'New York' }}
                                    </td>
                                </tr>
                            @endforeach

                            <!-- Sample data row (will only show if $employees is empty) -->
                            @if (empty($employees))
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        1001</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">HR
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        John Doe</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        Company A</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Permanent
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                        2022-01-15</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">New
                                        York</td>
                                </tr>
                            @endif
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
