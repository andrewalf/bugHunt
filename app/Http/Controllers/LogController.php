<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class LogController extends Controller
{
    public function index()
    {
        $logFile = storage_path('logs/laravel.log');

        if (File::exists($logFile)) {
            $logs = File::get($logFile);
            return Response::make(nl2br(e($logs)), 200)
                ->header('Content-Type', 'text/html');
        } else {
            return response()->json(['message' => 'Log file not found'], 404);
        }
    }
}
