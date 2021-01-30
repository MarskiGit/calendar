<?php

declare(strict_types=1);


namespace Ajax\model;


abstract class AjaxAbstractModel
{

    protected array $requestParam;
    protected int $monthRequest;
    protected int $yearRequest;
    public function __construct(array $requestParam)
    {

        $this->requestParam = $requestParam;
        $this->monthRequest  = intval($this->requestParam['month']);
        $this->yearRequest  = intval($this->requestParam['year']);
    }
    protected function notification($message): array
    {
        return [$message];
    }
}
