<?php
require 'token.php';

$input = file_get_contents('php://input');
$update = json_decode($input, true);

if (isset($update['message'])) {
    $chatId = $update['message']['chat']['id'];
    $text = $update['message']['text'];
    $firstName= $update['message']['chat']['first_name'];
    
    if ($text == '/start') {
        $welcomeMessage = "Salom, $firstName!";
        
        $data = [
            'chat_id' => $chatId,
            'text' => $welcomeMessage
        ];

        $url = "https://api.telegram.org/bot$token/sendMessage";
        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
    }else{

        $url = "https://api.telegram.org/bot$token/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $text
        ];

        $options = [
            'http' => [
            'header'  => "Content-type: application/json\r\n",
            'method'  => 'POST',
            'content' => json_encode($data),
            ],
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
    }
}

