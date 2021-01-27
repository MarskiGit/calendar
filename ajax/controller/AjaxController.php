<?php

declare(strict_types=1);

namespace Ajax\controller;

use Ajax\view\AjaxView;
use Ajax\view\PhpInput;
use Ajax\model\CalendarModel;


class AjaxController
{
    private const DEFAULT_ACTION_AJAX = 'ideaList';
    private PhpInput $PhpInput;
    private AjaxView $AjaxView;
    private array $requestParam;


    public function __construct(PhpInput $PhpInput, AjaxView $AjaxView)
    {
        $this->PhpInput = $PhpInput;
        $this->AjaxView = $AjaxView;


        $this->run();
    }
    private function run(): void
    {
        if ($this->PhpInput->hasPhpInput()) {
            $this->requestParam = $this->PhpInput->getParam_PhpInput();
            $this->runMetod();
        }
    }
    private function runMetod(): void
    {
        $action = $this->requestParam['action'] . 'Ajax';
        if (!method_exists($this, $action)) {
            $action = self::DEFAULT_ACTION_AJAX . 'Ajax';
        } else {
            $this->$action();
        }
    }
    private function oneMonthAjax()
    {
        $calendar = new CalendarModel($this->requestParam);
        $this->AjaxView->renderJSON($calendar->oneMonth());
    }
    private function fullYearAjax()
    {
        $calendar = new CalendarModel($this->requestParam);
        $this->AjaxView->renderJSON($calendar->fullYear());
    }
}
