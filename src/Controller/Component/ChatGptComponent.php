<?php
namespace App\Controller\Component;

use Orhanerday\OpenAi\OpenAi;
use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Http\Client;
use Cake\Cache\Cache;

/**
 * ChatGpt component
 */
class ChatGptComponent extends Component
{
    public function create($content)
    {

        try {
            $open_ai = new OpenAi('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');
            $chat = $open_ai->chat([
                "model" => "gpt-3.5-turbo",
                "messages" => [
                    [
                        "role" => "user",
                        "content" => $content
                    ]
                ],
                'temperature' => 1.0,
                'max_tokens' => 1000,
                'frequency_penalty' => 0,
                'presence_penalty' => 0
            ]);

            return $chat;
        } catch (\Exception $e) {
            return false;
        }
    }
}
