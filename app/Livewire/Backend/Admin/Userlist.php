<?php

namespace App\Livewire\Backend\Admin;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
class Userlist extends Component
{
    public function render()
    {
        return view('livewire.backend.admin.userlist',[
            'users' =>User::latest()->paginate(10)
        ]);
    }
}
