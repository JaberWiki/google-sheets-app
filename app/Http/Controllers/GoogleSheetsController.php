<?php

namespace App\Http\Controllers;

use Google_Client;
use Google\Service;
use Google_Service_Drive;
use Illuminate\Http\Request;

class GoogleSheetsController extends Controller
{
    // private $service;
    private $driveService;

    public function __construct()
    {
        // $client = new Google_Client();
        // $client->setAccessToken(session('google_access_token'));
        // $this->service = new Google_Service_Sheets($client);

        $client = new Google_Client();
        $client->setAccessToken(session('google_access_token'));
        $this->driveService = new Google_Service_Drive($client);
    }

    // public function getData($spreadsheetId, $range)
    // {
    //     $response = $this->service->spreadsheets_values->get($spreadsheetId, $range);
    //     return response()->json($response->getValues());
    // }

    // public function addData(Request $request, $spreadsheetId, $range)
    // {
    //     $values = [
    //         [$request->input('data')]
    //     ];
    //     $body = new \Google_Service_Sheets_ValueRange([
    //         'values' => $values
    //     ]);
    //     $params = [
    //         'valueInputOption' => 'RAW'
    //     ];
    //     $this->service->spreadsheets_values->append($spreadsheetId, $range, $body, $params);
    //     return response()->json(['status' => 'Data added successfully']);
    // }

    // public function deleteData($spreadsheetId, $range)
    // {
    //     // Implement logic to clear or delete rows from Google Sheets
    //     return response()->json(['status' => 'Data deleted successfully']);
    // }

    public function listSheets()
    {
        $files = $this->driveService->files->listFiles([
            'q' => "mimeType='application/vnd.google-apps.spreadsheet'",
            'fields' => 'files(id, name)',
        ]);

        return response()->json($files->getFiles());
    }
}
