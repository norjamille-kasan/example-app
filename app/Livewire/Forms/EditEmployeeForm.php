<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Storage;
use Livewire\Form;

class EditEmployeeForm extends Form
{

    public $employee = null;
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $avatar = '';
    public $position = '';
    public $phone = '';

    public $oldAvatarPreview = '';

    protected function rules()
    {
        return [
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required','email'],
            'avatar'=>['nullable','image','max:2048'],
            'phone'=>['required'],
            'position'=>['required'],
        ];
    }

    public function fillForm()
    {
        $this->first_name = $this->employee->first_name;
        $this->last_name = $this->employee->last_name;
        $this->email = $this->employee->email;
        $this->position = $this->employee->position;
        $this->phone = $this->employee->phone;
        $this->oldAvatarPreview = $this->employee->avatar;
    }

    public function save()
    {
        $this->validate();

        if ($this->avatar) {
            if ($this->employee->avatar) {
                Storage::delete($this->employee->avatar);
            }
            $this->employee->avatar =  $this->avatar->store('avatars');
        }

        $this->employee->first_name = $this->first_name;
        $this->employee->last_name = $this->last_name;
        $this->employee->email = $this->email;
        $this->employee->position = $this->position;
        $this->employee->phone = $this->phone;

        $this->employee->save();
    }
}
