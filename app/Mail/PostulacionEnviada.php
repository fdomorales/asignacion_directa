<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostulacionEnviada extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = "Postulación correcta";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $correo;
    public function __construct($correo)
    {
        $this->correo = $correo->postulacion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('postulacion.email')->with(['idpostulacion'=> $this->correo]);
    }
}
