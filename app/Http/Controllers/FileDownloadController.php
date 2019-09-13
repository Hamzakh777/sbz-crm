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
        // $downloadPath = Storage::disk('spaces')->temporaryUrl(
        //     $path,
        //     now()->addMinutes(5)
        // );

        $ext = pathinfo($downloadPath, PATHINFO_EXTENSION);
        $name = pathinfo($downloadPath, PATHINFO_FILENAME);
        $mime = Storage::disk('spaces')->getDriver()->getMimetype($path);
        $size = Storage::disk('spaces')->getDriver()->getSize($path);

        $filename =  $name . '.' . $ext;

        $fileContent = Storage::disk('spaces')->get($path);

        ob_end_clean();

        if($exists) {
            // return Storage::download($path, $name. '.' . $ext, $headers);
            return response($fileContent, 200, [
                'Content-Type' => $mime,
                'Content-Length' => $size,
                'Content-Description' => 'File Transfer',
                'Content-Disposition' => "attachment; filename={$filename}",
                'Content-Transfer-Encoding' => 'binary',
            ]);

        } else {
            return response()->json([
                'error' => [
                    'message' => 'File not found'
                ]
            ], 404);
        }
    }

}
