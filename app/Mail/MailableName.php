<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;


class MailableName extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        //
        
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address("bravausuquoja-6164@yopmail.com","bravausuquoja-6164"),
            subject: 'Mailable Name',
            // replyTo: [new Address('dagifroffoize-4484@yopmail.com', 'John Doe2')]
        );
    }

    // public function build(){
    //     return $this->from('bravausuquoja-6164@yopmail.com', 'John Doe1')
    //     ->to('dagifroffoize-4484@yopmail.com', 'John Doe2')
    //     ->with(['name' => 'from mailableName']);
    // }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail',
            with:['name' => 'from mailableName']
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
