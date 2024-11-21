<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class DownloadController extends Controller
{
    public function download(Request $request) 
    {
        $path = $request->input('path');

        $relativePath = str_replace('/storage/', '', $path);
        $filePath = storage_path('app/public/' . $relativePath);

        if (!File::exists($filePath)) {
            return back();
        }

        $mimeType = File::mimeType($filePath);
        $fileName = basename($filePath);

        return Response::download($filePath, $fileName, ['Content-Type' => $mimeType]);
    }
}
