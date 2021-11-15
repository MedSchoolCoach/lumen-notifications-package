<?php

namespace MedSchoolCoach\LumenNotifications\Services;

use Aws\Sns\Message;
use Aws\Sns\SnsClient;

class SnsService
{
    /**
     * @var SnsClient
     */
    protected SnsClient $snsClient;

    /**
     * @param SnsClient $snsClient
     */
    public function __construct(SnsClient $snsClient)
    {
        $this->snsClient = $snsClient;
    }

    /**
     * @param array $message
     * @return \Aws\Result
     */
    public function send(array $message): \Aws\Result
    {
        return $this->snsClient->publish($message);
    }

    /**
     * @return Message
     */
    public function retireve(): Message
    {
        return Message::fromRawPostData();
    }

    /**
     * @return boolean
     */
    public function isSubscriptionConfirmation(Message $message): bool
    {
        return $message['Type'] === 'SubscriptionConfirmation';
    }

    /**
     * @param Message $message
     * @return void
     */
    public function confirmSubscription(Message $message)
    {
        $confirmationUrl = curl_init($message['SubscribeURL']);
        curl_exec($confirmationUrl);
    }

    /**
     * @param Message $message
     * @return mixed
     */
    public function getMessageContent(Message $message)
    {
        return unserialize($message['Message']);
    }
}
