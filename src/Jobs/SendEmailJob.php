<?php

namespace MedSchoolCoach\LumenNotifications\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use MedSchoolCoach\LumenNotifier\Models\Email;

class SendEmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Email
     */
    public Email $email;

    /**
     * SendEmailNotification constructor.
     * @param Email $email
     */
    public function __construct(Email $email)
    {
        $this->email = $email;

        $this->onConnection('sqs');
        $this->onQueue('test-queue');
    }

    /**
     * @param Mailer $mailer
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send($this->email->view, $this->email->getData());
    }
}