<?php

namespace MedSchoolCoach\LumenNotifications\Models;

use Illuminate\Notifications\Notifiable;

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
