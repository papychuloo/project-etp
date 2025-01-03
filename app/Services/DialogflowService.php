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

    public function detectIntent($sessionId, $text)
    {
        $sessionsClient = new SessionsClient();
        $session = $sessionsClient->sessionName($this->projectId, $sessionId);

        $queryInput = new QueryInput();
        $queryInput->setText((new TextInput())->setText($text));

        $response = $sessionsClient->detectIntent($session, $queryInput);

        return $response->getQueryResult()->getFulfillmentText();
    }
}
