<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class Employees extends Component
{

    use WithPagination;

    public $emp_id = "", $department = "", $full_name = "", $company_contractor = "", $category = "", $date_of_joining = "", $plant_location = "";
    public $editMode = false;
    public $employeeId = null;
    public $showDeleteModal = false;
    public $employeeToDelete = null;




    /**
     * Summary of updatedEmpId
     * @param mixed $value
     * @return void
     */
    public function updatedEmpId($value)
    {
        if (!is_null($value)) {
            if (Employee::where('emp_id', $value)->exists()) {
                // Add error to the error bag
                $this->addError('emp_id', 'This Employee ID already exists.');
            } else {
                // Clear error if emp_id doesn't exist
                $this->resetErrorBag('emp_id');
            }
        }
    }

    /**
     * Summary of rules
     * @return array{category: string, company_contractor: string, date_of_joining: string, department: string, emp_id: string, full_name: string, plant_location: string}
     */protected function rules()
{
    return [
        'full_name' => 'required|string|min:3',
        'emp_id' => [
            'required',
            'string',
            Rule::unique('employees', 'emp_id')->ignore($this->emp_id, 'emp_id') // Replace 'id' with the column name used to identify the record
        ],
        'department' => 'required|string',
        'company_contractor' => 'required|string',
        'category' => 'required|string',
        'date_of_joining' => 'required|date',
        'plant_location' => 'required|string',
    ];
}


    /**
     * Summary of startEdit
     * @param mixed $employeeId
     * @return void
     */
    public function startEdit($employeeId)
    {
        $this->editMode = true;
        $this->employeeId = $employeeId;
        $employee = Employee::find($employeeId);
        $this->emp_id = $employee->emp_id;
        $this->department = $employee->department;
        $this->full_name = $employee->full_name;
        $this->company_contractor = $employee->company_contractor;
        $this->category = $employee->category;
        $this->date_of_joining = Carbon::parse($employee->date_of_joining)->format('d-m-Y');
        $this->plant_location = $employee->plant_location;

    }

    /**
     * Summary of cancelEdit
     * @return void
     */
    public function cancelEdit()
    {
        $this->reset(['emp_id', 'department', 'full_name', 'company_contractor', 'category', 'date_of_joining', 'plant_location', 'editMode', 'employeeId']);
    }


    /**
     * Summary of confirmDelete
     * @param mixed $employeeId
     * @return void
     */
    public function confirmDelete($employeeId)
    {
        $this->employeeToDelete = $employeeId;
        $this->showDeleteModal = true;
    }

    /**
     * Summary of cancelDelete
     * @return void
     */
    public function cancelDelete()
    {
        $this->employeeToDelete = null;
        $this->showDeleteModal = false;
    }

    /**
     * Summary of deleteEmployee
     * @return void
     */
    public function deleteEmployee()
    {
        if ($this->employeeToDelete) {
            Employee::find($this->employeeToDelete)->delete();
            $this->showDeleteModal = false;
            $this->employeeToDelete = null;
            session()->flash('message', 'Employee deleted successfully!');
        }
    }

    /**
     * Summary of addNewEmployee
     * @return void
     */
    public function addNewEmployee()
    {
        $validatedData = $this->validate();



        if ($this->editMode) {

            info('date_of_joining:', [$validatedData['date_of_joining']]);

            $employee = Employee::find($this->employeeId);

            $employee->emp_id = $validatedData['emp_id'];
            $employee->department = $validatedData['department'];
            $employee->full_name = $validatedData['full_name'];
            $employee->company_contractor = $validatedData['company_contractor'];
            $employee->category = $validatedData['category'];
            $employee->date_of_joining = Carbon::createFromFormat('d-m-Y', $validatedData['date_of_joining'])->format('Y-m-d H:i:s');
            $employee->plant_location = $validatedData['plant_location'];

            $employee->save();
            session()->flash('message', 'Employee updated successfully!');
        } else {
            Employee::create([
                'emp_id' => $validatedData['emp_id'],
                'department' => $validatedData['department'],
                'full_name' => $validatedData['full_name'],
                'company_contractor' => $validatedData['company_contractor'],
                'category' => $validatedData['category'],
                'date_of_joining' => Carbon::createFromFormat('d-m-Y', $validatedData['date_of_joining'])->format('Y-m-d H:i:s'),
                'plant_location' => $validatedData['plant_location'],
            ]);
            session()->flash('message', 'Employee created successfully!');
        }

        $this->cancelEdit();
    }

    /**
     * Summary of render
     */
    public function render()
    {
        return view('livewire.employees.employees', [
            'employees' => Employee::paginate(10)
        ])->layout('layouts.app');
    }
}
