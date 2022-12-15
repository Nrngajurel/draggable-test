<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class DraggableLists extends Component
{
    public $users;

    public function mount(){
        $this->refreshUser();
    }

    public function refreshUser(){
        $this->users = User::orderBy('order')->get();
    }
    public function render()
    {
        return view('livewire.draggable-lists');
    }

    public function reorder($ids){
        $order = 1;
        foreach($ids as $id){
            $user = $this->users->where('id', $id)->first();
            if($user){
                $user->update([
                    'order' => $order
                ]);
                $order++;
            }
        }
        $this->refreshUser();
    }
}
