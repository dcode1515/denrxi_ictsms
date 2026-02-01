<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpdateTicketNotif extends Mailable
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
        return $this->subject('Ticket Request Updated')
                    ->view('emails.tickets_updated');
    }
}
