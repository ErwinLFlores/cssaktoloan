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
