<?php

declare(strict_types=1);


namespace App\model;

use App\model\AbstractModel;
use App\exception\AppException;
use PDO;
use PDOException;

class CalendarModel extends AbstractModel
{
    public function oneMonth()
    {
        $this->renderCalendar();
    }
    public function fullYear()
    {
        foreach (range(1, 12) as $m) {
            $this->month = $m;
            $this->renderCalendar();
        }
    }
    private function renderCalendar()
    {
        $this->firstDay();
        $this->lastDay();

        echo "<table><tr><th colspan=\"7\">" . $this->monthName[$this->month - 1] . " {$this->year}</th></tr>";
        echo '<tr>';

        foreach ($this->weekorder as $w) {
            $dayname = date('w', mktime(0, 0, 0, $this->month, 1 - $this->firstDay + $w, $this->year));
            echo "<th>" . $this->dayName[$dayname] . "</th>";
        }
        echo "</tr>";
        $onday = 0;
        $started = true;

        while ($onday <= $this->lastDay) {
            echo '<tr>';
            foreach ($this->weekorder as $d) {
                if ($started) {
                    if ($d === $this->firstDay) {
                        $started = false;
                        $onday++;
                    }
                }
                if ($onday === 0 || $onday > $this->lastDay) {
                    echo '<td>&nbsp;</td>';
                } else {
                    echo "<td>{$onday}</td>";
                    $onday++;
                }
            }
            echo "</tr>";
        }
        echo '</table>';
    }
    private function lastDay()
    {
        $this->lastDay = idate('d', mktime(23, 59, 59, $this->month + 1, 0, $this->year));
    }
    private function firstDay()
    {
        $this->firstDay = idate('w', mktime(0, 0, 0, $this->month, 1, $this->year));
    }
}
