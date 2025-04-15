<?php

namespace App\Services;


class GeminiService
{
    use Illuminate\Support\Facades\Http;

    protected $apiUrl = 'https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent';

    public function generateText($prompt)
    {
        $response = Http::post($this->apiUrl . '?key=' . env('GEMINI_API_KEY'), [
            'prompt' => ['text' => $prompt]
        ]);

        return $response->json();
    }
}
