<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostulacionConViaje extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('postulacion.mails.emailPostulacionConViaje')
            ->from('asignaciondirecta@sernatur.cl','Asignacion Directa')
            ->subject('Postulación Con Viaje');

        // return $this->view('postulacion.mails.emailPostulacionConViaje');
    }
}
