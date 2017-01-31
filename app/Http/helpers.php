<?php

if (! function_exists('fooFormatText')) {
    /**
     * Format partial date (day, month, year) to well formated Y-m-d.
     * day : 2, month: 4, year:1995 will be --> 1995-05-02
     *
     * @param  string  $day, $month, $year
     * @return string
     */
    function frmtPartDate($day, $month, $year)
    {
        if ($day <10) {
            $birthdate_day = '0'.$day;
        }else{
            $birthdate_day = $day;
        }

        if ($month <10) {
            $birthdate_month = '0'.$month;
        }else{
            $birthdate_month = $month;
        }

        return $birthdate = $year.'-'.$birthdate_month.'-'.$birthdate_day;;
    }
}