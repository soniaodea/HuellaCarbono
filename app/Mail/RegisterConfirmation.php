<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class RegisterConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $confirmLink;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->email = $user->email;
        $this->confirmLink = $user->email_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->from(config('mail.from.address'))
                ->subject('Confirmación de registro, '.config('app.name'))
                ->view('mails.confirmRegistration');
        /*
        return $this->from('karbonoaztarna@gmail.com')
            ->subject('Confirmación de registro, ')
            ->view('Hau proba bat da');
        */
    }
}
