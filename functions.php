<?php

class process {
    public static function trumptrade_pars($url) {
        $html = file_get_html($url) -> plaintext;
        $result = explode('#', $html);
        $result = array_splice($result, count($result) - 1);
        return $result;
    }

    public static function trumptrade_forming($arrresult) {
        $result = preg_replace('/\R+/u', ' ', $arrresult);
        $result = explode(' ', $result);
        $resarray = array();
        $resarray = $resarray + [            
        'pair' => mb_strtolower($result[0]) . '/usdt',
        'coin' => mb_strtolower($result[0]),
        'ps' => mb_strtolower($result[1]),];
        $formotion = 0;
        $purposes = 1;
        foreach ($result as $value) {
            $value = mb_strtolower($value, 'UTF-8');
            if ($value == 'вход') {
                $resarray = $resarray + ['in' => $result[$formotion + 2]];
            } elseif ($value == $purposes . ')') {
                $check = preg_replace('/[.,]/', '', $result[$formotion + 1]);
                $check = preg_match('/^[0-9]+$/', $check);
                if ($check == 1) {
                    $resarray = $resarray + ['tp' . $purposes => $result[$formotion + 1]];
                    unset($result[$formotion]);
                    $purposes++;
                } else {
                    unset($result[$formotion]);
                } 
            } elseif ($value == 'стоп') {
                $check = preg_replace('/[.,]/', '', $result[$formotion + 2]);
                $check = preg_match('/^[0-9]+$/', $check);
                if ($check == 1) {
                    $resarray = $resarray + ['sl' => $result[$formotion + 2]];
                }
            } elseif ($value == 'плечо') {
                $check = preg_replace('/[.,]/', '', $result[$formotion + 1]);
                $check = preg_match('/^\d+[xXхХ]$/u', $check);
                if ($check == 1) {
                    $resarray = $resarray + ['lever' => $result[$formotion + 1]];
                }
            } elseif ($value == 'views') {
                $resarray = $resarray + ['author' => $result[$formotion + 1] . $result[$formotion + 2] . $result[$formotion + 3]];
            }
            $formotion++;
        }
        return $resarray;
    }
    public static function tradersignalsru_pars($url) {
        $html = file_get_html($url) -> plaintext;
        $result = explode('Trader signals RU', $html);
        $result = array_splice($result, count($result) - 1);
        return $result;
    }
    public static function tradersignalsru_forming($arrresult) {
        $result = preg_replace('/\R+/u', ' ', $arrresult);
        $result = explode(' ', $result); 
        $pair = preg_replace('/#/', '', mb_strtolower($result[2]));
        $coin = preg_replace('/^.|....$/u', '', mb_strtolower($result[2]));
        $in = preg_replace('/^(.)/', '', $result[4]);
        $sl = preg_replace('/^(.)/', '', $result[7]);
        $resarray = array(
            'pair' => $pair,
            'coin' => $coin,
            'ps' => mb_strtolower($result[1]),
            'in' => $in,
            'sl' => $sl,
        );
        $formotion = 0;
        foreach ($result as $value){
            $value = mb_strtolower($value);
            if ($value == 'автор:') {
                $resarray = $resarray + ['author' => $result[$formotion + 1] . ' ' . $result[$formotion + 2]];
            }
            $formotion++;
        }
        return $resarray;
    }
}