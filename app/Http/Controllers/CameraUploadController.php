<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CameraUploadController extends Controller
{
    /**
     * Upload image from AXIS camera
     */
    public function upload(Request $request)
    {
        // Autentizace pomocí Bearer tokenu
        $token = $request->bearerToken();
        $expectedToken = env('CAMERA_API_TOKEN');

        if (!$token || $token !== $expectedToken) {
            return response()->json([
                'success' => false,
                'error' => 'Unauthorized'
            ], 401);
        }

        // Validace
        $validator = validator($request->all(), [
            'image' => 'required|image|mimes:jpeg,jpg,png|max:10240', // max 10MB
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'messages' => $validator->errors()
            ], 422);
        }

        try {
            // Název souboru
            $filename = 'tenelife.jpg';

            // Cesta k uložení
            $directory = 'images';
            $publicPath = public_path($directory);

            // Vytvoření složky pokud neexistuje
            if (!file_exists($publicPath)) {
                mkdir($publicPath, 0755, true);
            }

            // Uložení obrázku (přepíše existující)
            $request->file('image')->move($publicPath, $filename);

            return response()->json([
                'success' => true,
                'filename' => $filename,
                'path' => $directory . '/' . $filename,
                'url' => url($directory . '/' . $filename)
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to save image',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
