<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ContactoUsuario;

class ReplyContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mail;
    public $subject;
    public $reply;

    /**
     * Create a new message instance.
     */
    public function __construct(ContactoUsuario $mail, $reply)
    {
        $this->mail = $mail;
        $this->reply = $reply;

        $this->subject = ((substr(strtoupper($this->mail->subject), 0, 3)) ? 'RE: ' : '').$this->mail->subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(config('mail.from.address'))
            ->bcc(config('mail.adminAddress'))
            ->subject($this->subject)
            ->view('mails.replyMail');
    }
}
