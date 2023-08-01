<?php

class process {
    public static function trumptrade_forming($text) {
        $result = explode('#', $text);
        $result = preg_replace('/\R+/u', ' ', $result);
        $result = explode(' ', $result[1]);;
        $resarray = array();
        if ($result[0] != '') {
            $resarray = $resarray + [
            'pair' => mb_strtolower($result[0]) . '_usdt',
            'coin' => mb_strtolower($result[0]),];
        } else {
            $go = 0;
            $gor = 0;
            while ($go == 0) {
                if ($result[$gor] != '') {
                    $resarray = $resarray + [
                    'pair' => mb_strtolower($result[$gor]) . '_usdt',
                    'coin' => mb_strtolower($result[$gor]),];
                    $go++;
                } else {
                    $gor++;
                }
            }
        }
        $formotion = 0;
        $purposes = 1;
        $informotion = 0;
        foreach ($result as $value) {
            $value = mb_strtolower($value, 'UTF-8');
            if ($value == 'long' or $value == 'short') {
                $resarray = $resarray + ['ps' => $value,];
            } elseif ($value == 'вход') {
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
            }
            $formotion++;
        }
        return $resarray;
    }
    public static function tradersignalsru_forming($text) {
        $result = preg_replace('/\R+/u', ' ', $text);
        $result = explode(' ', $result); 
        $resarray = array();
        if ($result[1] != '') {
            $check = preg_replace('/^#(.*)....$/', '\\1', $result[1]);
            $resarray = $resarray + [
            'pair' => mb_strtolower($check) . '_usdt',
            'coin' => mb_strtolower($check),];
        } else {
            $go = 0;
            $gor = 1;
            while ($go == 0) {
                if ($result[$gor] != '') {
                    $check = preg_replace('/^#(.*)....$/', '\\1', $result[$gor]);
                    $resarray = $resarray + [
                    'pair' => mb_strtolower($check) . '_usdt',
                    'coin' => mb_strtolower($check),];
                    $go++;
                } else {
                    $gor++;
                }
            }
        }
        $formotion = 0;
        foreach ($result as $value){
            $value = mb_strtolower($value);
            if ($value == 'long' or $value == 'short') {
                $resarray = $resarray + ['ps' => mb_strtolower($value)];
            } elseif ($value == 'from') {
                $check = preg_match('/^[0-9]+$/', $result[$formotion + 2]);
                if ($check == 1) {
                    $val = preg_replace('/\$/', '', $result[$formotion + 1]);
                    $resarray = $resarray + ['in' => $val . $result[$formotion + 2]];
                } else {
                    $val = preg_replace('/\$/', '', $result[$formotion + 1]);
                    $resarray = $resarray + ['in' => $val];
                }
            } elseif ($value == 'stop') {
                $check = preg_match('/^[0-9]+$/', $result[$formotion + 3]);
                if ($check == 1) {
                    $val = preg_replace('/\$/', '', $result[$formotion + 2]);
                    $resarray = $resarray + ['sl' => $val . $result[$formotion + 3]];
                } else {
                    $val = preg_replace('/\$/', '', $result[$formotion + 2]);
                    $resarray = $resarray + ['sl' => $val];
                }
            } elseif ($value == 'автор:') {
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