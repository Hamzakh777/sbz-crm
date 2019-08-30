<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function index(Request $request) {
        $path = $request->query('path');
        $exists = Storage::disk('spaces')->exists($path);

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        $downloadPath = Storage::disk('spaces')->url($path);
        if($exists) {
            return response($downloadPath)
            ->header('Content-Disposition', 'attachment; filename="test.png"')
            ->header('Content-Description', 'File Transfer');
        } else {
            return response()->json([
                'error' => [
                    'message' => 'File not found'
                ]
                ], 404);
        }
    }
}
