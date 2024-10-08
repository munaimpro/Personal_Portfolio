<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminMessageMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    
    public $email;
    public $subject;
    public $adminMessage;
    public $fullName;
    public $designation;
    public $logo;
    public $clientName;
    public $facebookLink;
    public $linkedinLink;
    
    public function __construct($email, $subject, $adminMessage, $fullName, $designation, $logo, $clientName, $facebookLink, $linkedinLink)
    {
        $this->email = $email;
        $this->subject = $subject;
        $this->adminMessage = $adminMessage;
        $this->fullName = $fullName;
        $this->designation = $designation;
        $this->logo = $logo;
        $this->clientName = $clientName;
        $this->facebookLink = $facebookLink;
        $this->linkedinLink = $linkedinLink;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.AdminMessageMail',
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
