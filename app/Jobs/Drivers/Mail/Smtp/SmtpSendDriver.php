<?php

namespace Modules\Notifier\Jobs\Drivers\Mail\Smtp;

use Illuminate\Support\Facades\Mail;
use Modules\Notifier\Contracts\BaseDriver;
use Modules\Notifier\Emails\Smtp\SmtpSendMail;
use Modules\Notifier\Enums\EnumNotificationStatus;
use Modules\Notifier\Models\Notifier;
use Modules\Notifier\Models\Provider;

class SmtpSendDriver extends BaseDriver
{
    public function __construct(
        protected Provider $provider,
        protected Notifier $notifier,
        private readonly array $to,
        private readonly string $subject,
        private readonly string $html
    ) {
        parent::__construct($provider, $notifier);
    }

    public function handle(): void
    {
        try {
            Mail::send(new SmtpSendMail($this->to, $this->subject, $this->html, $this->provider->config()));

            $this->updateNotifier(EnumNotificationStatus::SUCCESS);
        } catch (\Throwable $e) {
            $this->updateNotifier(
                EnumNotificationStatus::FAILED, ['exception' => [
                    'message' => method_exists($e, 'errorMessage') ? $e->errorMessage() : $e->getMessage(),
                    'trace' => array_map(fn ($item) => array_intersect_key($item, array_flip([
                        'file', 'line', 'function', 'class',
                    ])), $e->getTrace()),
                ]],
            );
            $this->fail($e);
        }
    }
}
