<?php
    // Import the Telegram Bot API library
    require_once 'path/to/bot-api-sdk-php/autoload.php';

    // Create a new Telegram Bot API client
    $telegram = new Telegram\Bot\Api('YOUR_BOT_TOKEN');

    // Get the file sent to the bot
    $file = $telegram->getFile(['file_id' => $update['message']['document']['file_id']]);

    // Download the file
    $file_path = $file->getFilePath();
    $file_url = "https://api.telegram.org/file/bot{$bot_token}/{$file_path}";
    $file_contents = file_get_contents($file_url);

    // Save the file to the server
    $upload_path = 'path/to/save/file/on/server.ext';
    file_put_contents($upload_path, $file_contents);

    // Generate a direct link for the file
    $direct_link = 'https://your-domain.com/' . $upload_path;

    // Send the direct link to the user
    $telegram->sendMessage([
        'chat_id' => $update['message']['chat']['id'],
        'text' => $direct_link,
    ]);
?>
