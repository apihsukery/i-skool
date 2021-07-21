<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $users, $ic, $name, $email, $selected_id, $delete_id=NULL;
    public $updateMode = false;

    public function render()
    {
        $this->users = User::all();
        return view('livewire.users.list');
    }

    private function resetInput(){
        $this->ic       = '';
        $this->name     = '';
        $this->email    = '';
    }

    public function edit($id)
    {
        $record = User::findOrFail($id);
        $this->selected_id  = $id;
        $this->ic           = $record->ic;
        $this->name         = $record->name;
        $this->email        = $record->email;
        $this->updateMode   = true;
    }

    public function update()
    {
        $this->validate([
            'ic'    => 'required|digits:12',
            'name'  => 'required|string|max:255',
            'email' => 'required|string|max:255|email'
        ]);
        if ($this->selected_id) {
            $record = User::find($this->selected_id);
            $record->update([
                'ic'    => $this->ic,
                'name'  => $this->name,
                'email' => $this->email
            ]);
            $this->resetInput();
            $this->updateMode = false;
            session()->flash('message', 'Users '.$this->selected_id.' Updated Successfully.');
        }
    }

    public function deleteId($id)
    {
        $this->delete_id = $id;
    }

    public function delete($id)
    {
        User::find($this->delete_id)->delete();
        session()->flash('message', 'Users '.$this->delete_id.' Deleted Successfully.');
    }

    public function back()
    {
        $this->updateMode = false;
        $this->delete_id=NULL;
    }
}
