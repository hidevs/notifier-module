<?php

namespace Modules\Notifier\Emails\Smtp;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

class SmtpSendMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public $to, string $subject, string $html, private readonly array $mailerConfig)
    {
        config()->set('mail.mailers.smtp', Arr::except($this->mailerConfig, 'from'));
        config()->set('mail.from', Arr::get($this->mailerConfig, 'from'));
        $this->to = [$to];

        $this->subject($subject)->html($html);
    }

    public function build(): static
    {
        config()->set('mail.mailers.smtp', Arr::except($this->mailerConfig, 'from'));
        config()->set('mail.from', Arr::get($this->mailerConfig, 'from'));

        return $this;
    }
}
