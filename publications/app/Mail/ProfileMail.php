<?php

namespace App\Mail;

use App\Models\Profile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProfileMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct( private Profile $profile)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Profile confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $date = $this->profile->created_at->format('d-m-Y');
        $id = $this->profile->id;
        $href = url("")."/verify_email/".base64_encode($date."//".$id);
        return new Content(
            // the email view
            view: 'emails.inscription',
            // the email view data
            with:[ 
            "name" => $this->profile->name,
            "email"=> $this->profile->email,
            "href" => $href
        ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            //* to send a file with the email
            // Attachment::fromPath(storage_path('app/public/profiles/user.png'))
            //     ->as('user.png')
            //     ->withMime('image/png'),
        ];
    }
}
