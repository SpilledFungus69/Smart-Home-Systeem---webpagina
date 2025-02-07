<?php
class Calendar
{
    //Hier sla je het jaar dag maand en evenementen op.
    private $active_year, $active_month, $active_day;
    private $events = [];

    public function __construct($date = null)
    {
        //Wanneer de datum word gevonden zet hij het juiste huidige datum in het systeem
        $this->active_year = $date != null ? date('Y', strtotime($date)) : date('Y');
        $this->active_month = $date != null ? date('m', strtotime($date)) : date('m');
        $this->active_day = $date != null ? date('d', strtotime($date)) : date('d');
    }

    //events toevoegen functie.
    public function add_event($txt, $date, $days = 1, $color = '')
    {
        $color = $color ? ' ' . $color : $color;
        $this->events[] = [$txt, $date, $days, $color];
    }

    public function __toString()
    {
        $num_days = date('t', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year));
        //Hier worden de laatste paar dagen van de vorige maand er in gevoegd, net zoals in elke andere calender.
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($this->active_day . '-' . $this->active_month . '-' . $this->active_year)));
        $days = [0 => 'Maandag', 1 => 'Dinsdag', 2 => 'Woensdag', 3 => 'Donderdag', 4 => 'Vrijdag', 5 => 'Zaterdag', 6 => 'Zondag'];
        //De eerste weekdag van de maand vinden, zodat hij op de juiste dag begint, dit kan bijv. een woensdag zijn aangezien de maanden niet altijd op maandag beginnen.
        $first_day_of_week = array_search(date('D', strtotime($this->active_year . '-' . $this->active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= date('F Y', strtotime($this->active_year . '-' . $this->active_month . '-' . $this->active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        // Door alle dagen heen lopen (maandag tot zondag).
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        // de eerste dagen van de vorige maand bijvullen als het niet op een maandag begint
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month - $i + 1) . '
                </div>
            ';
        }
        //Kijken of vandaag de geselecteerde dag is en die highlighten. 
        for ($i = 2; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $this->active_day) {
                $selected = ' selected';
            }
            $html .= '<div class="day_num' . $selected . '">';
            $html .= '<span>' . $i . '</span>';

            //door alle events lopen en ze bij de juiste dag erbij zetten.
            foreach ($this->events as $event) {
                for ($d = 0; $d <= ($event[2] - 1); $d++) {
                    if (date('y-m-d', strtotime($this->active_year . '-' . $this->active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $html .= '<div class="event' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                    }
                }
            }
            $html .= '</div>';
        }
        //De laatste dagen bijvullen, dus stel de maand eindigt op een donderdag laat hij nog vrijdag, zaterdag en zondag zien.
        for ($i = 1; $i <= (42 - $num_days - max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
}
