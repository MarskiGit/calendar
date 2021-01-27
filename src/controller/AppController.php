<?php

declare(strict_types=1);

namespace App\controller;


class AppController extends AbstractController
{
    protected function homeApp(): void
    {
        $this->View->home();
    }
}
