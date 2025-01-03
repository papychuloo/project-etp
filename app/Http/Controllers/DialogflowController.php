<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DialogflowService;

class DialogflowController extends Controller
{
    protected $dialogflowService;

    public function __construct(DialogflowService $dialogflowService)
    {
        $this->dialogflowService = $dialogflowService;
    }

    public function handleUserQuery(Request $request)
    {
        $sessionId = session()->getId(); // Utiliser une session unique
        $userMessage = $request->input('message'); // Récupérer le message utilisateur

        $response = $this->dialogflowService->detectIntent($sessionId, $userMessage);

        return response()->json([
            'message' => $response->getFulfillmentText(),
        ]);
    }
}


