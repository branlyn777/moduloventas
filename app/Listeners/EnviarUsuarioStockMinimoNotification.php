<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Notifications\StockNotification;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Notification;

class EnviarUsuarioStockMinimoNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($product)
    {
        dd($product);
        $admin = User::where('role', 1)->first();
        // $users = User::role('Ad')->get();
        Notification::send($admin, new StockNotification($product));
    }
}
