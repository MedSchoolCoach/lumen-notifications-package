<?php

namespace MedSchoolCoach\LumenNotifications\Notifications;

use Illuminate\Notifications\Notification;
use MedSchoolCoach\LumenNotifications\Channels\SnsChannel;

class SnsNotificationBase extends Notification
{
  /**
     * @var string
     */
    public string $subject;

    /**
     * @var string
     */
    public string $topic;

    /**
     * @param string $subject
     * @param [type] $topic
     */
    public function __construct(string $subject = null, string $topic = null)
    {
        if ($subject) {
            $this->subject = $subject;
        }
        $this->topic = $topic ?? config('sns.topic');
    }

    public function via($notifiable)
    {
        return [SnsChannel::class];
    }

    public function toSns($notifiable)
    {
        $message = [
            'TopicArn' => $this->topic,
            'Message' => serialize($notifiable)
        ];

        if (isset($this->subject)) {
            $message['Subject'] = $this->subject;
        }

        return $message;
    }
}