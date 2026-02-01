<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class ReceiveTicketNotif extends Mailable
{
    use Queueable, SerializesModels;
           public $ticket;
           public $ticket_request;
           

    /**
     * Create a new message instance.
     *
     * @return void
     */
  public function __construct($ticket, $ticket_request)
    {
        //
        $this->ticket = $ticket;
        $this->ticket_request = $ticket_request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Acknowledgment of Ticket Request')
                    ->view('emails.tickets_received');
    }
}
