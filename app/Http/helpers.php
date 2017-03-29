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
     * @param int $prefix
     * 1 - OWN | 2 - STF | 3 - AVT | 4 - CFE | 5 - CFB | 6 - CTM | 7 - MCF | Default - IMG
     *
     * @return string
     * @internal param string $prefix
     */
    function idWithPrefix($prefix)
    {
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
            case 6: //id MENU'S CATEGORY
                $pre = 'CTM';
                break;            
            case 7: //id MENU'S CAFE
                $pre = 'MCF';
                break;            
            case 8: //id MENU'S CAFE
                $pre = 'DSC';
                break;
            default:
                $pre = 'IMG';
                break;
        }
        return $pre.strtoupper(str_random(3)).date('Ymdhis');
    }
}