<?php

namespace App\Livewire\Merchandise;

use App\Models\Merchandise as ModelsMerchandise;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class Merchandise extends Component
{

    use WithPagination;


    public $item_name = "", $date_of_purchase = "", $supplier_name = "", $brand_make = "", $qty = "", $cost_per_item = "", $plant_location = "", $store_number = "";
    public $editMode = false;
    public $merchandiseId = null;
    public $showDeleteModal = false;
    public $merchandiseToDelete = null;

    public $searchTerm = '';

    public function updatingSearchTerm()
    {
        $this->resetPage(); // Reset to the first page when searching
    }

    public function render()
    {

        $merchanides = ModelsMerchandise::query()
            ->where('item_name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('date_of_purchase', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('supplier_name', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('brand_make', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('cost_per_item', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('store_number', 'like', '%' . $this->searchTerm . '%')
            ->orWhere('plant_location', 'like', '%' . $this->searchTerm . '%')
            ->latest()
            ->paginate(15);

        return view('livewire.merchandise.merchandise', [
            'merchanides' => $merchanides
        ])->layout('layouts.app');
    }


    protected function rules()
    {
        return [
            'item_name' => 'required|string|min:3',
            'supplier_name' => 'required|string|min:3',
            'brand_make' => 'required|string',
            'qty' => 'required|numeric',
            'cost_per_item' => 'required|string',
            'date_of_purchase' => 'required|date',
            'plant_location' => 'required|string',
            'store_number' => 'required|numeric',
        ];
    }


    public function startEdit($merchandiseId)
    {
        $this->editMode = true;
        $this->merchandiseId = $merchandiseId;

        $merchandise = ModelsMerchandise::find($merchandiseId);

        $this->item_name = $merchandise->item_name;
        $this->supplier_name = $merchandise->supplier_name;
        $this->brand_make = $merchandise->brand_make;
        $this->qty = $merchandise->qty;
        $this->cost_per_item = $merchandise->cost_per_item;
        $this->date_of_purchase = Carbon::parse($merchandise->date_of_purchase)->format('d-m-Y');
        $this->plant_location = $merchandise->plant_location;
        $this->store_number = $merchandise->store_number;

    }

    public function cancelEdit()
    {
        $this->reset(['item_name', 'date_of_purchase', 'supplier_name', 'brand_make', 'qty', 'cost_per_item', 'plant_location', 'store_number', 'editMode', 'merchandiseId']);
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
            ModelsMerchandise::find($this->merchandiseToDelete)->delete();
            $this->showDeleteModal = false;
            $this->merchandiseToDelete = null;
            session()->flash('message', 'Merchandise deleted successfully!');
        }
    }

    public function addNewMerchandise()
    {
        $validatedData = $this->validate();



        if ($this->editMode) {


            $merchandise = ModelsMerchandise::find($this->merchandiseId);

            $merchandise->item_name = $validatedData['item_name'];
            $merchandise->supplier_name = $validatedData['supplier_name'];
            $merchandise->brand_make = $validatedData['brand_make'];
            $merchandise->qty = $validatedData['qty'];
            $merchandise->cost_per_item = $validatedData['cost_per_item'];
            $merchandise->date_of_purchase = Carbon::createFromFormat('d-m-Y', $validatedData['date_of_purchase'])->format('Y-m-d H:i:s');
            $merchandise->plant_location = $validatedData['plant_location'];
            $merchandise->store_number = $validatedData['store_number'];
            $merchandise->save();

            session()->flash('message', 'Merchandise updated successfully!');
        } else {
            ModelsMerchandise::create([
                'item_name' => $validatedData['item_name'],
                'supplier_name' => $validatedData['supplier_name'],
                'brand_make' => $validatedData['brand_make'],
                'qty' => $validatedData['qty'],
                'cost_per_item' => $validatedData['cost_per_item'],
                'date_of_purchase' => Carbon::createFromFormat('d-m-Y', $validatedData['date_of_purchase'])->format('Y-m-d H:i:s'),
                'plant_location' => $validatedData['plant_location'],
                'store_number' => $validatedData['store_number'],
            ]);
            session()->flash('message', 'Merchandise created successfully!');
        }

        $this->cancelEdit();
    }





}
