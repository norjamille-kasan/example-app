<?php

namespace App\Livewire\Forms;

use App\Models\Employee;
use Livewire\Form;

class CreateEmployeeForm extends Form
{
    public $first_name = '';
    public $last_name = '';
    public $email = '';
    public $avatar = '';
    public $position = '';
    public $phone = '';

    protected function rules()
    {
        return [
            'first_name'=>['required'],
            'last_name'=>['required'],
            'email'=>['required','email'],
            'avatar'=>['required','image','max:2048'],
            'phone'=>['required'],
            'position'=>['required'],
        ];
    }

    public function save()
    {
        $this->validate();
        $avatarPath =  $this->avatar->store('avatars');

        Employee::create([
            'first_name'=>$this->first_name,
            'last_name'=> $this->last_name,
            'email'=>$this->email,
            'position'=> $this->position,
            'avatar'=> $avatarPath,
            'phone'=> $this->phone,
        ]);
    }
}
