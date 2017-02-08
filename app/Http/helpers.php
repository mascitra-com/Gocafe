<?php

if (! function_exists('frmtPartDate')) {
    /**
     * Format partial date (day, month, year) to well formatted Y-m-d.
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

        return $birthdate = $year.'-'.$birthdate_month.'-'.$birthdate_day;
    }
}


if (! function_exists('idWithPrefix')) {
    /**
     * Id Generator
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
            case 4: //id CAFE
                $pre = 'CFE';
                break;                
            case 5: //id CAFE'S BRANCH
                $pre = 'CFB';
                break;
            default:
                $pre = 'IMG';
                break;
        }
        return $pre.str_random(3).date('Ymdhis');
    }
}