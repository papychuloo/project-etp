<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DialogflowService;

class ChatbotController extends Controller
{
    protected $dialogflow;

    public function __construct(DialogflowService $dialogflow)
    {
        $this->dialogflow = $dialogflow;
    }

    public function handleMessage(Request $request)
    {
        try {
            $request->validate([
                'message' => 'required|string',
            ]);

            $sessionId = $request->session()->getId();
            $userMessage = $request->input('message');

            $botResponse = $this->dialogflow->detectIntent($sessionId, $userMessage);

            return response()->json(['response' => $botResponse]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erreur : ' . $e->getMessage()], 500);
        }
    }

    public function handleQuery(Request $request)
{
    $question = $request->input('question');

    // Base de données fictive pour les réponses
    $faq = [
        "Quels sont les horaires de Calcul avancé ?" => "Le cours de Calcul avancé a lieu le lundi de 10h à 12h en salle A101.",
        "Comment obtenir un certificat d'inscription ?" => "Vous pouvez obtenir un certificat d'inscription via votre portail étudiant dans la section 'Documents'.",
        "Quand est le prochain examen de maths ?" => "Le prochain examen de maths est prévu le 15 décembre à 9h en salle B202."
    ];

    // Recherche de la réponse correspondante
    $answer = $faq[$question] ?? "Je ne connais pas encore la réponse à cette question.";

    return response()->json(['answer' => $answer]);
}

}
