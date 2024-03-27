<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnviarCorreo extends Mailable
{
    use Queueable, SerializesModels;

    public $datos;
    public $sub;
    public $factura;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($datos, $factura)
    {
        $this->datos = $datos;
        $this->factura = $factura;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        
        if ($this->factura == "") {
            return $this->view('enviar')->subject($this->sub);
        } else{
            $products = Product::whereIn('id', $this->datos['products'])->get();
            return $this->view('enviarFactura', compact(['products']))->subject($this->sub);
        }
       
    }
}
