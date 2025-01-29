<?php

namespace App\Livewire\Merchandise;

use App\Models\Employee;
use App\Models\IssueMerchandise;
use App\Models\Merchandise;
use App\Models\User;
use Livewire\Component;

class IssueMerchandises extends Component
{

    public $employee_id = "";
    public $merchandise_id = "";
    public $issued_by = "";
    public $qty = "";
    public $issue_date = "";
    public $editMode = false;
    public $merchandiseId = null;
    public $showDeleteModal = false;
    public $merchandiseToDelete = null;

    public $searchTerm = '';

    public function render()
    {
        $employees = Employee::all();
        $merchandises = Merchandise::all();
        $managers = User::all();

        $issuedMerchandises = IssueMerchandise::query()
            ->with(['employee', 'merchandise', 'issuedBy'])
            ->where('qty', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('issue_date', 'like', '%' . $this->searchTerm . '%')
            ->orWhereHas('employee', function ($query) {
                $query->where('full_name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('emp_id', 'like', '%' . $this->searchTerm . '%');
            })
            ->orWhereHas('issuedBy', function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('email', 'like', '%' . $this->searchTerm . '%');
            })
            ->orWhereHas('merchandise', function ($query) {
                $query->where('item_name', 'like', '%' . $this->searchTerm . '%');
            })
            ->latest()
            ->paginate(15);

        return view('livewire.merchandise.issue-merchandises', [
            'employees' => $employees,
            'merchandises' => $merchandises,
            'issuedMerchandises' => $issuedMerchandises,
            'managers' => $managers
        ])->layout('layouts.app');
    }
}
