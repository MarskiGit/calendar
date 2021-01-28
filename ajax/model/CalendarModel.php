<?php

declare(strict_types=1);

namespace Ajax\model;

use Ajax\model\AjaxAbstractModel;

class CalendarModel extends AjaxAbstractModel
{
    protected array $weekorder = [1, 2, 3, 4, 5, 6, 0];
    protected array $monthName = ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
    protected int $firstDayMonth;
    protected int $lastDayMonth;
    protected array $renderMonth = [];

    public function oneMonth(): array
    {
        $this->calendar();
        return $this->render();
    }
    public function fullYear(): array
    {
        foreach (range(1, 12) as $m) {
            $this->month = $m;
            $this->calendar();
        }
        return $this->render();
    }
    private function firstDayMonth(): void
    {
        $this->firstDayMonth = idate('w', mktime(0, 0, 0, $this->month, 1, $this->year));
    }
    private function lastDayMonth(): void
    {
        $this->lastDayMonth = idate('d', mktime(23, 59, 59, $this->month + 1, 0, $this->year));
    }
    private function render(): array
    {
        $render[] = [
            'year' => $this->year,
            'day_name' => ['Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob', 'Nie'],
            'params_month' => $this->renderMonth
        ];
        return  $render;
    }
    private function calendar(): void
    {
        $onday = 0;
        $started = true;
        $this->firstDayMonth();
        $this->lastDayMonth();

        $paramsMonth = [
            'month' => $this->monthName[$this->month - 1],
            'day_number' => []
        ];

        while ($onday <= $this->lastDayMonth) {
            foreach ($this->weekorder as $d) {
                if ($started && $d === $this->firstDayMonth) {
                    $started = false;
                    $onday++;
                }
                if ($onday === 0 || $onday > $this->lastDayMonth) {
                    array_push($paramsMonth['day_number'], 0);
                } else {
                    array_push($paramsMonth['day_number'], $onday);
                    $onday++;
                }
            }
        }
        $this->renderMonth[] = $paramsMonth;
    }
}
