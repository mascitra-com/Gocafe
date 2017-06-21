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

if (!function_exists('trim_text')) {
    /**
     * Trim long text according the length you need. If the text longer than the length, it'll be replaced by "..."
     *
     * @param string $text,  int $length
     *
     * @return string $text
     */
    function trim_text($text, $length=160){
        if (strlen($text)>$length) {
            $text =substr($text, 0, $length).'...';
        }
        return $text;
    }
}


if (! function_exists('idWithPrefix')) {
    /**
     * ID Generator
     *
     * @param int $prefix
     * 1 - OWN | 2 - STF | 3 - AVT | 4 - CFE | 5 - CFB |
     * 6 - CTM | 7 - MCF | 8 - DSC | 9 - PKG | 10 - TRA |
     * 11 - TRD | Default - IMG
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
            case 8: //id DISCOUNT'S CAFE
                $pre = 'DSC';
                break;        
            case 9: //id PACKAGE'S CAFE
                $pre = 'PKG';
                break;
            case 10: //id TRANSACTION'S CAFE
                $pre = 'TRA';
                break;
            case 11: //id TRANSACTION DETAIL'S CAFE
                $pre = 'TRD';
                break;
            case 12: //id TRANSACTION DETAIL'S CAFE
                $pre = 'LGO';
                break;
            case 13: //id TRANSACTION DETAIL'S CAFE
                $pre = 'CVR';
                break;
            case 14: //id TRANSACTION DETAIL'S CAFE
                $pre = 'ADS';
                break;
            default:
                $pre = 'IMG';
                break;
        }
        return $pre.strtoupper(str_random(3)).date('Ymdhis');
    }
}