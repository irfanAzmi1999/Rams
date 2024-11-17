<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotiLaporanAwalan extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The data for the email.
     *
     * @var array
     */
    protected array $data;

    /**
     * Create a new message instance.
     *
     * @param array $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): self
    {
        return $this->subject('RAMS :: Senarai Laporan Awalan Perlu Tindakan')
            ->from('do_not_reply@mantasoft.com.my', 'RAMS')
            ->markdown('emails.notiLaporanAwalan')
            ->with($this->data);
    }
}
