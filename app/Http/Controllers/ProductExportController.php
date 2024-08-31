<?php

namespace App\Http\Controllers;

use App\Jobs\ExportJob;
use App\Models\Product;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductExportController extends Controller
{
    public function index()
    {
        $id = Auth::id();
        dispatch(new ExportJob($id));
        return redirect()->route('products.list')->with('success', 'Файл в обработке, через некоторое время обновите, чтобы нажать кнопку скачать');
    }

    public function download()
    {
        $id = Auth::id();
        $path = Storage::path($id . '.csv');
        return response()->download($path, date("Y-m-d H:i:s") . '_products.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ])->deleteFileAfterSend(true);
    }
}