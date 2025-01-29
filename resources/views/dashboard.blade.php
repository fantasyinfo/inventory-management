<?php

$totalEmployees = \App\Models\Employee::getTotalCount();
$totalJoiningKit = \App\Models\Merchandise::getTotalItemCount('Joining Kit');
$totalItemValue = \App\Models\Merchandise::getTotalItemValue();

?>

<x-app-layout>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Active Employees -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 dark:bg-red-900 mr-4">
                            <svg class="h-6 w-6 text-red-600 dark:text-red-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Active Total Employees</p>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ $totalEmployees }}</p>
                        </div>
                    </div>
                </div>

                <!-- Total Stores -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 dark:bg-blue-900 mr-4">
                            <svg class="h-6 w-6 text-blue-600 dark:text-blue-300" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Joining Kit</p>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ $totalJoiningKit }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Total Value of Merchandise -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-purple-100 dark:bg-purple-900 mr-4">
                            <svg class="h-6 w-6 text-purple-600 dark:text-purple-300" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Total Value of Merchandise</p>
                            <p class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{$totalItemValue}}</p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Action Buttons Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Issue Merchandising -->
                <a href="{{ route('issue.merchandise') }}" wire:navigate
                    class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span class="text-center font-semibold">ISSUE MERCHANDISING</span>
                        </div>
                    </div>
                </a>

                <!-- Available Stock -->
                <a href="{{ route('available.stocks') }}" wire:navigate
                    class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                            <span class="text-center font-semibold">AVAILABLE STOCK</span>
                        </div>
                    </div>
                </a>

                <!-- Add Employee -->
                <a href="{{ route('employees') }}" wire:navigate class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            <span class="text-center font-semibold">ADD AN EMPLOYEE</span>
                        </div>
                    </div>
                </a>

                <!-- Upload Employee Data -->
                <a href="{{route('employees.import.form')}}" wire:navigate class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span class="text-center font-semibold">UPLOAD EMPLOYEE DATA BULK (XLS)</span>
                        </div>
                    </div>
                </a>

                <!-- Add New Merchandising -->
                <a href="{{ route('merchandise') }}" wire:navigate class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-center font-semibold">ADD NEW MERCHANDISING</span>
                        </div>
                    </div>
                </a>

                <!-- Add New Store Manager -->
                <a wire:navigate href="{{ route('managers') }}" class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="text-center font-semibold">ADD NEW STORE MANAGER</span>
                        </div>
                    </div>
                </a>

                <!-- Download Report -->
                <a href="#" class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-center font-semibold">DOWNLOAD REPORT</span>
                        </div>
                    </div>
                </a>

                <!-- Update Employee Details -->
                <a href="{{ route('employees') }}" wire:navigate class="transform transition-all hover:scale-105">
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg text-gray-900 dark:text-white">
                        <div class="flex flex-col items-center">
                            <svg class="h-8 w-8 mb-2 text-gray-700 dark:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="text-center font-semibold">UPDATE EMPLOYEE DETAILS</span>
                        </div>
                    </div>
                </a>
            </div>


        </div>
    </div>

    <!-- Add this script section at the end of your layout -->
    <script>
        // Dark mode toggle functionality (if needed)
        function toggleDarkMode() {
            document.documentElement.classList.toggle('dark');
            // Save preference to localStorage
            localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        }

        // Adobe modal functionality
        const modal = document.getElementById('adobe-modal');
        const cancelBtn = document.getElementById('cancel-btn');
        const okBtn = document.getElementById('ok-btn');

        // Show modal (you can trigger this when needed)
        function showModal() {
            modal.classList.remove('hidden');
        }

        // Hide modal
        function hideModal() {
            modal.classList.add('hidden');
        }

        // Add click events
        cancelBtn?.addEventListener('click', hideModal);
        okBtn?.addEventListener('click', hideModal);
    </script>
</x-app-layout>
