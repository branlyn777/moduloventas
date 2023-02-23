<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;

class NotificationInventoryController extends Component
{
    use WithPagination;
    public $selected_type;
    public $pagination,$dataitem;

    public function mount(){
        $this->pagination=5;
        $this->selected_type='no_leidos';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        switch ($this->selected_type) {
            case 'leidos':
                $data =auth()->user()->notifications()->where('read_at','!=',null);
                break;
            case 'no_leidos':
                $data =auth()->user()->notifications()->where('read_at',null);
                // $data =auth()->user()->unreadNotifications;
                break;
            
            default:
                $data =auth()->user()->notifications();
                break;
        }
 



        return view('livewire.notificationinventory.notificationinventory', [
            'data' => $data->paginate($this->pagination)
        ])
        ->extends('layouts.theme.app')
        ->section('content');

    }

    public function mostrarNotificacion($id){
        $notification = auth()->user()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }

        $this->dataitem=$notification->data;
      

        $this->emit('verNotificacion');

    }
}
