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

            <div x-data="employeeDropdown()" class="relative my-2">
                <x-input-label for="employee_id" :value="__('Select Employee (Optional)')" />

                <!-- Input for Searching -->
                <div class="relative">
                    <input id="employee_id" x-model="search" @focus="open = true" @click.away="open = false"
                        @keydown.escape="open = false" placeholder="Search Employee..."
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

                <input type="hidden" name="employee_id" x-bind:value="selectedEmployee?.id" />

            </div>
            <div
                class="my-3 flex items-center bg-red-100 border-l-4 border-red-600 text-red-700 dark:bg-red-900 dark:border-red-700 dark:text-red-100 px-4 py-3 rounded-lg">
                <svg class="w-6 h-6 mr-3 text-red-700 dark:text-red-100" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                </svg>
                <p class="text-sm font-semibold">
                    If no employee is selected, the report will include <span class="font-bold">all employees'
                        data</span>.
                </p>
            </div>


            <div>
            <label class="text-gray-800 dark:text-gray-200 mt-2">From Date</label>
            <input type="date" name="from_date" id="from_date"
                class="border p-2 w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 mb-3"
                required>
                <x-input-error :messages="$errors->get('from_date')" class="mt-2" />
            </div>
            
            <div>
            <label class="text-gray-800 dark:text-gray-200 mt-2">To Date</label>
            <input type="date" name="to_date" id="to_date"
                class="border p-2 w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 mb-3"
                >
            <x-input-error :messages="$errors->get('to_date')" class="mt-2" />
            </div>

            <div>
            <label class="text-gray-800 dark:text-gray-200">Select Format</label>
            <select name="format"
                class="border p-2 w-full rounded-md bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 mb-3"
                required>
                <option value="csv">CSV</option>
                <option value="xlsx">Excel</option>
            </select>
            <x-input-error :messages="$errors->get('format')" class="mt-2" />
        </div>

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
        });
    </script>
</x-app-layout>
