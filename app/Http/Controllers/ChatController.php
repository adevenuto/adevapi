<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class ChatController extends Controller
{   
    public function query(Request $request)
    {
        try {
            $query = $request['query'];
            if(!isset($query)) return response()->json(['error' => 'A query is required'], 400);

            $data = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [[
                    'role' => 'user',
                    'content' => $query,
                 ]],
            ]);

            return response()->json(['data' => $data], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
