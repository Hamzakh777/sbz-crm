<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileDownloadController extends Controller
{
    public function index(Request $request) {
        $path = $request->query('path');
        $exists = Storage::disk('spaces')->exists($path);

        $downloadPath = Storage::disk('spaces')->url($path);

        // extension
        $ext = pathinfo($downloadPath, PATHINFO_EXTENSION);
        $name = pathinfo($downloadPath, PATHINFO_FILENAME);

        $filename =  $name . '.' . $ext;

        $headers = [
            'Content-Disposition: attachment; filename' . $filename,
            'Content-Description: File Transfer'
        ];

        if($exists) {
            return Storage::download($path, $name. '.' . $ext, $headers);
        } else {
            return response()->json([
                'error' => [
                    'message' => 'File not found'
                ]
            ], 404);
        }
    }
}
