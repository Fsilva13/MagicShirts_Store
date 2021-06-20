<?php

namespace App\Mail;

use App\Encomenda;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class NotificarFechada extends Mailable
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
        ->attach(storage_path('/app/pdf_recibos/'.$this->encomenda->recibo_url))
        ->view('emails.fechada')->withEncomenda($this->encomenda);
    }
}
