<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateEmployeeForm;
use App\Livewire\Forms\EditEmployeeForm;
use Livewire\Component;
use Livewire\{WithFileUploads,WithPagination};
use App\Models\Employee as EmployeeModel;
use WireUi\Traits\WireUiActions;
class Employee extends Component
{
    use WithFileUploads;
    use WithPagination;
    use WireUiActions;

    public $search = '';
    public $showCreateModal = false;
    public $showEditModal = false;
    public CreateEmployeeForm $createEmployeeForm;
    public EditEmployeeForm $editEmployeeForm;


    public function create()
    {
        $this->createEmployeeForm->save();
        $this->showCreateModal = false;
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Employee Created',
            'description' => 'The employee has been created successfully',
        ]);
    }

    public function edit(EmployeeModel $employee)
    {
        $this->editEmployeeForm->employee = $employee;
        $this->editEmployeeForm->fillForm();
        $this->showEditModal = true;
    }

    public function update()
    {
        $this->editEmployeeForm->save();
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Employee Updated',
            'description' => 'The employee has been updated successfully',
        ]);
        $this->showEditModal = false;
    }

    public function confirmDestroy($id)
    {
        $this->dialog()->confirm([
            'title' => 'Are you Sure?',
            'description' => 'Once deleted, all of its resources and data will be permanently deleted.',
            'icon' =>  'warning',
            'acceptLabel' => 'Delete Employee',
            'method' => 'destroy',
            'params' => [$id],
        ]);
    }

    public function destroy(EmployeeModel $employee)
    {
        $employee->delete();
        $this->notification()->send([
            'icon' => 'success',
            'title' => 'Employee Deleted',
            'description' => 'The employee has been deleted successfully',
        ]);
    }

    public function render()
    {
        return view('livewire.employee',[
            'employees' => EmployeeModel::query()
                ->when($this->search, function ($query) {
                    $query->where('first_name', 'like', "%{$this->search}%")
                        ->orWhere('last_name', 'like', "%{$this->search}%")
                        ->orWhere('email', 'like', "%{$this->search}%");
                })
            ->paginate(5)
        ]);
    }
}
