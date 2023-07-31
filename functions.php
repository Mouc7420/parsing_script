<?php

class process {
    public static function trumptrade_forming($text) {
        $result = explode('#', $text);
        $result = preg_replace('/\R+/u', ' ', $result);
        $result = explode(' ', $result[1]);
        $resarray = array();
        $resarray = $resarray + [            
        'pair' => mb_strtolower($result[0]) . '_usdt',
        'coin' => mb_strtolower($result[0]),
        'ps' => mb_strtolower($result[1]),];
        $formotion = 0;
        $purposes = 1;
        $informotion = 0;
        foreach ($result as $value) {
            $value = mb_strtolower($value, 'UTF-8');
            if ($value == 'вход') {
                $check = preg_replace('/[.,]/', '', $result[$formotion + 2]);
                $check = preg_match('/^[0-9]+$/', $check);
                if ($check == 1) {
                $resarray = $resarray + ['in' => $result[$formotion + 2]];
                } else {
                    $whilein = 0;
                    while ($whilein == 0) {
                        $check2 = preg_replace('/[.,]/', '', $result[$formotion + $informotion]);
                        $check2 = preg_match('/^[0-9]+$/', $check2);
                        if ($check2 == 1) {
                            $resarray = $resarray + ['in' => $result[$formotion + $informotion]];
                            $whilein++;
                        } else {
                            $informotion++;
                        }
                    }
                }
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
    public static function tradersignalsru_forming($text) {
        $result = preg_replace('/\R+/u', ' ', $text);
        $result = explode(' ', $result); 
        print_r($result);
        $coin = preg_replace('/^.|....$/u', '', mb_strtolower($result[1]));
        $pair = preg_replace('/.*(?=.{4}$)/', '', mb_strtolower($result[1]));
        $in = preg_replace('/^(.)/', '', $result[3]);
        $sl = preg_replace('/^(.)/', '', $result[6]);
        $resarray = array(
            'pair' => $coin . '_' . $pair,
            'coin' => $coin,
            'ps' => mb_strtolower($result[0]),
            'in' => $in,
            'sl' => $sl,
        );
        $formotion = 0;
        foreach ($result as $value){
            $value = mb_strtolower($value);
            if ($value == 'автор:') {
                $check = preg_match('/^([a-zA-Z]+)$/', $result[$formotion + 2]);
                if ($check == 1) {
                $resarray = $resarray + ['author' => $result[$formotion + 1] . ' ' . $result[$formotion + 2]];
                } else {
                    $resarray = $resarray + ['author' => $result[$formotion + 1]];
                }
            }
            $formotion++;
        }
        return $resarray;
    }
}