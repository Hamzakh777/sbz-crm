<?php

namespace App\Http\Controllers\Documents;

use App\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class DocumentsPreviewController extends Controller
{
    public function show($id) {
        $document = Document::findOrFail($id);
        $path = $document->path;
        $exists = Storage::disk('spaces')->exists($path);
        
        $url = Storage::disk('spaces')->temporaryUrl(
            $path,
            now()->addHour()
        );

        if ($exists) {
            // return Storage::download($path, $name. '.' . $ext, $headers);
            return response()->redirectTo($url);
        } else {
            abort(404);
        }
    }
}
