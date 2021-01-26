<main>
    <?php
    date_default_timezone_set('Europe/Warsaw');
    function last_day($month, $year)
    {
        return mktime(23, 59, 59, $month + 1, 0, $year);
    }


    function print_calendar($month, $year,)
    {
        $monthName = ['Styczeń', 'Luty', 'Marzec', 'Kiwecizeń', 'Maj', 'Czerwiec', 'Lipiec', 'Sierpień', 'Wrzesień', 'Październik', 'Listopad', 'Grudzień'];
        $dayName = ['Pon', 'Wto', 'Śro', 'Czw', 'Pią', 'Sob', 'Nie'];
        $last = idate('d', last_day($month, $year));
        $firstdaystamp = mktime(0, 0, 0, $month, 1, $year);
        $firstwday = idate('w', $firstdaystamp);
        $name = date('n', $firstdaystamp);

        $weekorder = [1, 2, 3, 4, 5, 6, 0];

        echo "<table><tr><th colspan=\"7\">" . $monthName[$name - 1] . " {$year}</th></tr>\n";
        echo '<tr>';
        for ($w = 1; $w < 8; $w++) {
            $dayname = date('w', mktime(0, 0, 0, $month, 0 - $firstwday + $w, $year));
            echo "<th>" . $dayName[$dayname] . "</th>";
        }
        echo "</tr>\n";
        $onday = 0;
        $started = true;

        while ($onday <= $last) {
            echo '<tr>';
            foreach ($weekorder as $d) {
                if ($started) {
                    if ($d === $firstwday) {
                        $started = false;
                        $onday++;
                    }
                }
                if ($onday === 0 || $onday > $last) {
                    echo '<td>&nbsp;</td>';
                } else {
                    echo "<td>{$onday}</td>";
                    $onday++;
                }
            }
            echo "</tr>\n";
        }
        echo '</table>';
    }
    echo '<style>table, td, th { border: 1px solid black; }</style>';

    echo '<br />';
    foreach (range(1, 12) as $m) {
        print_calendar($m, 2021);
        echo '<br />';
    }
    ?>
</main>