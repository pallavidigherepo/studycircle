<?php

namespace App\Mail;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
    * The data instance.
    *
    * @var \App\Models\ContactU
    */
   public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contact $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->data['email'], $this->data['name'])
                    ->replyTo($this->data['email'], $this->data['name'])
                    ->with([
                        'message' => $this->data['message'],
                        'subject' => $this->data['subject'],
                        'data' => $this->data,
                    ])
                    ->view('emails.contactus.send');
    }
}
