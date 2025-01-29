<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Employee Details') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden p-6 my-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Left Column: Employee Information -->
            <div class="max-w-1/3 space-y-6">
                <div class="flex items-center space-x-4">
                    <!-- Profile Image Placeholder (Can be replaced with an actual image) -->
                    <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" 
                             stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M16 14a4 4 0 0 0-8 0m8 0a4 4 0 0 1-8 0m8 0a4 4 0 0 0-8 0m8 0c0 2.21-3.582 4-8 4s-8-1.79-8-4m16 0c0 2.21-3.582 4-8 4s-8-1.79-8-4m8-4a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                            {{ ucwords($employee['full_name']) }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">Employee ID: {{ $employee['emp_id'] }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" 
                             stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M16 14a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"></path>
                        </svg>
                        <p class="text-gray-700 dark:text-gray-300 text-lg">Department: {{ ucwords($employee['department']) }}</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" 
                             stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M16 14a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"></path>
                        </svg>
                        <p class="text-gray-700 dark:text-gray-300 text-lg">Company Contractor: {{ ucwords($employee['company_contractor']) }}</p>
                    </div>

                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" 
                             stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M8 16l-4-4m0 0l4-4m-4 4h16"></path>
                        </svg>
                        <p class="text-gray-700 dark:text-gray-300 text-lg">Date of Joining: {{ date('F j, Y', strtotime($employee['date_of_joining'])) }}</p>
                    </div>

                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor" 
                             stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M13 16h-1v-4h-1m1-4h.01M12 20h.01M12 20c4 0 7-3 7-7 0-1.93-.78-3.68-2.05-4.95M12 20c-4 0-7-3-7-7 0-1.93.78-3.68 2.05-4.95M12 4c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                        </svg>
                        <p class="text-gray-700 dark:text-gray-300 text-lg">Last Updated: {{ date('F j, Y', strtotime($employee['updated_at'])) }}</p>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <svg class="w-6 h-6 text-red-500 dark:text-red-400" fill="none" stroke="currentColor" 
                             stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" 
                                  d="M3 10h11m-6 0V3m0 7v11m6-11h5"></path>
                        </svg>
                        <p class="text-gray-700 dark:text-gray-300 text-lg">Plant Location: {{ ucwords($employee['plant_location']) }}</p>
                    </div>
                </div>
            </div>

            <!-- Right Column: Placeholder for Additional Information -->
            <div class="max-w-2/3 space-y-6 bg-gray-100 dark:bg-gray-700 rounded-lg p-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Additional Information</h3>
                <p class="text-gray-600 dark:text-gray-300">
                    <!-- This section can be dynamically updated -->
                    Future content like documents, work history, and performance records will be shown here.
                </p>
            </div>
        </div>

        <!-- Buttons Section -->
        <div class="mt-6 flex justify-between">
            <a href="{{route('employees')}}" wire:navigate 
               class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
                Back
            </a>
        </div>
    </div>
</div>
