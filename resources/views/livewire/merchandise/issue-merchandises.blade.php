<div>




    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Issue Merchandise') }}
            </h2>
            @can('bulk upload issue merchandise')
                <a href="{{ route('merchandise.issue.import.form') }}" wire:navigate
                    class="flex item-center gap-2 px-4 py-2 bg-gray-300 text-gray-900 dark:bg-gray-900 dark:text-white font-semibold rounded-lg shadow-md hover:bg-gray-400 dark:hover:bg-gray-700 transition duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                    </svg>
                    Bulk Upload
                </a>
            @endcan
            
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col  gap-6">
                <!-- Form Section -->
                <div class="w-full ">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">
                            {{ $editMode ? 'Edit Issued Merchandise' : 'Issue New Merchandise' }}
                        </h2>

                        @if (session()->has('message'))
                            <div
                                class="bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 p-4 rounded-lg mb-6">
                                {{ session('message') }}
                            </div>
                        @endif

                        @can('issue merchandise')
                            <form wire:submit.prevent="addNewMerchandise" class="space-y-6">

                                <div x-data="employeeDropdown()" class="relative">
                                    <x-input-label for="employee_id" :value="__('Select Employee')" />

                                    <!-- Input for Searching -->
                                    <div class="relative">
                                        <input id="employee_id" x-model="search" @focus="open = true"
                                            @click.away="open = false" @keydown.escape="open = false"
                                            placeholder="Search Employee..."
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    </div>

                                    <!-- Dropdown Options -->
                                    <div x-show="open" x-cloak
                                        class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-[300px] overflow-y-scroll"
                                        style="display: none;">
                                        <ul class="max-h-[300px] overflow-y-scroll"
                                            style="height: 300px;overflow-y:scroll;border:1px solid">
                                            <template x-for="employee in filteredEmployees" :key="employee.id">
                                                <li @click="selectEmployee(employee)"
                                                    class="cursor-pointer px-4 py-2 text-gray-700 dark:text-white hover:bg-blue-500 hover:text-white">
                                                    <span x-text="employee.emp_id + ' ' + employee.full_name"></span>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>


                                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />

                                    <!-- Hidden Input to Bind Value -->

                                    <input type="hidden" wire:model.live="employee_id"
                                        x-bind:value="selectedEmployee?.id" />

                                </div>



                                <div x-data="itemsDropdown()" class="relative">
                                    <x-input-label for="merchandise_id" :value="__('Select Item')" />

                                    <!-- Search Input -->
                                    <div class="relative">
                                        <input id="merchandise_id" x-model="search" @focus="open = true"
                                            @click.away="open = false" @keydown.escape="open = false"
                                            placeholder="Search Item..."
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                    </div>

                                    <!-- Dropdown Options -->
                                    <div x-show="open" x-cloak
                                        class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg"
                                        style="display: none;">
                                        <ul class="max-h-[300px] overflow-y-auto">
                                            <template x-for="merchandise in filteredMerchandises" :key="merchandise.id">
                                                <li @click="selectMerchandise(merchandise)"
                                                    class="cursor-pointer px-4 py-2 text-gray-700 dark:text-white hover:bg-blue-500 hover:text-white">

                                                    <span
                                                        x-text="merchandise.item_name + ' => QTY: ' + merchandise.qty"></span>
                                                </li>
                                            </template>
                                        </ul>
                                    </div>

                                    <x-input-error :messages="$errors->get('merchandise_id')" class="mt-2" />

                                    <!-- Hidden Input -->
                                    <input type="hidden" wire:model.live="merchandise_id"
                                        x-bind:value="selectedMerchandise?.id" />
                                </div>


                                <div>
                                    <x-input-label for="qty" :value="__('Qty')" />
                                    <x-text-input wire:model="qty" id="qty" type="number"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        autofocus />
                                    <x-input-error :messages="$errors->get('qty')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="issue_date" :value="__('Issue Date')" />
                                    <x-text-input wire:model="issue_date"  id="issue_date" type="text"
                                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        autofocus />
                                    <x-input-error :messages="$errors->get('issue_date')" class="mt-2" />
                                </div>


                                <div class="flex items-center gap-4">
                                    <x-primary-button>
                                        {{ $editMode ? 'Update Issued Merchandise' : 'Issue New Merchandise' }}
                                    </x-primary-button>

                                    @if ($editMode)
                                        <x-secondary-button wire:click="cancelEdit" type="button">
                                            Cancel
                                        </x-secondary-button>
                                    @endif
                                </div>
                            </form>
                        @endcan

                    </div>
                </div>

                <!-- Table Section -->
                <div class="w-full ">
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                        <div class="flex justify-between items-center mb-4">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6">Issued Merchandise List
                            </h2>
                            <x-text-input wire:model.live.debounce.300ms="searchTerm" id="searchTerm" type="text"
                                class="px-4 py-2 mt-1 block  border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                autofocus placeholder="Search employee or merchandise..." />


                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-50 dark:bg-gray-700">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Item Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Issued Date
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Qty
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Issued Employee
                                        </th>

                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Issued By (Manager)
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                                    @foreach ($issuedMerchandises as $issuedMerchandise)
                                        <tr>

                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ $issuedMerchandise?->merchandise?->item_name }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ date('F j, Y', strtotime($issuedMerchandise?->issue_date)) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ ucwords($issuedMerchandise->qty) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                ({{ $issuedMerchandise?->employee?->emp_id }})
                                                {{ ucwords($issuedMerchandise?->employee?->full_name) }}
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-300">
                                                {{ ucwords($issuedMerchandise?->issuedBy?->name) }}
                                            </td>


                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                @can('delete issue merchandise')
                                                    <button wire:click="confirmDelete({{ $issuedMerchandise->id }})"
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
                            {{ $issuedMerchandises->onEachSide(1)->links() }}
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
                            <button wire:click="deleteMerchandise" type="button"
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
        flatpickr("#issue_date", {
            dateFormat: "d-m-Y",
            defaultDate: new Date(),
            // Configuration options for Flatpickr
            // You can customize the appearance and behavior here
        });
        document.addEventListener('alpine:init', () => {
            Alpine.data('employeeDropdown', () => ({
                search: '',
                open: false,
                selectedEmployee: null,
                employees: @json($employees),

                get filteredEmployees() {
                    if (!this.search) return this.employees;
                    return this.employees.filter(employee =>
                        (employee.emp_id + ' ' + employee.full_name)
                        .toLowerCase()
                        .includes(this.search.toLowerCase())
                    );
                },

                selectEmployee(employee) {
                    this.selectedEmployee = employee;
                    this.search = employee.emp_id + ' ' + employee.full_name;
                    // Emit a Livewire event when an employee is selected
                    this.$wire.set('employee_id', employee.id);
                    this.open = false;
                },

                init() {
                    this.selectedEmployee = null;
                    // If there's an initial value from Livewire, set it
                    if (this.$wire.get('employee_id')) {
                        const initialEmployee = this.employees.find(e => e.id === this.$wire.get(
                            'employee_id'));
                        if (initialEmployee) {
                            this.selectEmployee(initialEmployee);
                        }
                    }
                }
            }));
            Alpine.data('itemsDropdown', () => ({
                search: '',
                open: false,
                selectedMerchandise: null,
                merchandises: @json($merchandises),

                get filteredMerchandises() {
                    if (!this.search) return this.merchandises;
                    return this.merchandises.filter(merchandise =>
                        merchandise.item_name
                        .toLowerCase()
                        .includes(this.search.toLowerCase())
                    );
                },

                selectMerchandise(merchandise) {
                    this.selectedMerchandise = merchandise;
                    this.search = merchandise.item_name;
                    // Emit to Livewire
                    this.$wire.set('merchandise_id', merchandise.id);
                    this.open = false;
                },

                init() {
                    this.selectedMerchandise = null;
                    // Handle initial value if exists
                    if (this.$wire.get('merchandise_id')) {
                        const initialMerchandise = this.merchandises.find(m => m.id === this.$wire.get(
                            'merchandise_id'));
                        if (initialMerchandise) {
                            this.selectMerchandise(initialMerchandise);
                        }
                    }
                }
            }));
        });
    </script>
</div>
