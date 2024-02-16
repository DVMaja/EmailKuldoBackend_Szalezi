<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use function PHPSTORM_META\map;

class StudentEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public $mailData;
    public function __construct($mailData)
    {
        $this->mailData = $mailData;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jövedelem igazolás',
            
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.students',
            //with: ['name' => $this.name]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $mappaPath = $this->mailData['path'];
        $pdfName = $this->mailData['pdf_name']; //'valami';//
        //print('storage/' . $mappaPath . '/' . $pdfName);
        //print($pdfName);
        //echo asset('storage/kuldendoFajlok/Jövedelemkifizetési lap - Diák Második (00525) 20231108_0829030.pdf');

        return [
            Attachment::fromPath($mappaPath . '/' . $pdfName)
                ->withMime('application/pdf'),
        ];
    }
}
