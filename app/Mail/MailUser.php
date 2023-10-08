<?php

namespace App\Mail;

use App\Models\Email;
use App\Models\Setting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class MailUser extends Mailable
{
    use Queueable, SerializesModels;


    private $data;

    /**
     * Create a new message instance.
     */
    public function __construct(protected Email $contents, $data)
    {
        $this->data = $data;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $settings = Setting::where('id', 1)->first();
        return new Envelope(
            from: new Address($settings->emailnoreply, $settings->appname),
            replyTo: [
                new Address($settings->appemail, $settings->appname),
            ],
            subject: $this->contents->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $content = $this->contents;
        $settings = Setting::where('id', 1)->first();

        $placeholders = ['{name}', '{sitename}'];

        if (isset($this->data['amount'])) {
            $placeholders[] = '{amount}';
        }

        if (isset($this->data['crypto'])) {
            $placeholders[] = '{crypto}';
        }
        if (isset($this->data['nftname'])) {
            $placeholders[] = '{nftname}';
        }
        if (isset($this->data['nftprice'])) {
            $placeholders[] = '{nftprice}';
        }
        if (isset($this->data['name2'])) {
            $placeholders[] = '{name2}';
        }

        return new Content(
            markdown: 'email.reg',
            with: [
                'content' => str_replace(
                    $placeholders,
                    [
                        $this->data['name'],
                        $settings->appname,
                        $this->data['amount'] ?? '',
                        $this->data['crypto'] ?? '',
                        $this->data['nftname'] ?? '',
                        $this->data['nftprice'] ?? '',
                        $this->data['name2'] ?? '',
                    ],
                    $content->content,),
            ]
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
