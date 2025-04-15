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

        $prompt = "Génère un questionnaire à choix multiple (QCM) sur le langage de programmation : $langage.
        Le questionnaire doit comporter $question questions, réparties en trois catégories de difficulté :
        - 30% de questions simples,
        - 40% de questions moyennes,
        - 30% de questions difficiles.
        Chaque question doit avoir $answer propositions de réponse.

        Assure-toi que les questions de chaque catégorie sont adaptées à leur niveau de difficulté et couvrent un éventail de sujets pertinents pour le langage de programmation spécifié.

        Réponds uniquement avec un tableau JSON **valide** contenant les questions, sous forme de tableau associatif comme l’exemple suivant :

        [
            {
                \"question_number\": 1,
                \"question_text\": \"Texte de la question\",
                \"answer_option_A\": \"Option A\",
                \"answer_option_B\": \"Option B\",
                \"answer_option_C\": \"Option C\",
                \"answer_option_D\": \"Option D\",
                \"correct_answer\": \"A\"
            },
            ...
        ]

        N’inclus **aucun texte explicatif**, ni balise Markdown, ni introduction, ni conclusion. Seulement du JSON brut.";
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
        $content = $response->json()['choices'][0]['message']['content'];
        dd($content);
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
