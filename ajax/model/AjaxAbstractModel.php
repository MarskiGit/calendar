<?php

declare(strict_types=1);


namespace Ajax\model;

use Ajax\database\DB;

use PDO;

abstract class AjaxAbstractModel
{
    protected ?PDO $DB;
    protected array $requestParam;
    protected int $month;
    protected int $year;
    public function __construct(array $requestParam)
    {
        $this->DB = DB::conn();
        $this->requestParam = $requestParam;
        $this->month = intval($this->requestParam['month']);
        $this->year = intval($this->requestParam['year']);
    }
    protected function notification($message): array
    {
        return [$message];
    }
}
