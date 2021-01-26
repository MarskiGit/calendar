<?php

declare(strict_types=1);

namespace App\controller;

use App\view\Request;
use App\view\View;

abstract class AbstractController
{
    protected const DEFAULT_ACTION_HTML = 'home';
    protected Request $Request;
    protected View $View;
    protected  $SessionParam;
    protected string $action;

    public function __construct(Request $Request, View $View)
    {

        $this->Request = $Request;
        $this->View = $View;
        $this->SessionParam = $this->Request->getParam_SESSION();
        $this->action = $this->Request->getParam_GET('action', self::DEFAULT_ACTION_HTML) . 'App';
        $this->runPage();
    }
    private function runPage(): void
    {
        if ($this->Request->is_Get()) {
            $action = $this->action;
            if (!method_exists($this, $this->action)) {
                $action = self::DEFAULT_ACTION_HTML . 'App';
            }
        }
        $this->View->layout($this->params());
        $this->$action();
        $this->View->footer();
    }
    protected function params(): array
    {
        return [
            'action' => $this->action,
            'session' => $this->SessionParam
        ];
    }
}
