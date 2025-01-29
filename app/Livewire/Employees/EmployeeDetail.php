<?php

namespace App\Livewire\Employees;

use App\Models\Employee;
use Livewire\Component;

class EmployeeDetail extends Component
{

    public $employee;
    public function mount($id){
        $this->employee = Employee::with('issueMerchandise')->find($id);
    }
    public function render()
    {
        return view('livewire.employees.employee-detail')->layout('layouts.app');
    }
}
