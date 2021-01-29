<?php

declare(strict_types=1);


namespace Ajax\model;

use Ajax\model\AjaxAbstractModel;

class CalendarModel extends AjaxAbstractModel
{
    protected array $dayNameMarker  = [1, 2, 3, 4, 5, 6, 0];
    protected array $monthName = ['Styczeń', 'Luty', 'Marzec', 'Kwiecień', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
    protected int $firstDayMonth;
    protected int $lastDayMonth;
    protected array $month = [];

    public function oneMonth(): array
    {
        $this->renderMonth();
        return $this->get();
    }
    public function fullYear(): array
    {
        foreach (range(1, 12) as $m) {
            $this->monthRequest  = $m;
            $this->renderMonth();
        }
        return $this->get();
    }
    private function firstDayMonth(): int
    {
        return idate('w', mktime(0, 0, 0, $this->monthRequest, 1, $this->yearRequest));
    }
    private function lastDayMonth(): int
    {
        return idate('d', mktime(23, 59, 59, $this->monthRequest  + 1, 0, $this->yearRequest));
    }
    private function getMonthName(): string
    {
        return $this->monthName[$this->monthRequest  - 1];
    }
    private function get(): array
    {
        $render = [
            'year' => $this->yearRequest,
            'time_zone' => date_default_timezone_get(),
            'day_name' => ['Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob', 'Nie'],
            'params_month' => $this->month
        ];
        return  $render;
    }
    private function renderMonth(): void
    {

        $this->firstDayMonth = $this->firstDayMonth();
        $this->lastDayMonth = $this->lastDayMonth();

        $paramsMonth = ['month' => $this->getMonthName()];

        $onday = 0;
        $started = true;

        while ($onday <= $this->lastDayMonth) {
            foreach ($this->dayNameMarker  as $d) {
                if ($started && $d === $this->firstDayMonth) {
                    $started = false;
                    $onday++;
                }
                if ($onday === 0 || $onday > $this->lastDayMonth) {
                    $paramsMonth['day_number'][] = 0;
                } else {
                    $paramsMonth['day_number'][] = $onday;
                    $onday++;
                }
            }
        }
        $this->month[] = $paramsMonth;
    }
}
