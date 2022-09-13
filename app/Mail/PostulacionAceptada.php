<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PostulacionAceptada extends Mailable
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
        return $this->markdown('postulacion.mails.emailAcepta')
            ->from('asignaciondirecta@sernatur.cl','Asignacion Directa')
            ->subject('Postulación Aceptada');

        // return $this->view('postulacion.mails.emailAcepta');
    }
}
