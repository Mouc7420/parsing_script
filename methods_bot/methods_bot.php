<?php

class method {
    public static function getOffset($offset, $token) {
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/getUpdates?offset=' . $offset);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function sendMessage($token, $chat_id, $reply_text) {
        $getQuery = array(
            'chat_id' 	=> $chat_id,
            'text'  	=> $reply_text,
            'parse_mode' => 'html'

        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function reply_sendMessage($token, $message_id, $chat_id, $reply_text) {
        $getQuery = array(
            'chat_id' 	=> $chat_id,
            'text'  	=> $reply_text,
            'parse_mode' => 'html',
            'reply_to_message_id' => $message_id,

        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function keyboard($token, $chat_id, $reply_text) {
        $getQuery = array(
            'chat_id' 	=> $chat_id,
            'text'  	=> $reply_text,
            'parse_mode' => 'html',
            'reply_markup' => json_encode(array(
                'keyboard' => array(
                array(
                    array(
                        'text' => 'TrumpTrade',
                    ),
                    array(
                        'text' => 'Trader signals RU',
                    ),
                )),
                'resize_keyboard' => true,
            )),
        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function inline_keyboard($token, $chat_id, $key_text, $callback_text, $reply_text) {
        $getQuery = array(
            'chat_id' 	=> $chat_id,
            'text'  	=> $reply_text,
            'parse_mode' => 'html',
            'reply_markup' => json_encode(array(
                'inline_keyboard' => array(
                array(
                    array(
                        'text' => $key_text,
                        'callback_data' => $callback_text,
                    ),
                )),
            )),
        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function inline_keyboard_cube($token, $chat_id, $reply_text) {
        $getQuery = array(
            'chat_id' 	=> $chat_id,
            'text'  	=> $reply_text,
            'parse_mode' => 'html',
            'reply_markup' => json_encode(array(
                'inline_keyboard' => array(
                array(
                    array(
                        'text' => '🎲 1',
                        'callback_data' => 1,
                    ),
                    array(
                        'text' => '🎲 2',
                        'callback_data' => 2,
                    ),
                    array(
                        'text' => '🎲 3',
                        'callback_data' => 3,
                    ),
                ),
                array(
                    array(
                        'text' => '🎲 4',
                        'callback_data' => 4,
                    ),
                    array(
                        'text' => '🎲 5',
                        'callback_data' => 5,
                    ),
                    array(
                        'text' => '🎲 6',
                        'callback_data' => 6,
                    ),
                )),
            )),
        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function reply_inline_keyboard_cube($token, $chat_id, $message_id, $reply_text) {
        $getQuery = array(
            'chat_id' 	=> $chat_id,
            'text'  	=> $reply_text,
            'parse_mode' => 'html',
            'reply_markup' => json_encode(array(
                'inline_keyboard' => array(
                array(
                    array(
                        'text' => '🎲 1',
                        'callback_data' => 1,
                    ),
                    array(
                        'text' => '🎲 2',
                        'callback_data' => 2,
                    ),
                    array(
                        'text' => '🎲 3',
                        'callback_data' => 3,
                    ),
                ),
                array(
                    array(
                        'text' => '🎲 4',
                        'callback_data' => 4,
                    ),
                    array(
                        'text' => '🎲 5',
                        'callback_data' => 5,
                    ),
                    array(
                        'text' => '🎲 6',
                        'callback_data' => 6,
                    ),
                )),
            )),
            'reply_to_message_id' => $message_id,
        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function pisateli($token, $chat_id, $reply_text) {
        $getQuery = array(
            'chat_id' 	=> $chat_id,
            'text'  	=> $reply_text,
            'parse_mode' => 'html',
            'reply_markup' => json_encode(array(
                'keyboard' => array(
                array(
                    array(
                        'text' => 'Грибоедов',
                    ),
                    array(
                        'text' => 'Достоевский',
                    ),
                    array(
                        'text' => 'Жуковский',
                    ),
                ),
                array(
                    array(
                        'text' => 'Лермонтов',
                    ),
                    array(
                        'text' => 'Пушкин',
                    ),
                    array(
                        'text' => 'Толстой',
                    ),
                    array(
                        'text' => 'Тургенев',
                    ),
                )),
                'resize_keyboard' => true,
            )),
        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendMessage?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public static function sendPhoto($token, $chat_id, $photo, $reply_text) {
        $getQuery = array(
            'chat_id' => $chat_id,
            'caption' => $reply_text,
            'photo' => $photo
        );
        $curl = curl_init('https://api.telegram.org/bot' . $token . '/sendPhoto?' . http_build_query($getQuery));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        curl_close($curl);
    }
}