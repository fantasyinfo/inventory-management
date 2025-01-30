<?php

namespace App\Livewire\Merchandise;

use App\Models\Employee;
use App\Models\IssueMerchandise;
use App\Models\Merchandise;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

    protected function rules()
    {
        return [
            'employee_id' => 'required|exists:employees,id',
            'merchandise_id' => 'required|exists:merchandise,id',
            'qty' => 'required|numeric',
            'issue_date' => 'required|date',
        ];
    }
    public function addNewMerchandise()
    {
        $validatedData = $this->validate();

        // check if the provided qty and availble qty is exists;
        $itemAvailableQty = Merchandise::find($validatedData['merchandise_id']);
        if ($itemAvailableQty->qty < $validatedData['qty']) {
            session()->flash('message', 'Item qty is more then availbale qty!');
            return;
        }
        IssueMerchandise::create([
            'employee_id' => $validatedData['employee_id'],
            'merchandise_id' => $validatedData['merchandise_id'],
            'issued_by' => Auth::id(),
            'qty' => $validatedData['qty'],
            'issue_date' => Carbon::createFromFormat('d-m-Y', $validatedData['issue_date'])->format('Y-m-d H:i:s'),
        ]);

        // decrese the qty of that merchandise

        $merchandise = Merchandise::find($validatedData['merchandise_id']);
        $merchandise->qty = (int) $merchandise->qty - (int) $validatedData['qty'];
        $merchandise->save();

        session()->flash('message', 'Merchandise Issued successfully!');
        $this->reset(['employee_id', 'merchandise_id', 'issued_by', 'qty', 'issue_date']);
    }


    public function confirmDelete($merchandiseId)
    {
        $this->merchandiseToDelete = $merchandiseId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->merchandiseToDelete = null;
        $this->showDeleteModal = false;
    }

    public function deleteMerchandise()
    {
        if ($this->merchandiseToDelete) {
            IssueMerchandise::find($this->merchandiseToDelete)->delete();
            $this->showDeleteModal = false;
            $this->merchandiseToDelete = null;
            session()->flash('message', 'Issued Merchandise deleted successfully!');
        }
    }
}
