<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Google_Client;
use Google_Service_Sheets;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->scopes(['https://www.googleapis.com/auth/drive.metadata.readonly'])->redirect();
    }

    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $token = $user->token;

        session(['google_token' => $token]);

        return redirect('/sheets');
    }

    public function listSheets()
    {
        $client = new Google_Client();
        $client->setAccessToken(session('google_token'));
        $service = new Google_Service_Sheets($client);
        $response = $service->files->listFiles([
            'q' => "mimeType='application/vnd.google-apps.spreadsheet'",
            'fields' => 'files(id, name)'
        ]);
        return response()->json($response->files);
    }
}
