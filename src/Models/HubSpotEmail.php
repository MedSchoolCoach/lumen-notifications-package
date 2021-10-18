<?php

namespace MedSchoolCoach\LumenNotifications\Models;

class HubSpotEmail extends Email
{
    /**
     * @var array|null
     */
    public ?array $contactProperties = null;

    /**
     * @var array|null
     */
    public ?array $customProperties = null;

    /**
     * @inheritdoc
     */
    public function getData(): array
    {
        return [
            'message' => parent::getData(),
            'contactProperties' => $this->contactProperties,
            'customProperties' => $this->customProperties
        ];
    }
}