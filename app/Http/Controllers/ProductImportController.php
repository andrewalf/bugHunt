<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductImportController extends Controller
{
    public function downloadExampleFile()
    {
        $filePath = storage_path('app/import_example.csv');
        $file = fopen($filePath, 'w');
        fputcsv($file, ['Название', 'Опсание', 'Цена', 'Остаток', 'Видимость','Время_создания','URL_изображения']);

        foreach ([['Example Product 1', 'Description for product 1', '19.99', '100', '1',"2024-08-22 01:55:36", 'https://placehold.co/250'],
                     ['Example Product 2', 'Description for product 2', '29.99', '200', '0',"2024-08-22 01:55:36", 'https://placehold.co/250']] as $row) {
            fputcsv($file, $row);
        }

        fclose($file);
        return response()->download($filePath)->deleteFileAfterSend(true);
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv|file',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');

//         Пропускаем первую строку (заголовок)

        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            (new Product([
                'name' => $row[0],
                'description' => $row[1],
                'price' => $row[2],
                'stock' => $row[3],
                'is_visible' => $row[4] == "Да"?1:0,
                'created_at'=> $row[5]
            ]))->save();
        }

        fclose($file);

        return redirect()->route('products.list')->with('success', 'Продукты успешно импортированы.');
    }
}
