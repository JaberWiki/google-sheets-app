<?php

namespace App\Http\Controllers;

use Google_Client;
use Google_Service_Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class GoogleAuthController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope("https://www.googleapis.com/auth/spreadsheets");

        return redirect()->away($client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        // $client->authenticate($request->get('code'));
        // $token = $client->getAccessToken();
        // Session::put('google_access_token', $token);

        // return redirect('/dashboard');

        $client->setScopes(Google_Service_Drive::DRIVE_READONLY);

        if (request()->has('code')) {
            $token = $client->fetchAccessTokenWithAuthCode(request('code'));

            // Store the token in session
            session(['google_access_token' => $token]);

            if (session('google_access_token')) {
                $token = session('google_access_token');
                Log::info('Access Token: ', $token);
                $client->setAccessToken($token);
            }

            return redirect('/dashboard'); // Redirect to dashboard or another page after authentication
        }

        return redirect('/'); // Redirect if the code is not present
    }
}
