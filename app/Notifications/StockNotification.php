<?php

namespace App\Notifications;

use App\Models\Destino;
use App\Models\Product;
use App\Models\ProductosDestino;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StockNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $product;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($productosdest)
    {
        $this->product =ProductosDestino::find($productosdest);
   
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $producto=Product::find($this->product->product_id);
        $destino=Destino::find($this->product->destino_id)->nombre;
   
        return [
            'nombre' =>$producto->nombre,
            'codigo'=>$producto->codigo,
            'almacen'=>$destino
          
        ];   
    }
}
