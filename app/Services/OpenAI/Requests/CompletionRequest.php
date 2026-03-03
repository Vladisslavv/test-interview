<?php
namespace App\Services\OpenAI\Requests;

use App\Interfaces\AIRequest;

class CompletionRequest implements AIRequest
{
    public function __construct(
        private array $messages,
        private float $temperature = 0.7,
        private bool $stream = false,
        private int $maxTokens = 500,
    ) {}

    public function endpoint(): string
    {
        return '/v1/chat/completions';
    }

    public function toArray(): array
    {
        return [
            'model' => config('openai.models.completion'),
            'messages' => $this->messages,
            'temperature' => $this->temperature,
            'stream' => $this->stream,
            'max_tokens' => $this->maxTokens,
        ];
    }
}
