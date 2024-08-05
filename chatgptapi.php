<?php

$payload = array(
    'messages' => array(
        array(
            'role' => 'assistant',
            'content' => 'Hello! How can I help you today?'
        ),
        array(
            'role' => 'user',
            'content' => isset($_GET['question']) ? $_GET['question'] : 'Please provide a question parameter.'
        )
    )
);

$json_payload = json_encode($payload);

$headers = array(
    'User-Agent: Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36',
    'Location: https://seoschmiede.at/en/aitools/chatgpt-tool/',
    'Accept: application/json',
    'Content-Type: application/json',
   
);

if (!isset($_GET['question'])) {
    echo "Please provide a 'question' parameter.";
} else {
    $url = 'https://chatbot-ji1z.onrender.com/chatbot-ji1z';

    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json_payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);

    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_status == 200) {
        $api_response = json_decode($response, true);

$desired_output = array(
    'answer' => $api_response['choices'][0]['message']['content'],
    'join' => '@devsnp'
);

echo json_encode($desired_output, JSON_PRETTY_PRINT);

    } else {
        echo "Failed. Status code: $http_status\n";
    }

    curl_close($ch);
}
?>