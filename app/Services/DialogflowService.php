<?php

namespace App\Services;

use Google\Cloud\Dialogflow\V2\SessionsClient;
use Google\Cloud\Dialogflow\V2\QueryInput;
use Google\Cloud\Dialogflow\V2\TextInput;

class DialogflowService
{
    protected $projectId;

    public function __construct()
    {
        $this->projectId = env('bobot-446414');
        putenv('GOOGLE_APPLICATION_CREDENTIALS=' . storage_path('app/keys/dialogflow-key.json'));
    }

    public function detectIntent($sessionId, $text, $languageCode = 'fr')
    {
        $sessionsClient = new SessionsClient();
        $session = $sessionsClient->sessionName($this->projectId, $sessionId ?: uniqid());

        // Créer l'entrée utilisateur
        $textInput = new TextInput();
        $textInput->setText($text);
        $textInput->setLanguageCode($languageCode);

        $queryInput = new QueryInput();
        $queryInput->setText($textInput);

        // Envoyer la requête à Dialogflow
        $response = $sessionsClient->detectIntent($session, $queryInput);
        $queryResult = $response->getQueryResult();

        // Retourner l'intention détectée et la réponse
        return [
            'intent' => $queryResult->getIntent()->getDisplayName(),
            'response' => $queryResult->getFulfillmentText(),
        ];
    }
}
