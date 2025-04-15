<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AssistantController extends Controller
{
    public function generateText(Request $request)
    {
        $question = $request->question;
        $langage = $request->langage;
        $answer = $request->answer;

        $prompt = "Génère un questionnaire à choix multiple (QCM) avec ". $question ." questions sur le langage de
            programmation :". $langage.". Chaque question doit avoir ". $answer ." propositions";
        $apiKey = config(key:'mistral.api_key');

        // Send the prompt to the Mistral API
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiKey,
            'Content-Type' => 'application/json',
        ])->post('https://api.mistral.ai/v1/chat/completions', [
            'model' => 'mistral-tiny',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        dd($response->json());
        /**
        if ($response->successful()) {
            $data = $response->json();


            // Process the data received from the API
            return redirect()->back()->with('success', 'Prompt sent successfully!');
        } else {
            return redirect()->back()->with('error', 'Error while sending the prompt.');
        }**/

    }
}
