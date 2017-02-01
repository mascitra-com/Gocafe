<?php

use Carbon\Carbon;

if (! function_exists('frmtPartDate')) {
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


if (! function_exists('idWithPrefix')) {
    /**
     * Format partial date (day, month, year) to well formated Y-m-d.
     * day : 2, month: 4, year:1995 will be --> 1995-05-02
     *
     * @param  string  $day, $month, $year
     * @return string
     */
    function idWithPrefix($prefix = 0)
    {
        $pre = '';
        switch ($prefix) {
            case 1: //id OWNER
                $pre = 'OWN';
                break;
            case 2: //id STAFF
                $pre = 'STF';
                break;
            case 3: //id Image Profile
                $pre = 'AVT';
                break;
            default:
                $pre = 'IMG';
                break;
        }
        return $pre.random_int(100, 999).date('Ymdhis');
    }
}