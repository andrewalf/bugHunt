<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Response;

class ProductExportController extends Controller
{
    private const CHUNK_SIZE = 50;
    public function index()
    {

        $file = fopen('php://memory', 'w');
        fputcsv($file, ['Название', 'Описание', 'Цена', 'Остаток', 'Видимость', 'Время_создания', 'URL_изображения']);

            $products = Product::chunk(self::CHUNK_SIZE, function ($products) use ($file) {
                foreach ($products as $product) {
                    fputcsv($file, [
                        $product->name,
                        $product->description,
                        $product->price,
                        $product->stock,
                        $product->is_visible == 1 ? "Да" : "Нет",
                        $product->created_at,
                        $product->getImageUrl()
                    ]);
                }
            });

        fseek($file, 0);

        return Response::streamDownload(function () use ($file) {
            fpassthru($file);
        }, date("Y-m-d H:i:s") . '_products.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ]);
    }
}