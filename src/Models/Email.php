<?php

namespace MedSchoolCoach\LumenNotifications\Models;

class Email
{
    /**
     * @var string
     */
    public string $view;

    /**
     * @var string
     */
    public string $to;

    /**
     * @var string
     */
    public string $from;

    /**
     * @var array|null
     */
    public ?array $cc = null;

    /**
     * @var array|null
     */
    public ?array $bcc = null;

    /**
     * @return array
     */
    public function getData(): array
    {
        return [
            'to' => $this->to,
            'from' => $this->from,
            'cc' => $this->cc,
            'bcc' => $this->bcc
        ];
    }
}