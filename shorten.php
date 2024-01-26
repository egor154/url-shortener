<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['long_url'])) {
        $longUrl = $data['long_url'];
        $shortUrl = generateShortUrl();
        saveUrlMapping($shortUrl, $longUrl);
        echo json_encode(['short_url' => $shortUrl]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid request']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}

function generateShortUrl()
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $shortUrl = '';

    for ($i = 0; $i < 6; $i++) {
        $shortUrl .= $characters[rand(0, strlen($characters) - 1)];
    }

    return $shortUrl;
}

function saveUrlMapping($shortUrl, $longUrl)
{
    $urlMapping = json_decode(file_get_contents('url_mapping.json'), true);
    $urlMapping[$shortUrl] = $longUrl;
    file_put_contents('url_mapping.json', json_encode($urlMapping, JSON_PRETTY_PRINT));
}