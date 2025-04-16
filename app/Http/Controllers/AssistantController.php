<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Questions;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class AssistantController extends Controller
{
    public function generateText(Request $request)
    {
        $question = $request->question;
        $language = $request->language;
        $answer = $request->answer;

        $prompt = "Génère un questionnaire à choix multiple (QCM) sur le langage de programmation : $language.
        Le questionnaire doit comporter $question questions, réparties en trois catégories de difficulté :
        - 30% de questions simples,
        - 40% de questions moyennes,
        - 30% de questions difficiles.
        Chaque question doit avoir $answer propositions de réponse.

        Assure-toi que les questions de chaque catégorie sont adaptées à leur niveau de difficulté et couvrent un éventail de sujets pertinents pour le langage de programmation spécifié.

        Réponds uniquement avec un tableau JSON **valide** contenant les questions, sous forme de tableau associatif comme l’exemple suivant :

        [
            {
                \"question_number\": 10,
                \"question_text\": \"Quel est le nom du package de la gestion des exceptions de contrat d\'Ada?\",
                \"answer_options\": {
                  \"A\": \"Ada.Contracts.Exception\",
                  \"B\": \"Ada.Exceptions.Contract\",
                  \"C\": \"Ada.Contracts_Exceptions\",
                  \"D\": \"Ada.Contracts_Handling\"
                },
                \"correct_answer\": \"C\"
              }
            ...
        ]

        N’inclus **aucun texte explicatif**, ni balise Markdown, ni introduction, ni conclusion. Seulement du JSON brut.";
        $apiKey = config(key:'mistral.api_key');
        try {
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

            $this->saveBDD($content, $language);
        } catch (\Exception $e) {
            return redirect()->route('knowledge.index');
        }
        return redirect()->route('knowledge.index');
    }

    public function saveBDD($request, $language)
    {
        $questions_data = json_decode($request, true);
        $test_id = Questions::orderBy('test_id', 'desc')->first();
        if ($test_id == null) {
            $test_id = 0;
        }
        else{
            $test_id +=1;
        }
        foreach ($questions_data as $question) {
            $question_number = $question['question_number'];
            $question_text = $question['question_text'];

            $correct_answer = $question['correct_answer'];
            $answer_id =0;
            $answer_options = $question['answer_options'];
            if (is_string($answer_options)) {
                // Décoder le JSON uniquement si c'est une chaîne
                $answerOptions = json_decode($answer_options, true);
            }
            else{
                $answerOptions =$answer_options;
            }
            foreach ($answerOptions as $letter => $text) {
                $question = new Questions();
                $question->test_id= $test_id;
                $question->question_id= $question_number;
                $question->question= $question_text ;
                $question->answer_id= $answer_id;
                $question->answer= $text;
                $question->language= $language;
                if ($letter == $correct_answer) {
                    $question->IsTrue= True;
                }
                else{
                    $question->IsTrue= False;
                }
                $question->save();
                $answer_id +=1;
            }
        }
    }
}
