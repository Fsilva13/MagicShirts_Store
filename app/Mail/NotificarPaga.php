<?php

namespace App\Mail;

use App\Encomenda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificarPaga extends Mailable
{
    use Queueable, SerializesModels;

    protected $encomenda;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Encomenda $encomenda)
    {
        $this->encomenda = $encomenda;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('MagicShirts@mail.com')
        ->view('emails.paga')->withEncomenda($this->encomenda);
    }
}
