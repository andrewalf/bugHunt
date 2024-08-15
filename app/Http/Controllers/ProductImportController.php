<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductImportController extends Controller
{
    public function downloadExampleFile()
    {
        $file = fopen('php://memory', 'w');

        fputcsv($file, ['ID', 'Название', 'Опсание', 'Цена', 'Остаток', 'Видимость']);

        foreach ([['Example Product 1', 'Description for product 1', '19.99', '100', '1'], ['Example Product 2', 'Description for product 2', '29.99', '200', '0']] as $row) {
            fputcsv($file, $row);
        }

        fseek($file, 0);

        return Response::streamDownload(function() use ($file) {
            fpassthru($file);
        }, 'import_example.csv', [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="import_example.csv"',
        ]);
    }

    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|file',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $file = fopen($request->file('csv_file')->getRealPath(), 'r');

        // Пропускаем первую строку (заголовок)
        fgetcsv($file);

        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            (new Product([
                'id' => $row[0],
                'name' => $row[1],
                'description' => $row[2],
                'price' => $row[3],
                'stock' => $row[4],
                'is_visible' => (bool) $row[5],
            ]))->save();
        }

        fclose($file);

        return redirect()->route('products.list')->with('success', 'Продукты успешно импортированы.');
    }
}
