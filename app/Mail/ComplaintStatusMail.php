<?php

namespace App\Mail;

use App\Models\User;
use App\Models\Complaint;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\URL;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComplaintStatusMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user, $complaint;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, Complaint $complaint)
    {
        $this->user = $user;
        $this->complaint = $complaint;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Өргөдөл, гомдлын шийдвэрлэлт',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.complaint-status',
            with: [
                'user' => $this->user,
                'complaint' => $this->complaint,
                'complaint_url' => URL::route('showComplaint', $this->complaint->id)
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
