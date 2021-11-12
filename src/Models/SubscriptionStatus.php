<?php

namespace MedSchoolCoach\LumenNotifications\Models;

use Illuminate\Notifications\Notifiable;

class SubscriptionStatus
{
    use Notifiable;

    /**
     * @var string
     */
    public string $userId;

    /**
     * @var string
     */
    public string $subscriptionId;

    /**
     * @var string
     */
    public string $planId;

    /**
     * @var string
     */
    public string $status;

    /**
     * @param string $userId
     * @param string $subscriptionId
     * @param string $status
     */
    public function __construct(string $userId, string $subscriptionId, string $planId, string $status)
    {
        $this->userId = $userId;
        $this->subscriptionId = $subscriptionId;
        $this->planId = $planId;
        $this->status = $status;
    }
}