<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faq;

class FaqSeeder extends Seeder
{
    public function run()
    {
        $faqs = [
            // Admissions
            [
                'question' => "Quels sont les critères d'admission en première année ?",
                'answer' => "Les critères d'admission en première année comprennent : dossier scolaire, notes au bac, lettre de motivation et entretien. Le processus se fait via Parcoursup.",
                'keywords' => json_encode(['admission', 'critères', 'première année', 'parcoursup']),
                'category' => 'admissions'
            ],
            [
                'question' => "Quels sont les frais de scolarité ?",
                'answer' => "Les frais de scolarité varient selon le programme. Pour l'année 2024-2025, ils sont d'environ 8500€ par an. Des bourses et aides financières sont disponibles.",
                'keywords' => json_encode(['frais', 'scolarité', 'coût', 'prix', 'bourse']),
                'category' => 'admissions'
            ],
            [
                'question' => "Comment se déroule la procédure d'admission parallèle ?",
                'answer' => "L'admission parallèle est possible en 2e, 3e ou 4e année. Le processus comprend l'étude du dossier, des tests et un entretien de motivation. Les candidats doivent avoir validé leur année précédente.",
                'keywords' => json_encode(['admission parallèle', 'transfert', 'candidature']),
                'category' => 'admissions'
            ],
            [
                'question' => "Peut-on demander une équivalence de diplôme ?",
                'answer' => "Oui, l'EPF permet de demander des équivalences de diplôme pour certaines formations. Il faudra soumettre votre dossier et le programme suivi pour une évaluation.",
                'keywords' => json_encode(['équivalence', 'diplôme', 'reconnaissance']),
                'category' => 'admissions'
            ],
            
            // Formations
            [
                'question' => "Quelles sont les spécialisations disponibles ?",
                'answer' => "L'EPF propose plusieurs spécialisations : Systèmes d'Information, Industrie 4.0, Innovation et Entrepreneuriat. Chaque spécialisation commence en 4ème année.",
                'keywords' => json_encode(['spécialisation', 'majeure', 'orientation']),
                'category' => 'formations'
            ],
            [
                'question' => "Y a-t-il des stages obligatoires ?",
                'answer' => "Oui, le cursus comprend 3 stages obligatoires : stage d'exécution (1A), stage technique (3A) et stage ingénieur (5A). Durée totale : 40 semaines minimum.",
                'keywords' => json_encode(['stage', 'entreprise', 'alternance']),
                'category' => 'formations'
            ],
            [
                'question' => "Est-il possible de faire une alternance ?",
                'answer' => "Oui, l'alternance est possible à partir de la 3e année. Le rythme est adapté avec des périodes en entreprise et à l'école. Un contrat d'apprentissage ou de professionnalisation est nécessaire.",
                'keywords' => json_encode(['alternance', 'apprentissage', 'professionnalisation']),
                'category' => 'formations'
            ],
            [
                'question' => "Y a-t-il des formations en ligne disponibles ?",
                'answer' => "L'EPF propose certains cours en ligne, principalement dans le cadre de la formation continue. Certains modules peuvent être suivis à distance selon les programmes.",
                'keywords' => json_encode(['formation en ligne', 'e-learning', 'distance']),
                'category' => 'formations'
            ],
            
            // International
            [
                'question' => "Quels sont les partenaires internationaux ?",
                'answer' => "L'EPF collabore avec plus de 150 universités dans 40 pays. Principaux partenaires : Canada, USA, Royaume-Uni, Allemagne, Espagne, Australie.",
                'keywords' => json_encode(['international', 'échange', 'université partenaire']),
                'category' => 'international'
            ],
            [
                'question' => "Comment se déroule la mobilité internationale ?",
                'answer' => "Une mobilité internationale de 3 mois minimum est obligatoire. Elle peut se faire via : semestre d'études, stage, double diplôme ou summer school.",
                'keywords' => json_encode(['mobilité', 'étranger', 'international']),
                'category' => 'international'
            ],
            [
                'question' => "Quelles sont les certifications en langues requises ?",
                'answer' => "Un niveau B2 en anglais est exigé pour l'obtention du diplôme (TOEIC 785). Une seconde langue vivante est obligatoire. Des cours de préparation sont proposés.",
                'keywords' => json_encode(['langues', 'TOEIC', 'anglais', 'certification']),
                'category' => 'international'
            ],
            [
                'question' => "Est-il possible de partir en échange étudiant pendant plusieurs semestres ?",
                'answer' => "Oui, certains étudiants partent en échange pour deux semestres à l'étranger dans le cadre de leurs études. Cependant, il faut valider certaines conditions académiques et administratives.",
                'keywords' => json_encode(['échange', 'étudiant', 'plusieurs semestres']),
                'category' => 'international'
            ],
            
            // Vie sur le campus
            [
                'question' => "Quelles sont les associations étudiantes ?",
                'answer' => "Le campus compte plus de 20 associations : BDE, BDS, clubs techniques, humanitaires, culturels. Chaque étudiant est encouragé à s'investir dans la vie associative.",
                'keywords' => json_encode(['association', 'club', 'BDE', 'vie étudiante']),
                'category' => 'vie_campus'
            ],
            [
                'question' => "Y a-t-il un logement étudiant ?",
                'answer' => "Une résidence étudiante est située à proximité du campus. Le service logement aide aussi à trouver des appartements en ville. Coût moyen : 350-500€/mois.",
                'keywords' => json_encode(['logement', 'résidence', 'appartement', 'hébergement']),
                'category' => 'vie_campus'
            ],
            [
                'question' => "Quelles sont les installations sportives disponibles ?",
                'answer' => "Le campus dispose d'un gymnase, d'une salle de musculation et de terrains extérieurs. Des partenariats existent avec des clubs sportifs locaux. Le BDS organise de nombreux événements sportifs.",
                'keywords' => json_encode(['sport', 'installations', 'gymnase']),
                'category' => 'vie_campus'
            ],
            [
                'question' => "Y a-t-il des événements étudiants organisés régulièrement ?",
                'answer' => "Oui, le BDE organise plusieurs événements étudiants tout au long de l'année : soirées, conférences, concours. Chaque mois, de nouvelles initiatives sont proposées.",
                'keywords' => json_encode(['événements', 'BDE', 'activités', 'campus']),
                'category' => 'vie_campus'
            ],
            
            // Débouchés professionnels
            [
                'question' => "Quels sont les secteurs qui recrutent ?",
                'answer' => "Les principaux secteurs recruteurs sont : l'industrie, le conseil, l'IT, l'énergie, et l'environnement. 90% des diplômés trouvent un emploi dans les 6 mois.",
                'keywords' => json_encode(['emploi', 'secteur', 'recrutement']),
                'category' => 'debouches'
            ],
            [
                'question' => "Quel est le salaire moyen à la sortie ?",
                'answer' => "Le salaire moyen à la sortie est de 40-45k€ brut annuel. Il varie selon le secteur et la région. Les alternants ont souvent des salaires plus élevés à la sortie.",
                'keywords' => json_encode(['salaire', 'rémunération', 'emploi']),
                'category' => 'debouches'
            ],
            [
                'question' => "Comment fonctionne le réseau des anciens ?",
                'answer' => "L'association des anciens EPF compte plus de 13000 membres. Elle organise des événements, propose des offres d'emploi et facilite le networking.",
                'keywords' => json_encode(['alumni', 'réseau', 'anciens']),
                'category' => 'debouches'
            ],
            [
                'question' => "Quelles sont les entreprises partenaires pour les stages ?",
                'answer' => "L'EPF dispose de partenariats avec plus de 500 entreprises dans divers secteurs. Parmi elles : Airbus, Thales, Capgemini, Veolia, et bien d'autres.",
                'keywords' => json_encode(['partenaires', 'entreprises', 'stage', 'recrutement']),
                'category' => 'debouches'
            ],
            
            // Recherche et Innovation
            [
                'question' => "Quels sont les laboratoires de recherche ?",
                'answer' => "L'école dispose de plusieurs laboratoires : matériaux, systèmes complexes, énergie durable. Des projets de recherche sont menés avec des partenaires industriels.",
                'keywords' => json_encode(['recherche', 'laboratoire', 'innovation']),
                'category' => 'recherche'
            ],
            [
                'question' => "Comment participer aux projets d'innovation ?",
                'answer' => "Les étudiants peuvent participer à des projets d'innovation via : les projets tutorés, le FabLab, les challenges d'innovation et les partenariats entreprises.",
                'keywords' => json_encode(['innovation', 'projet', 'fablab']),
                'category' => 'recherche'
            ],
            [
                'question' => "Existe-t-il des doubles diplômes recherche ?",
                'answer' => "Oui, des doubles diplômes ingénieur-master recherche sont possibles avec des universités partenaires. Ils préparent à la poursuite en doctorat.",
                'keywords' => json_encode(['master', 'recherche', 'doctorat']),
                'category' => 'recherche'
            ],
            [
                'question' => "Y a-t-il des opportunités pour participer à des projets industriels ?",
                'answer' => "Oui, des projets industriels sont régulièrement organisés en collaboration avec des entreprises, offrant aux étudiants l'opportunité de travailler sur des problématiques réelles.",
                'keywords' => json_encode(['projets industriels', 'entreprise', 'innovation']),
                'category' => 'recherche'
            ]
            
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
