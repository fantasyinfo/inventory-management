<?php

namespace App\Livewire\Manager;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Managers extends Component
{
    use WithPagination;

    public $username = "", $email = "", $password = "", $password_confirmation = "";
    public $editMode = false;
    public $managerId = null;
    public $showDeleteModal = false;
    public $managerToDelete = null;

    public $permissions = [], $selectedPermissions = [];

    protected function rules()
    {
        $passwordRules = $this->editMode
            ? ['nullable', 'string', 'min:3']
            : ['required', 'string', 'min:3'];

        $permissionsRules = $this->editMode ? ['array'] : ['nullable'];

        return [
            'username' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email,' . $this->managerId,
            'password' => $passwordRules,
            'selectedPermissions' => $permissionsRules,
            'password_confirmation' => $this->editMode
                ? 'nullable|same:password'
                : 'required_with:password|same:password|string|min:3',
        ];
    }

    public function startEdit($managerId)
    {
        $this->editMode = true;
        $this->managerId = $managerId;
        $manager = User::find($managerId);
        $this->username = $manager->name;
        $this->email = $manager->email;
        $this->password = '';
        $this->password_confirmation = '';

        $this->permissions = Permission::orderBy('id')->get(['id', 'name']);

        // Fetch user’s assigned permissions and auto-check them
        $this->selectedPermissions = $manager->permissions->pluck('name')->toArray();
    }

    public function cancelEdit()
    {
        $this->reset(['username', 'email', 'password', 'password_confirmation', 'editMode', 'managerId']);
    }

    public function confirmDelete($managerId)
    {
        $this->managerToDelete = $managerId;
        $this->showDeleteModal = true;
    }

    public function cancelDelete()
    {
        $this->managerToDelete = null;
        $this->showDeleteModal = false;
    }

    public function deleteManager()
    {
        if ($this->managerToDelete) {
            User::find($this->managerToDelete)->delete();
            $this->showDeleteModal = false;
            $this->managerToDelete = null;
            session()->flash('message', 'Manager deleted successfully!');
        }
    }

    public function addNewManager()
    {

        $validatedData = $this->validate();


        if ($this->editMode) {
            $manager = User::find($this->managerId);
            $manager->name = $validatedData['username'];
            $manager->email = $validatedData['email'];
            if (!empty($validatedData['password'])) {
                $manager->password = Hash::make($validatedData['password']);
            }
            $manager->save();

            $manager->syncPermissions($validatedData['selectedPermissions']);

            session()->flash('message', 'Manager updated successfully!');
        } else {
            $manager = User::create([
                'name' => $validatedData['username'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $manager->assignRole('Store Manager');

            // Ensure permissions from role are applied to the user
            $role = Role::where('name', 'Store Manager')->first();
            if ($role) {
                $manager->syncPermissions($role->permissions->pluck('name')->toArray());
            }


            session()->flash('message', 'Manager created successfully!');
        }

        $this->cancelEdit();
    }

    public function render()
    {
        return view('livewire.manager.managers', [
            'managers' => User::query()->latest()->paginate(10)
        ])->layout('layouts.app');
    }
}