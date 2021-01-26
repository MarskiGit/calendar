<?php

declare(strict_types=1);

namespace App\model;

use App\database\DB;

use PDO;

abstract class AbstractModel
{
    protected PDO $DB;
    protected array $weekorder = [1, 2, 3, 4, 5, 6, 0];
    protected array $monthName = ['Styczeń', 'Luty', 'Marzec', 'Kiwecizeń', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
    protected array $dayName = ['Nie', 'Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob'];
    protected int $month;
    protected int $year;
    protected int $firstDay;
    protected int $lastDay;

    public function __construct($year, $month = 1)
    {
        $this->DB = DB::conn();
        $this->year = $year;
        $this->month = $month;
    }
}
