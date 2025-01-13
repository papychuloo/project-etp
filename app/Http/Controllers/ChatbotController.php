<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Faq;

class ChatbotController extends Controller
{
    public function handleQuery(Request $request)
    {
        $question = strtolower($request->input('question'));
        $category = strtolower($request->input('category', ''));

        $filteredFaq = $this->filterByCategory($category);

        
        $answer = $this->findAnswerInFaq($question, $filteredFaq);

        
        $this->askForFeedback($answer ?? "Je ne connais pas encore la réponse à cette question.", $question);

        return response()->json([
            'answer' => $answer ?? "Je ne connais pas encore la réponse à cette question.",
            'feedback_prompt' => 'Est-ce que cela a répondu à votre question ? (Oui/Non)'
        ]);
    }

    private function filterByCategory($category)
    {
        if (empty($category)) {
            return Faq::all(); 
        }

        return Faq::where('category', 'like', "%$category%")->get(); 
    }

    private function findAnswerInFaq($question, $faq)
    {
        foreach ($faq as $item) {
            
            if (stripos($item->question, $question) !== false) {
                return $item->answer;
            }

         
            $keywords = is_array($item->keywords) ? $item->keywords : json_decode($item->keywords, true);
            if ($keywords) {
                foreach ($keywords as $keyword) {
                    if (stripos($question, strtolower($keyword)) !== false) {
                        return $item->answer;
                    }
                }
            }
        }

        return null;
    }

    private function askForFeedback($answer, $question)
    {
        session(['last_answer' => $answer, 'last_question' => $question]);
    }

    public function handleFeedback(Request $request)
    {
        $feedback = strtolower($request->input('feedback'));
        $question = session('last_question');

        if (!$question) {
            return response()->json(['error' => 'Aucune question précédente n\'a été trouvée.']);
        }

        if ($feedback === 'non') {
            $this->storeFeedback($question, 'negative');
            return response()->json(['message' => 'Merci pour votre retour ! Nous allons améliorer la réponse.']);
        } elseif ($feedback === 'oui') {
            $this->storeFeedback($question, 'positive');
            return response()->json(['message' => 'Merci, nous sommes heureux d’avoir pu vous aider !']);
        } else {
            return response()->json(['error' => 'Veuillez répondre par "Oui" ou "Non".']);
        }
    }

    public function storeFeedback($question, $feedback)
    {
        try {
            $feedbackRecord = new Feedback();
            $feedbackRecord->question = $question;
            $feedbackRecord->feedback = $feedback;
            $feedbackRecord->save();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Une erreur est survenue lors de l\'enregistrement du feedback.']);
        }
    }
}
