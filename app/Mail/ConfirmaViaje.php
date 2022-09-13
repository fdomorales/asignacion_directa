<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ConfirmaViaje extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $viaje;
    public function __construct($viaje)
    {
        $this->viaje = $viaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('postulacion.mails.emailConfirmacionViaje')
            ->with('viaje', $this->viaje)
            ->from('asignaciondirecta@sernatur.cl','Asignacion Directa')
            ->subject('Confirmación de Viaje');

        // return $this->view('postulacion.mails.emailConfirmacionViaje')->with(['viaje'=> $this->viaje]);
    }
}
