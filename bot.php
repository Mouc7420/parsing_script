<?php

require_once 'config.php';
require_once 'methods_bot/methods_bot.php';
require_once 'functions.php';
require_once 'simplehtmldom-master/simple_html_dom.php';

// $result = process::trumptrade_pars('https://t.me/s/kiskinhousecanal');
// $result = process::trumptrade_forming($result[0]);

// $result2 = process::tradersignalsru_pars('https://t.me/s/daytrader_signals');
// $result2 = process::tradersignalsru_forming($result2[0]);

// print_r($result);
// print_r($result2);

$curl = curl_init('https://api.telegram.org/bot' . $token . '/getUpdates?');
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($curl);
curl_close($curl);

$result = json_decode($result, true);

$comp = array_key_exists(0, $result['result']);

if ($comp == true) {
    $offset = $result['result'][0]['update_id'] +  1;
    method::getOffset($offset, $token);

    $message_id = $result['result'][0]['message']['message_id'];
    $user_id = $result['result'][0]['message']['from']['id'];
    $user_name =  $result['result'][0]['message']['from']['username'];
    $text =  $result['result'][0]['message']['text'];
    $chat_id = $result['result'][0]['message']['chat']['id'];

    if (mb_strtolower($text) == '/start') {
        method::keyboard($token, $chat_id, 'Выберите сайт для парсинга.');
    } elseif (mb_strtolower($text) == 'trumptrade') {
        $tt = process::trumptrade_pars('https://t.me/s/kiskinhousecanal');
        $ttf = process::trumptrade_forming($tt[0]);
        method::sendMessage($token, $chat_id, 
'pair -> ' . $ttf['pair'] . ' 
coin -> ' . $ttf['coin'] . ' 
ps -> ' . $ttf['ps'] . ' 
in -> ' . $ttf['in'] . ' 
tp -> ' . $ttf['tp1'] . ', ' . $ttf['tp2'] . ', ' . $ttf['tp3'] . ', ' . $ttf['tp4'] . ', ' . $ttf['tp5'] . ' 
sl -> ' . $ttf['sl'] . ' 
lever -> ' . $ttf['lever'] . ' 
author -> ' . $ttf['author']
);
    } elseif (mb_strtolower($text) == 'trader signals ru') {
        $tsr = process::tradersignalsru_pars('https://t.me/s/daytrader_signals');
        $tsrf = process::tradersignalsru_forming($tsr[0]);
        method::sendMessage($token, $chat_id, 
'pair -> ' . $tsrf['pair'] . ' 
coin -> ' . $tsrf['coin'] . ' 
ps -> ' . $tsrf['ps'] . ' 
in -> ' . $tsrf['in'] . '  
sl -> ' . $tsrf['sl'] . ' 
author -> ' . $tsrf['author']
        );
    }
}