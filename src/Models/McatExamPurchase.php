<?php

namespace MedSchoolCoach\LumenNotifications\Models;

class McatExamPurchase
{
    use Notifiable;

    /**
     * @var string
     */
    public string $examId;

    /**
     * @var string
     */
    public string $studentFirstName;

    /**
     * @var string
     */
    public string $studentLastName;

    /**
     * @var string
     */
    public string $studentEmail;
}
