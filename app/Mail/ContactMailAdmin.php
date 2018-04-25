<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMailAdmin extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct()
    {
    }

    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->subject('Confirmación de formulario, '.config('app.name'))
            ->view('mails.datoscontacto');
    }
}
