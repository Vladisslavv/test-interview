<?php

namespace App\Services\OpenAI;

use App\Services\OpenAI\Requests\CompletionRequest;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\DB;

class OpenAIService
{

    public function __construct(
        protected OpenAIClient $client
    ) {}

    /**
     * @throws RequestException
     * @throws ConnectionException
     */
    public function generateText(Authenticatable $user, array $data): void
    {
        $messages = [
            [
                'role' => 'developer',
                'content' => 'You are helpful agent that helps create nice content.'
            ],
            [
                'role' => 'user',
                'content' => $data['message']
            ]
        ];

        DB::transaction(function () use ($user, $messages) {
            $request = new CompletionRequest($messages);
            $response = $this->client->send($request);

            $user->savedContent()->create([
                'content' => $response['choices'][0]['message']['content'],
                'total_tokens' => $response['usage']['total_tokens'],
            ]);
        });
    }
}
