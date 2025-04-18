<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\CohortTest;
use App\Models\promotion_common_task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Questions;
use function Webmozart\Assert\Tests\StaticAnalysis\null;

class AssistantController extends Controller
{
    //generateText give a prompt to Gemini API AI to create a QCM based on a programming language
    public function generateText(Request $request)
    {
        $question = $request->question;
        $language = $request->language;
        $answer = $request->answer;
        $cohorts_id = $request->cohort;
        if($language==null || $answer==null){
            return redirect()->route('knowledge.index');
        }

        //Create the prompt with the programming language and the number of answers and questions given
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


        $apiKey = env('GEMINI_API_KEY');
        // Send the prompt to the GEMINI API
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post( 'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=' . $apiKey, [
            'contents' => [
                [
                    'parts' => [
                        ['text' => $prompt],
                    ],
                ],
            ],
        ]);

        //Take only the content of the response
        $content = $response['candidates'][0]['content']['parts'][0]['text'];

        //Use this function to save the content in the database
        $this->saveBDD($content, $language, $cohorts_id);
        return redirect()->route('knowledge.index');
    }

    //saveBDD save the response of Gemini API in the database
    public function saveBDD($content, $language, $cohort_id)
    {
        //Change the content from string to Json
        $newJson = preg_replace('/^```json\s*/', '', $content); //Remove the ```json from the content start
        $newJson = preg_replace('/\s*```$/', '', $newJson); //Remove the ``` from the content rn
        $questions_data = json_decode($newJson);

        //Increment the id of the test
        $lastQuestion = Questions::latest('test_id')->first(); //Take the last test id in the database
        $test_id = $lastQuestion ? $lastQuestion->test_id + 1 : 0; //If there is no id put 0 otherwise give the last test id +1

        //Browse the list of questions
        foreach ($questions_data as $question) {

            //Save this in data in variable to use them later
            $question_number = $question->question_number;
            $question_text = $question->question_text;
            $correct_answer = $question->correct_answer;

            $answer_id =0;// The answer id will increment

            $answer_options = $question->answer_options;//the list of answer

            //Decodes JSON only if it's a json string
            if (is_string($answer_options)) {

                $answerOptions = json_decode($answer_options, true);
            }
            else{
                $answerOptions =$answer_options;
            }

            //Browse the list of answers
            foreach ($answerOptions as $letter => $text) {
                //create a new question to save
                $question_bdd = new Questions();
                $question_bdd->test_id= $test_id;
                $question_bdd->question_id= $question_number;
                $question_bdd->question= $question_text ;
                $question_bdd->answer_id= $answer_id;
                $question_bdd->answer= $text;
                $question_bdd->language= $language;

                //Check if it's the correct answer
                if ($letter == $correct_answer) {
                    $question_bdd->IsTrue= True;//If it is IsTrue become true
                }
                else{
                    $question_bdd->IsTrue= False;//Otherwise IsTrue is false
                }

                $question_bdd->save();//Save the answer

                $answer_id +=1;// increment the answer id
            }


        }
        if($cohort_id == "everybody") {
            $cohorts = Cohort::all();
            //Browse the cohorts
            foreach($cohorts as $cohort) {
                //create a new cohort
                $cohort_test = new CohortTest();
                $cohort_test->cohort_id = $cohort->id;
                $cohort_test->test_id = $test_id;
                $cohort_test->save();//Save it into the database
            }
        }
        else{
            //create a new cohort
            $cohort_test = new CohortTest();
            $cohort_test->cohort_id = $cohort_id;
            $cohort_test->test_id = $test_id;
            $cohort_test->save();//Save it into the database
        }
    }
}
