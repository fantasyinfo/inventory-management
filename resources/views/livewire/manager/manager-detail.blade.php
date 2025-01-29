<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Manager Details') }}
            </h2>
        </div>
    </x-slot>
    <div class="max-w-lg mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-2xl overflow-hidden p-6 my-3">
        <div class="flex items-center space-x-4">
            <!-- Profile Image (Placeholder) -->
            <div class="w-20 h-20 bg-gray-300 dark:bg-gray-700 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" 
                     stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M16 14a4 4 0 0 0-8 0m8 0a4 4 0 0 1-8 0m8 0a4 4 0 0 0-8 0m8 0c0 2.21-3.582 4-8 4s-8-1.79-8-4m16 0c0 2.21-3.582 4-8 4s-8-1.79-8-4m8-4a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"></path>
                </svg>
            </div>
            <!-- User Info -->
            <div>
                <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">
                    {{ $manager['name'] }}
                </h2>
                <p class="text-gray-600 dark:text-gray-300 text-sm">Admin</p>
            </div>
        </div>
    
        <!-- Info Section -->
        <div class="mt-6 space-y-4 ">
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-indigo-500 dark:text-indigo-400" fill="none" stroke="currentColor" 
                     stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M16.5 10.5a4 4 0 1 1-9 0 4 4 0 0 1 9 0zm0 0v.01m0 5a7 7 0 1 1-10.96-6.32M3 20h18"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">{{ $manager['email'] }}</p>
            </div>
    
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-green-500 dark:text-green-400" fill="none" stroke="currentColor" 
                     stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M8 16l-4-4m0 0l4-4m-4 4h16"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">Joined: {{ date('F j, Y', strtotime($manager['created_at'])) }}</p>
            </div>
    
            <div class="flex items-center space-x-3">
                <svg class="w-6 h-6 text-yellow-500 dark:text-yellow-400" fill="none" stroke="currentColor" 
                     stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                          d="M13 16h-1v-4h-1m1-4h.01M12 20h.01M12 20c4 0 7-3 7-7 0-1.93-.78-3.68-2.05-4.95M12 20c-4 0-7-3-7-7 0-1.93.78-3.68 2.05-4.95M12 4c-1.104 0-2 .896-2 2s.896 2 2 2 2-.896 2-2-.896-2-2-2z"></path>
                </svg>
                <p class="text-gray-700 dark:text-gray-300 text-lg">Last Updated: {{ date('F j, Y', strtotime($manager['updated_at'])) }}</p>
            </div>
        </div>
    
        <!-- Buttons Section -->
        <div class="mt-6 flex justify-between">
  
            <a href="{{route('managers')}}" wire:navigate class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-lg transition">
                Back
            </a>
        </div>
    </div>
    

</div>
