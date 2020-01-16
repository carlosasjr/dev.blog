<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContact extends Mailable
{
    use Queueable, SerializesModels;

    public $dataForm;

    /**
     * SendContact constructor.
     * @param $dataForm
     */
    public function __construct($dataForm)
    {
        $this->dataForm = $dataForm;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->dataForm['subject'])
                    ->to('contato@carlosasjr.com.br')
                    ->view('mails.contact.contact');
    }
}
