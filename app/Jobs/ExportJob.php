<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ExportJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $id)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $id = $this->id;
//        Storage::put("$id" .'temp.csv', "");
        $path = Storage::path("$id" .'temp.csv');
        $file = fopen($path, 'w');
        fputcsv($file, ['Название', 'Описание', 'Цена', 'Остаток', 'Видимость', 'Время_создания', 'URL_изображения']);
        Product::chunk(1000, function ($products) use($file) {
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
        Storage::move("$id" .'temp.csv', $id.".csv");
    }
}
