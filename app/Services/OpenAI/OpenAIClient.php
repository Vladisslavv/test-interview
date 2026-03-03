<?php
namespace App\Services\OpenAI;

use App\Interfaces\AIRequest;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;

class OpenAIClient
{
    private string $baseUrl = 'https://api.openai.com/';

    /**
     * Send request to Open AI
     * @throws ConnectionException
     * @throws RequestException
     */
    public function send(AIRequest $request)
    {
        return Http::withToken(config('openai.key'))
            ->timeout(60)
            ->post(
                $this->baseUrl . $request->endpoint(),
                $request->toArray()
            )
            ->throw()
            ->json();
    }
}
