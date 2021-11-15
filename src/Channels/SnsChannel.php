<?php

namespace MedSchoolCoach\LumenNotifications\Channels;

use Illuminate\Notifications\Notification;
use MedSchoolCoach\LumenNotifications\Services\SnsService;

class SnsChannel
{
    /**
     * @var SnsService
     */
    protected SnsService $snsService;

    /**
     * @param SnsService $snsService
     */
    public function __construct(SnsService $snsService)
    {
        $this->snsService = $snsService;
    }

    /**
     * Send the given notification.
     *
     * @return \Aws\Result
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSns($notifiable);

        return $this->snsService->send($message);
    }
}