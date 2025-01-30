<div>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Employees') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6">
                <!-- Form Section -->
                @canany(['create employee', 'update employee'])
                    <div class="w-full lg:w-1/3">
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
                                {{ $editMode ? 'Edit Employee' : 'Add New Employee' }}
                            </h2>

                            @if (session()->has('message'))
                                <div
                                    class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 p-4 rounded-lg mb-6">
                                    {{ session('message') }}
                                </div>
                            @endif

                            <form wire:submit.prevent="addNewEmployee" class="space-y-6">
                                <div>
                                    <x-input-label for="emp_id" :value="__('Employee Id')" />
                                    <x-text-input wire:model.live.debounce.250ms="emp_id" id="emp_id" type="text"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        autofocus :disabled="$editMode" />
                                    <x-input-error :messages="$errors->get('emp_id')" class="mt-2" />

                                    @if ($editMode)
                                        <p class='text-sm px-2 py-2 dark:text-indigo-300 text-indigo-700'> In Edit mode EMP
                                            ID is disabled</p>
                                    @endif

                                </div>
                                <div>
                                    <x-input-label for="full_name" :value="__('Full Name')" />
                                    <x-text-input wire:model="full_name" id="full_name" type="text"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        autofocus />
                                    <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="company_contractor" :value="__('Company Contractor')" />
                                    <select id="company_contractor" wire:model="company_contractor"
                                        name="company_contractor"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Choose a Company Contractor</option>
                                        @foreach (\App\Enums\CompanyContractorsTypes::cases() as $company_contractor)
                                            <option value="{{ $company_contractor->value }}"
                                                {{ $company_contractor === $company_contractor->value ? 'selected' : '' }}>
                                                {{ $company_contractor->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('company_contractor')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="department" :value="__('Departments')" />
                                    <select id="department" wire:model="department" name="department"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Choose a department</option>
                                        @foreach (\App\Enums\DepartmentTypes::cases() as $department)
                                            <option value="{{ $department->value }}"
                                                {{ $department === $department->value ? 'selected' : '' }}>
                                                {{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('department')" class="mt-2" />
                                </div>


                                <div>
                                    <x-input-label for="category" :value="__('Category')" />
                                    <div class="flex space-x-4 mt-2">
                                        <!-- Permanent Option -->
                                        <div
                                            class="flex items-center border border-gray-200 rounded-sm px-4 py-2 dark:border-gray-700">
                                            <input id="bordered-radio-1" type="radio" value="permanent"
                                                name="bordered-radio" wire:model="category"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="bordered-radio-1"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Permanent</label>
                                        </div>

                                        <!-- Contract Option -->
                                        <div
                                            class="flex items-center border border-gray-200 rounded-sm px-4 py-2 dark:border-gray-700">
                                            <input id="bordered-radio-2" type="radio" value="contract"
                                                name="bordered-radio" wire:model="category"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="bordered-radio-2"
                                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Contract</label>
                                        </div>
                                    </div>
                                    <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                </div>


                                <div>
                                    <x-input-label for="date_of_joining" :value="__('Date of Joining')" />
                                    <x-text-input wire:model="date_of_joining" id="date_of_joining" type="text"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        autofocus placeholder="01-01-2025" />
                                    <x-input-error :messages="$errors->get('date_of_joining')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="plant_location" :value="__('Plant Location')" />
                                    <select id="plant_location" wire:model="plant_location" name="plant_location"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="" selected>Choose a Plant Location</option>
                                        @foreach (\App\Enums\PlantsLocations::cases() as $plant_locations)
                                            <option value="{{ $plant_locations->value }}"
                                                {{ $plant_location === $plant_locations->value ? 'selected' : '' }}>
                                                {{ $plant_locations->name }}</option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('plant_location')" class="mt-2" />
                                </div>

                                <div class="flex items-center gap-4">

                                    @can('create employee')
                                        @if (!$editMode)
                                            <x-primary-button>{{ 'Create Employee' }}</x-primary-button>
                                        @endif
                                    @endcan
                                    @can('update employee')
                                        @if ($editMode)
                                            <x-primary-button>{{ 'Update Employee' }}</x-primary-button>
                                        @endif
                                    @endcan

                                    @if ($editMode)
                                        <x-secondary-button wire:click="cancelEdit" type="button">
                                            Cancel
                                        </x-secondary-button>
                                    @endif
                                </div>
                            </form>
                        </div>
                    </div>
                @endcanany

                <!-- Table Section -->
                <div class="w-full @canany(['create employee', 'update employee']) lg:w-2/3 @endcanany">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Employees List</h2>
                            <x-text-input wire:model.live.debounce.300ms="searchTerm" id="searchTerm" type="text"
                                class="px-4 py-2 mt-1 block  border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                autofocus placeholder="Search employees..." />


                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            EMP ID
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Full Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Department
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Plant Location
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                    @foreach ($employees as $employee)
                                        <tr>

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ $employee->emp_id }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ ucwords($employee->full_name) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ ucwords($employee->department) }}
                                            </td>

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ ucwords($employee->plant_location) }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @can('view employee')
                                                <button wire:navigate
                                                    href="{{ route('employees.details', ['id' => $employee->id]) }}"
                                                    class="text-green-600 dark:text-green-400 hover:text-green-900 dark:hover:text-green-300 mr-4">
                                                    View
                                                </button>
                                                @endcan
                                                @can('update employee')
                                                <button wire:click="startEdit({{ $employee->id }})"
                                                    class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-900 dark:hover:text-indigo-300 mr-4">
                                                    Edit
                                                </button>
                                                @endcan
                                                @can('delete employee')
                                                <button wire:click="confirmDelete({{ $employee->id }})"
                                                    class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300">
                                                    Delete
                                                </button>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4">
                            {{ $employees->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        @if ($showDeleteModal)
            <div class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog"
                aria-modal="true">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div
                        class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 dark:bg-red-900 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600 dark:text-red-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900 dark:text-white"
                                        id="modal-title">
                                        Delete Item
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 dark:text-gray-400">
                                            Are you sure you want to delete this item? This action cannot be undone.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button wire:click="deleteEmployee" type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Delete
                            </button>
                            <button wire:click="cancelDelete" type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 shadow-sm px-4 py-2 bg-white dark:bg-gray-800 text-base font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#date_of_joining", {
            dateFormat: "d-m-Y",
            // Configuration options for Flatpickr
            // You can customize the appearance and behavior here
        });
    </script>
</div>
