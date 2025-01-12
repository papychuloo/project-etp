<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;

    protected $table = 'faqs';

    protected $fillable = [
        'question',
        'answer',
        'keywords',
        'category'
    ];

    protected $casts = [
        'keywords' => 'array'
    ];

    public static function findMatchingQuestions($userInput)
    {
        // Convertir l'entrée utilisateur en minuscules
        $userInput = mb_strtolower($userInput);
        
        // Récupérer toutes les FAQs
        $faqs = self::all();
        
        // Structure pour stocker les correspondances avec leurs scores
        $matches = [];
        
        foreach ($faqs as $faq) {
            $score = 0;
            
            // Vérifier les mots-clés
            $keywords = is_array($faq->keywords) ? $faq->keywords : json_decode($faq->keywords, true);
            if ($keywords) {
                foreach ($keywords as $keyword) {
                    if (str_contains($userInput, mb_strtolower($keyword))) {
                        $score += 2; // Les mots-clés ont plus de poids
                    }
                }
            }
            
            // Vérifier la question elle-même
            if (str_contains(mb_strtolower($faq->question), $userInput)) {
                $score += 3;
            }
            
            // Vérifier les mots individuels de la question
            $words = explode(' ', $userInput);
            foreach ($words as $word) {
                if (strlen($word) > 2) { // Ignorer les mots très courts
                    if (str_contains(mb_strtolower($faq->question), $word)) {
                        $score += 1;
                    }
                }
            }
            
            // Si nous avons trouvé des correspondances
            if ($score > 0) {
                $matches[] = [
                    'faq' => $faq,
                    'score' => $score
                ];
            }
        }
        
        // Trier par score décroissant
        usort($matches, function($a, $b) {
            return $b['score'] - $a['score'];
        });
        
        // Retourner les 3 meilleures correspondances
        return array_slice($matches, 0, 3);
    }

    public static function getRandomByCategory($category)
    {
        return self::where('category', $category)
                  ->inRandomOrder()
                  ->first();
    }

    public static function getSuggestedQuestions($category = null)
    {
        $query = self::select('question', 'category')
                    ->orderBy('category');
        
        if ($category) {
            $query->where('category', $category);
        }
        
        return $query->limit(5)->get();
    }
}
