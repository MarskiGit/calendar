<?php

declare(strict_types=1);

namespace App\controller;

use App\model\CalendarModel;

class AppController extends AbstractController
{
    protected function homeApp(): void
    {
        $calender = new CalendarModel(2021, 1);
        $this->View->home($calender);
    }
}
