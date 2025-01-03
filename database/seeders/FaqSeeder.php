<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq; 

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        Faq::create([
            'question' => 'Quels sont les horaires des cours ?',
            'answer' => 'Les cours commencent à 8h00 et se terminent à 18h00, du lundi au vendredi.'
        ]);

        Faq::create([
            'question' => 'Quand est le prochain examen ?',
            'answer' => 'Le prochain examen est prévu le 10 janvier 2024.'
        ]);

        Faq::create([
            'question' => 'Comment obtenir un certificat d\'inscription ?',
            'answer' => 'Vous pouvez obtenir le certificat d\'inscription en vous connectant au portail étudiant.'
        ]);

        Faq::create([
            'question' => 'Où se trouve la bibliothèque ?',
            'answer' => 'La bibliothèque est située au bâtiment C, premier étage.'
        ]);
    }
}