<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Response;

class ProductExportController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $file = fopen('php://memory', 'w');
        fputcsv($file, ['ID', 'Название', 'Описание', 'Цена', 'Остаток', 'Видимость']);

        foreach ($products as $product) {
            fputcsv($file, [
                $product->id,
                $product->name,
                $product->description,
                $product->price,
                $product->stock,
                $product->getIsVisibleAttribute($product->is_visible),
            ]);
        }

        fseek($file, 0);

        return Response::streamDownload(function() use ($file) {
            fpassthru($file);
        }, 'products.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ]);
    }
}